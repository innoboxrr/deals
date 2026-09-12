#!/usr/bin/env php
<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\GoogleAdsDriver;

require dirname(__DIR__, 5) . '/vendor/autoload.php';

/**
 * Contenedor ligero que implementa getPayload() sin requerir base de datos.
 */
final class SandboxDealAdPlatform extends DealAdPlatform
{
    public function __construct(private readonly array $payload)
    {
        parent::__construct();
        $this->setAttribute('payload', $payload);
    }

    public function getPayload($key = null, $default = null)
    {
        $payload = $this->getAttribute('payload') ?? [];
        if ($key === null || $key === '') {
            return $payload;
        }

        return Arr::get($payload, $key, $default);
    }
}

function sanitizeId(?string $value): ?string
{
    if ($value === null) {
        return null;
    }

    $digits = preg_replace('/[^0-9]/', '', $value);

    return $digits !== '' ? $digits : null;
}

$credentials = [
    'developer_token'     => 'TODO_DEVELOPER_TOKEN',
    'client_id'           => 'TODO_CLIENT_ID',
    'client_secret'       => 'TODO_CLIENT_SECRET',
    'refresh_token'       => 'TODO_REFRESH_TOKEN',
    'redirect_uri'        => 'TODO_REDIRECT_URI',
    'customer_id'         => 'TODO_SUBACCOUNT_ID',
    'login_customer_id'   => 'TODO_MCC_ID',
    'linked_customer_id'  => '',
    'conversion_action'   => 'customers/0000000000/conversionActions/0000000000',
];

$sandboxIds = [
    'campaign_id'        => 'TODO_CAMPAIGN_ID',
    'ad_group_id'        => 'TODO_AD_GROUP_ID',
    'ad_id'              => 'TODO_AD_ID',
    'lead_form_asset_id' => 'customers/0000000000/assets/0000000000',
    'keyword_ids'        => ['TODO_KEYWORD_ID'],
    'gclid'              => 'TODO_TEST_GCLID',
];

$assetFiles = [
    'image' => dirname(__DIR__, 5) . '/storage/app/tmp/test-image.jpg',
];

$payload = [
    'credentials' => [
        'developer_token'    => $credentials['developer_token'],
        'client_id'          => $credentials['client_id'],
        'client_secret'      => $credentials['client_secret'],
        'refresh_token'      => $credentials['refresh_token'],
        'redirect_uri'       => $credentials['redirect_uri'],
        'customer_id'        => sanitizeId($credentials['customer_id']) ?? '',
        'login_customer_id'  => sanitizeId($credentials['login_customer_id']) ?? '',
        'linked_customer_id' => sanitizeId($credentials['linked_customer_id']) ?? '',
        'conversion_action'  => $credentials['conversion_action'],
    ],
];

$platform = new SandboxDealAdPlatform($payload);
$driver   = (new GoogleAdsDriver())->using($platform);

$rawActions = $argv;
array_shift($rawActions);

if (empty($rawActions)) {
    $rawActions = ['verify-connection', 'get-account', 'list-campaigns'];
}

function printHeading(string $title): void
{
    fwrite(STDOUT, PHP_EOL . str_repeat('=', 8) . " {$title} " . str_repeat('=', 8) . PHP_EOL);
}

function dumpValue(mixed $value): void
{
    if (is_iterable($value) && !is_string($value)) {
        $asArray = [];
        foreach ($value as $item) {
            $asArray[] = $item;
        }
        fwrite(STDOUT, json_encode($asArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL);
        return;
    }

    fwrite(STDOUT, json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL);
}

function resolveArg(?string $raw, string $fallbackKey, array $sandboxIds): ?string
{
    if ($raw !== null && $raw !== '') {
        return $raw;
    }

    return $sandboxIds[$fallbackKey] ?? null;
}

foreach ($rawActions as $rawAction) {
    [$action, $arg] = array_pad(explode(':', (string)$rawAction, 2), 2, null);

    try {
        switch ($action) {
            case 'auth-url':
                printHeading('authorizationUrl');
                dumpValue($driver->authorizationUrl(null, ['https://www.googleapis.com/auth/adwords']));
                break;

            case 'exchange-code':
                if ($arg === null) {
                    throw new InvalidArgumentException('Debes pasar el código como exchange-code:<CODE>.');
                }
                printHeading('handleOAuthCallback');
                dumpValue($driver->handleOAuthCallback(['code' => $arg]));
                break;

            case 'refresh-token':
                printHeading('refreshAccessToken');
                dumpValue($driver->refreshAccessToken());
                break;

            case 'verify-connection':
                printHeading('verifyConnection');
                dumpValue($driver->verifyConnection());
                break;

            case 'get-account':
                printHeading('getAccount');
                dumpValue($driver->getAccount());
                break;

            case 'list-campaigns':
                $status = $arg !== null ? $arg : null;
                printHeading('listEntities(campaign)');
                dumpValue($driver->listEntities('campaign', null, $status ? ['status' => $status] : []));
                break;

            case 'create-campaign':
                printHeading('createEntity(campaign)');
                $payload = [
                    'name' => 'SeguroPro QA ' . date('Y-m-d H:i'),
                    'budget' => ['amount' => 50.0, 'type' => 'daily'],
                    'time_window' => [
                        'start_date' => date('Ymd', strtotime('+1 day')),
                        'end_date'   => null,
                    ],
                ];
                dumpValue($driver->createEntity('campaign', $payload));
                break;

            case 'update-campaign':
                $campaignId = resolveArg($arg, 'campaign_id', $sandboxIds);
                if (!$campaignId) {
                    throw new InvalidArgumentException('Define campaign_id en $sandboxIds o pásalo como update-campaign:<ID>.');
                }
                printHeading('updateEntity(campaign)');
                dumpValue($driver->updateEntity('campaign', sanitizeId($campaignId) ?? $campaignId, [
                    'name' => 'SeguroPro QA (updated ' . date('H:i') . ')',
                ]));
                break;

            case 'adjust-budget':
                $campaignId = resolveArg($arg, 'campaign_id', $sandboxIds);
                if (!$campaignId) {
                    throw new InvalidArgumentException('Define campaign_id en $sandboxIds o pásalo como adjust-budget:<ID>.');
                }
                printHeading('adjustBudget');
                dumpValue($driver->adjustBudget('campaign', sanitizeId($campaignId) ?? $campaignId, [
                    'amount' => 60.0,
                ]));
                break;

            case 'pause-campaign':
            case 'resume-campaign':
                $campaignId = resolveArg($arg, 'campaign_id', $sandboxIds);
                if (!$campaignId) {
                    throw new InvalidArgumentException('Define campaign_id en $sandboxIds o pásalo como ' . $action . ':<ID>.');
                }
                printHeading($action);
                $method = $action === 'pause-campaign' ? 'pauseEntity' : 'resumeEntity';
                $driver->{$method}('campaign', sanitizeId($campaignId) ?? $campaignId);
                fwrite(STDOUT, "OK" . PHP_EOL);
                break;

            case 'list-ad-groups':
                $campaignId = resolveArg($arg, 'campaign_id', $sandboxIds);
                if (!$campaignId) {
                    throw new InvalidArgumentException('Define campaign_id en $sandboxIds o pásalo como list-ad-groups:<ID>.');
                }
                printHeading('listEntities(container)');
                dumpValue($driver->listEntities('container', sanitizeId($campaignId) ?? $campaignId));
                break;

            case 'create-ad-group':
                $campaignId = resolveArg($arg, 'campaign_id', $sandboxIds);
                if (!$campaignId) {
                    throw new InvalidArgumentException('Define campaign_id en $sandboxIds o pásalo como create-ad-group:<ID>.');
                }
                printHeading('createEntity(container)');
                $payload = [
                    'name' => 'QA AdGroup ' . date('H:i'),
                    'bid'  => 10.0,
                ];
                dumpValue($driver->createEntity('container', $payload, sanitizeId($campaignId) ?? $campaignId));
                break;

            case 'adjust-bid':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como adjust-bid:<ID>.');
                }
                printHeading('adjustBid');
                dumpValue($driver->adjustBid('container', sanitizeId($adGroupId) ?? $adGroupId, ['bid' => 8.5]));
                break;

            case 'list-ads':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como list-ads:<ID>.');
                }
                printHeading('listEntities(ad)');
                dumpValue($driver->listEntities('ad', sanitizeId($adGroupId) ?? $adGroupId));
                break;

            case 'create-ad':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como create-ad:<ID>.');
                }
                printHeading('createEntity(ad)');
                $payload = [
                    'ad_group_id' => sanitizeId($adGroupId) ?? $adGroupId,
                    'format'      => 'responsive',
                    'name'        => 'QA RSA ' . date('H:i'),
                    'assets'      => [
                        'headlines'    => ['Cotiza tu seguro', 'Protección total'],
                        'descriptions' => ['Obtén asesoría sin costo.', 'Atención 24/7 para tus clientes.'],
                        'final_url'    => 'https://seguropro.mx/demo',
                    ],
                ];
                dumpValue($driver->createEntity('ad', $payload));
                break;

            case 'pause-ad':
            case 'resume-ad':
                $adId = resolveArg($arg, 'ad_id', $sandboxIds);
                if (!$adId) {
                    throw new InvalidArgumentException('Define ad_id en $sandboxIds o pásalo como ' . $action . ':<ID>.');
                }
                printHeading($action);
                $method = $action === 'pause-ad' ? 'pauseEntity' : 'resumeEntity';
                $driver->{$method}('ad', sanitizeId($adId) ?? $adId);
                fwrite(STDOUT, "OK" . PHP_EOL);
                break;

            case 'fetch-stats':
                $level = $arg ?: 'campaign';
                printHeading('fetchStats');
                $from = CarbonImmutable::now('UTC')->subDays(7);
                $to   = CarbonImmutable::now('UTC');
                dumpValue($driver->fetchStats($level, $from, $to));
                break;

            case 'fetch-leads':
                printHeading('fetchLeads');
                $from = CarbonImmutable::now('UTC')->subDay();
                $to   = CarbonImmutable::now('UTC');
                dumpValue($driver->fetchLeads($from, $to));
                break;

            case 'list-assets':
                printHeading('listAssets');
                dumpValue($driver->listAssets());
                break;

            case 'upload-text-asset':
                printHeading('uploadAsset(TEXT)');
                dumpValue($driver->uploadAsset([
                    'type' => 'TEXT',
                    'name' => 'Texto QA ' . date('H:i'),
                    'text' => 'Mensaje de prueba desde SeguroPro.',
                ]));
                break;

            case 'upload-image-asset':
                if (!is_file($assetFiles['image'])) {
                    throw new RuntimeException('Actualiza $assetFiles["image"] con la ruta a una imagen válida.');
                }
                printHeading('uploadAsset(IMAGE)');
                dumpValue($driver->uploadAsset([
                    'type' => 'IMAGE',
                    'name' => 'Imagen QA ' . date('H:i'),
                    'path' => $assetFiles['image'],
                ]));
                break;

            case 'rename-asset':
                $assetId = resolveArg($arg, 'lead_form_asset_id', $sandboxIds);
                if (!$assetId) {
                    throw new InvalidArgumentException('Pasa rename-asset:<ASSET_ID> o configura lead_form_asset_id.');
                }
                printHeading('updateAsset');
                dumpValue($driver->updateAsset(sanitizeId($assetId) ?? $assetId, [
                    'name' => 'Asset QA ' . date('H:i'),
                ]));
                break;

            case 'list-keywords':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como list-keywords:<ID>.');
                }
                printHeading('listKeywords');
                dumpValue($driver->listKeywords(sanitizeId($adGroupId) ?? $adGroupId));
                break;

            case 'add-keywords':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como add-keywords:<ID>.');
                }
                printHeading('createKeywords');
                dumpValue($driver->createKeywords(sanitizeId($adGroupId) ?? $adGroupId, [
                    ['text' => 'seguros online', 'match' => 'BROAD'],
                    ['text' => 'cotizar seguro auto', 'match' => 'PHRASE'],
                ]));
                break;

            case 'remove-keywords':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como remove-keywords:<ID>.');
                }
                if (empty($sandboxIds['keyword_ids']) || !is_array($sandboxIds['keyword_ids'])) {
                    throw new InvalidArgumentException('Agrega keyword_ids en $sandboxIds para poder removerlos.');
                }
                printHeading('removeKeywords');
                $driver->removeKeywords(sanitizeId($adGroupId) ?? $adGroupId, array_map(
                    fn ($id) => sanitizeId((string)$id) ?? (string)$id,
                    $sandboxIds['keyword_ids']
                ));
                fwrite(STDOUT, "OK" . PHP_EOL);
                break;

            case 'list-placements':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como list-placements:<ID>.');
                }
                printHeading('listPlacements');
                dumpValue($driver->listPlacements(sanitizeId($adGroupId) ?? $adGroupId));
                break;

            case 'exclude-placements':
                $adGroupId = resolveArg($arg, 'ad_group_id', $sandboxIds);
                if (!$adGroupId) {
                    throw new InvalidArgumentException('Define ad_group_id en $sandboxIds o pásalo como exclude-placements:<ID>.');
                }
                printHeading('excludePlacements');
                dumpValue($driver->excludePlacements(sanitizeId($adGroupId) ?? $adGroupId, [
                    'https://example.com/prueba-display',
                ]));
                break;

            case 'upload-offline-conv':
                $gclid = $sandboxIds['gclid'] ?? null;
                if (!$gclid) {
                    throw new InvalidArgumentException('Configura un gclid en $sandboxIds para subir conversiones.');
                }
                printHeading('uploadOfflineConversions');
                $now = CarbonImmutable::now('UTC');
                dumpValue($driver->uploadOfflineConversions([
                    [
                        'click_id'    => $gclid,
                        'event_name'  => 'LeadQualified',
                        'value'       => 120.0,
                        'currency'    => 'MXN',
                        'occurred_at' => $now->subHours(2)->format('Y-m-d H:i:sO'),
                        'order_id'    => 'QA-' . $now->format('His'),
                    ],
                ], [
                    'conversion_action' => $credentials['conversion_action'],
                ]));
                break;

            case 'upload-crm':
                $gclid = $sandboxIds['gclid'] ?? null;
                if (!$gclid) {
                    throw new InvalidArgumentException('Configura un gclid en $sandboxIds para subir conversiones.');
                }
                printHeading('uploadCRMRevenue');
                $now = CarbonImmutable::now('UTC');
                dumpValue($driver->uploadCRMRevenue([
                    [
                        'click_id'    => $gclid,
                        'event_name'  => 'Sale',
                        'value'       => 250.0,
                        'currency'    => 'MXN',
                        'occurred_at' => $now->subDay()->format('Y-m-d H:i:sO'),
                        'order_id'    => 'QA-CRM-' . $now->format('His'),
                    ],
                ], [
                    'conversion_action' => $credentials['conversion_action'],
                ]));
                break;

            default:
                throw new InvalidArgumentException("Acción desconocida: {$action}");
        }
    } catch (Throwable $e) {
        fwrite(STDERR, "[ERROR] {$action}: {$e->getMessage()}" . PHP_EOL);
        if ($e->getPrevious()) {
            fwrite(STDERR, 'Causa: ' . $e->getPrevious()->getMessage() . PHP_EOL);
        }
    }
}
