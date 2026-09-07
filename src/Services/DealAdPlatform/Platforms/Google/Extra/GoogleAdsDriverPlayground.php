#!/usr/bin/env php
<?php

declare(strict_types=1);

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Platforms\Google\GoogleAdsDriver;

require_once dirname(__DIR__, 6) . '/vendor/autoload.php';


// -----------------------------------------------------------------------------
// CONFIGURACION
//
// Las credenciales se leen del entorno. Antes estaban incrustadas aqui, con el
// developer token, el client secret y el refresh token reales de la cuenta de
// pruebas: el escaneo de secretos de GitHub bloqueo el push, con razon.
//
//     export GOOGLE_ADS_DEVELOPER_TOKEN=...
//     export GOOGLE_ADS_CLIENT_ID=...
//     export GOOGLE_ADS_CLIENT_SECRET=...
//     export GOOGLE_ADS_REFRESH_TOKEN=...
//     export GOOGLE_ADS_LOGIN_CUSTOMER_ID=...
//     export GOOGLE_ADS_CUSTOMER_ID=...
//     export GOOGLE_ADS_REDIRECT_URI=...
// -----------------------------------------------------------------------------

/**
 * Falla pronto y con un mensaje util: un playground que arranca sin
 * credenciales revienta mas adelante con un error del SDK que no dice nada.
 */
function googleAdsEnv(string $name, bool $required = true): string
{
    $value = getenv($name);

    if (($value === false || $value === "") && $required) {
        fwrite(STDERR, "Falta la variable de entorno {$name}." . PHP_EOL);
        exit(1);
    }

    return $value === false ? "" : $value;
}

define("GOOGLE_ADS_DEVELOPER_TOKEN", googleAdsEnv("GOOGLE_ADS_DEVELOPER_TOKEN"));
define("GOOGLE_ADS_CLIENT_ID", googleAdsEnv("GOOGLE_ADS_CLIENT_ID"));
define("GOOGLE_ADS_CLIENT_SECRET", googleAdsEnv("GOOGLE_ADS_CLIENT_SECRET"));
define("GOOGLE_ADS_REFRESH_TOKEN", googleAdsEnv("GOOGLE_ADS_REFRESH_TOKEN"));
define("GOOGLE_ADS_LOGIN_CUSTOMER_ID", googleAdsEnv("GOOGLE_ADS_LOGIN_CUSTOMER_ID"));
define("GOOGLE_ADS_CUSTOMER_ID", googleAdsEnv("GOOGLE_ADS_CUSTOMER_ID"));
define("GOOGLE_ADS_LINKED_CUSTOMER_ID", googleAdsEnv("GOOGLE_ADS_LINKED_CUSTOMER_ID", false));
define("GOOGLE_ADS_REDIRECT_URI", googleAdsEnv("GOOGLE_ADS_REDIRECT_URI"));

// Permite habilitar logging detallado del SDK
if (getenv('GOOGLE_ADS_LOGGING')) {
    putenv('GOOGLE_ADS_CONFIGURATION_FILE_PATH='.dirname(__DIR__, 5).'/google-ads.yaml');
}

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "Este script solo puede ejecutarse desde la línea de comandos.\n");
    exit(1);
}

$action = $argv[1] ?? 'help';
$args   = array_slice($argv, 2);

$driver = buildDriver();

$actions = [
    'help' => function () {
        echo <<<TEXT
Google Ads Driver Playground
============================

Comandos disponibles:
  help                                         Muestra este mensaje.
  oauth-url [state]                            Genera URL de autorización OAuth.
  exchange <code>                              Intercambia un auth code por tokens.
  refresh-token                                Refresca el access token.
  verify                                       Ejecuta verifyConnection().
  account                                      Obtiene metadata de la cuenta activa.
  list-campaigns                               Lista campañas de búsqueda.
  create-campaign <payload.json>               Crea campaña (Search/Manual CPC).
  update-campaign <id> <payload.json>          Actualiza campaña existente.
  pause-campaign <id>                          Pausa campaña.
  resume-campaign <id>                         Reactiva campaña.
  adjust-budget <id> <payload.json>            Ajusta presupuesto de campaña.
  list-containers <campaignId> [ad_group|asset_group]
                                              Lista ad groups o asset groups.
  create-ad-group <campaignId> <payload.json>  Crea un ad group.
  update-ad-group <id> <payload.json>          Actualiza ad group.
  pause-ad-group <id>                          Pausa ad group.
  resume-ad-group <id>                         Reactiva ad group.
  adjust-bid <adGroupId> <payload.json>        Ajusta puja en micros o unidades.
  list-ads <adGroupId>                         Lista anuncios.
  create-ad <adGroupId> <payload.json>         Crea anuncio RSA.
  update-ad <adId> <payload.json>              Actualiza anuncio.
  pause-ad <adId>                              Pausa anuncio.
  resume-ad <adId>                             Reactiva anuncio.
  stats <level> <from> <to> [ids.json]         Fetch stats (level: campaign|container|ad).
  fetch-leads <from> <to> [campaignId]         Descarga leads de formularios.
  upload-offline <payload.json>                Sube conversiones offline (click).
  list-assets [types.csv]                      Lista assets filtrados por tipo.
  upload-asset <payload.json>                  Sube asset TEXT o IMAGE.
  list-keywords <adGroupId>                    Lista keywords del ad group.
  create-keywords <adGroupId> <payload.json>   Crea keywords.
  remove-keywords <adGroupId> <ids.csv>        Elimina keywords por ID.
  list-neg-keywords <adGroupId>                Lista negativas.
  add-neg-keywords <adGroupId> <payload.json>  Agrega negativas.
  list-placements <adGroupId>                  Lista placements.
  exclude-placements <adGroupId> <payload.json>Excluye placements.
  health                                       Ejecuta health().
TEXT;
    },

    'oauth-url' => function (array $args) use ($driver): void {
        $state = $args[0] ?? null;
        echo $driver->authorizationUrl($state) . PHP_EOL;
    },

    'exchange' => function (array $args) use ($driver): void {
        $code = $args[0] ?? null;
        if (!$code) {
            throw new \InvalidArgumentException('Debes proporcionar el authorization code.');
        }
        dumpResult($driver->handleOAuthCallback(['code' => $code]));
    },

    'refresh-token' => function () use ($driver): void {
        dumpResult($driver->refreshAccessToken());
    },

    'verify' => function () use ($driver): void {
        dumpResult($driver->verifyConnection());
    },

    'account' => function () use ($driver): void {
        dumpResult($driver->getAccount());
    },

    'list-campaigns' => function () use ($driver): void {
        dumpIterable($driver->listEntities('campaign'));
    },

    'create-campaign' => function (array $args) use ($driver): void {
        $payload = loadJson($args[0] ?? null);
        dumpResult($driver->createEntity('campaign', $payload));
    },

    'update-campaign' => function (array $args) use ($driver): void {
        [$id, $file] = requireArgs($args, 2);
        $payload = loadJson($file);
        dumpResult($driver->updateEntity('campaign', $id, $payload));
    },

    'pause-campaign' => function (array $args) use ($driver): void {
        $driver->pauseEntity('campaign', requireArgs($args, 1)[0]);
        echo "Campaña pausada." . PHP_EOL;
    },

    'resume-campaign' => function (array $args) use ($driver): void {
        $driver->resumeEntity('campaign', requireArgs($args, 1)[0]);
        echo "Campaña reactivada." . PHP_EOL;
    },

    'adjust-budget' => function (array $args) use ($driver): void {
        [$id, $file] = requireArgs($args, 2);
        $payload = loadJson($file);
        dumpResult($driver->adjustBudget('campaign', $id, $payload));
    },

    'list-containers' => function (array $args) use ($driver): void {
        [$campaignId] = requireArgs($args, 1);
        $type = $args[1] ?? 'ad_group';
        dumpIterable($driver->listEntities('container', $campaignId, ['type' => $type]));
    },

    'create-ad-group' => function (array $args) use ($driver): void {
        [$campaignId, $file] = requireArgs($args, 2);
        $payload = loadJson($file);
        dumpResult($driver->createEntity('container', $payload, $campaignId));
    },

    'update-ad-group' => function (array $args) use ($driver): void {
        [$id, $file] = requireArgs($args, 2);
        $payload = loadJson($file);
        dumpResult($driver->updateEntity('container', $id, $payload));
    },

    'pause-ad-group' => function (array $args) use ($driver): void {
        $driver->pauseEntity('container', requireArgs($args, 1)[0]);
        echo "Ad group pausado." . PHP_EOL;
    },

    'resume-ad-group' => function (array $args) use ($driver): void {
        $driver->resumeEntity('container', requireArgs($args, 1)[0]);
        echo "Ad group reactivado." . PHP_EOL;
    },

    'adjust-bid' => function (array $args) use ($driver): void {
        [$id, $file] = requireArgs($args, 2);
        dumpResult($driver->adjustBid('container', $id, loadJson($file)));
    },

    'list-ads' => function (array $args) use ($driver): void {
        [$adGroupId] = requireArgs($args, 1);
        dumpIterable($driver->listEntities('ad', $adGroupId));
    },

    'create-ad' => function (array $args) use ($driver): void {
        [$adGroupId, $file] = requireArgs($args, 2);
        dumpResult($driver->createEntity('ad', loadJson($file), $adGroupId));
    },

    'update-ad' => function (array $args) use ($driver): void {
        [$adId, $file] = requireArgs($args, 2);
        dumpResult($driver->updateEntity('ad', $adId, loadJson($file)));
    },

    'pause-ad' => function (array $args) use ($driver): void {
        $driver->pauseEntity('ad', requireArgs($args, 1)[0]);
        echo "Anuncio pausado." . PHP_EOL;
    },

    'resume-ad' => function (array $args) use ($driver): void {
        $driver->resumeEntity('ad', requireArgs($args, 1)[0]);
        echo "Anuncio reactivado." . PHP_EOL;
    },

    'stats' => function (array $args) use ($driver): void {
        [$level, $from, $to] = requireArgs($args, 3);
        $ids = isset($args[3]) ? loadJson($args[3]) : [];
        $fromDate = new \DateTimeImmutable($from);
        $toDate   = new \DateTimeImmutable($to);
        dumpIterable($driver->fetchStats($level, $fromDate, $toDate, ['ids' => $ids]));
    },

    'fetch-leads' => function (array $args) use ($driver): void {
        [$from, $to] = requireArgs($args, 2);
        $params = [];
        if (!empty($args[2])) {
            $params['campaign_id'] = $args[2];
        }
        dumpIterable($driver->fetchLeads(new \DateTimeImmutable($from), new \DateTimeImmutable($to), $params));
    },

    'upload-offline' => function (array $args) use ($driver): void {
        dumpResult($driver->uploadOfflineConversions(loadJson($args[0] ?? null)));
    },

    'list-assets' => function (array $args) use ($driver): void {
        $types = [];
        if (!empty($args[0])) {
            $types = array_map('trim', explode(',', $args[0]));
        }
        dumpIterable($driver->listAssets(['types' => $types]));
    },

    'upload-asset' => function (array $args) use ($driver): void {
        dumpResult($driver->uploadAsset(loadJson($args[0] ?? null)));
    },

    'list-keywords' => function (array $args) use ($driver): void {
        [$adGroupId] = requireArgs($args, 1);
        dumpIterable($driver->listKeywords($adGroupId));
    },

    'create-keywords' => function (array $args) use ($driver): void {
        [$adGroupId, $file] = requireArgs($args, 2);
        dumpResult($driver->createKeywords($adGroupId, loadJson($file)));
    },

    'remove-keywords' => function (array $args) use ($driver): void {
        [$adGroupId, $idsCsv] = requireArgs($args, 2);
        $ids = array_filter(array_map('trim', explode(',', $idsCsv)));
        $driver->removeKeywords($adGroupId, $ids);
        echo "Keywords eliminadas: " . implode(', ', $ids) . PHP_EOL;
    },

    'list-neg-keywords' => function (array $args) use ($driver): void {
        [$adGroupId] = requireArgs($args, 1);
        dumpIterable($driver->listNegativeKeywords($adGroupId));
    },

    'add-neg-keywords' => function (array $args) use ($driver): void {
        [$adGroupId, $file] = requireArgs($args, 2);
        dumpResult($driver->addNegativeKeywords($adGroupId, loadJson($file)));
    },

    'list-placements' => function (array $args) use ($driver): void {
        [$adGroupId] = requireArgs($args, 1);
        dumpIterable($driver->listPlacements($adGroupId));
    },

    'exclude-placements' => function (array $args) use ($driver): void {
        [$adGroupId, $file] = requireArgs($args, 2);
        dumpResult($driver->excludePlacements($adGroupId, loadJson($file)));
    },

    'health' => function () use ($driver): void {
        dumpResult($driver->health());
    },
];

if (!isset($actions[$action])) {
    fwrite(STDERR, "Acción desconocida: {$action}\n");
    $actions['help']([]);
    exit(1);
}

try {
    $actions[$action]($args);
} catch (\Throwable $e) {
    fwrite(STDERR, '[ERROR] ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

// -----------------------------------------------------------------------------
// Helpers
// -----------------------------------------------------------------------------
function buildDriver(): GoogleAdsDriver
{
    $platform = new DealAdPlatform();
    $platform->setAttribute('payload', [
        'credentials' => array_filter([
            'developer_token'   => GOOGLE_ADS_DEVELOPER_TOKEN,
            'client_id'         => GOOGLE_ADS_CLIENT_ID,
            'client_secret'     => GOOGLE_ADS_CLIENT_SECRET,
            'refresh_token'     => GOOGLE_ADS_REFRESH_TOKEN,
            'login_customer_id' => GOOGLE_ADS_LOGIN_CUSTOMER_ID,
            'customer_id'       => GOOGLE_ADS_CUSTOMER_ID,
            'linked_customer_id'=> GOOGLE_ADS_LINKED_CUSTOMER_ID,
            'redirect_uri'      => GOOGLE_ADS_REDIRECT_URI,
        ], static fn ($value) => $value !== '' && $value !== null),
    ]);

    return (new GoogleAdsDriver())->using($platform);
}

/**
 * @param string|null $path
 * @return array<mixed>
 */
function loadJson(?string $path): array
{
    if (!$path) {
        throw new \InvalidArgumentException('Debes proporcionar la ruta al archivo JSON.');
    }
    if (!is_file($path)) {
        throw new \InvalidArgumentException("No se encontró el archivo: {$path}");
    }
    $contents = file_get_contents($path);
    $data = json_decode($contents ?: '[]', true);
    if (!is_array($data)) {
        throw new \InvalidArgumentException('El archivo JSON debe contener un objeto o arreglo.');
    }
    return $data;
}

/**
 * @param array<int,string> $args
 * @param int $count
 * @return array<int,string>
 */
function requireArgs(array $args, int $count): array
{
    if (count($args) < $count) {
        throw new \InvalidArgumentException('Faltan argumentos para ejecutar el comando.');
    }
    return array_slice($args, 0, $count);
}

function dumpIterable(iterable $items): void
{
    foreach ($items as $item) {
        dumpResult($item);
    }
}

/**
 * @param mixed $value
 */
function dumpResult($value): void
{
    if ($value instanceof \DateTimeInterface) {
        echo $value->format(\DateTimeInterface::ATOM) . PHP_EOL;
        return;
    }
    echo json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
}
