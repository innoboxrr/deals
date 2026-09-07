<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Contracts;

use Innoboxrr\Deals\Models\DealAdPlatform;
use DateTimeInterface;

/**
 * Contrato unificado para drivers de plataformas publicitarias.
 *
 * Niveles de entidad normalizados:
 * - "campaign": campaña
 * - "container": nivel intermedio genérico (adset/adgroup/asset_group/PMAX group)
 * - "ad": anuncio/creative
 *
 * Normalización sugerida de entidades:
 * - Campaign:
 *   [
 *       'external_id'   => '123',
 *       'name'          => 'LeadGen MX',
 *       'status'        => 'enabled|paused|removed|draft',
 *       'objective'     => 'leads|sales|traffic|awareness|app_installs|video',
 *       'type'          => 'standard|search|display|video|pmax|advantage_plus|shopping|app',
 *       'budget'        => ['type' => 'daily|lifetime', 'amount' => 500.0, 'currency' => 'MXN'],
 *       'time_window'   => ['start_date' => '2025-01-01', 'end_date' => null, 'timezone' => 'America/Mexico_City'],
 *       'tracking'      => ['pixel_id' => '...', 'conversion_actions' => ['...']],
 *       'metadata'      => ['raw' => {...}]
 *   ]
 *
 * - Container (adset/adgroup/asset_group):
 *   [
 *       'external_id'   => '456',
 *       'campaign_id'   => '123',
 *       'name'          => 'Adultos 25-54',
 *       'status'        => 'enabled|paused|removed|draft',
 *       'bidding'       => ['strategy' => 'cpa|cpc|roas|max_conv|max_clicks', 'bid' => 20.0],
 *       'budget'        => ['type' => 'daily|lifetime|inherited', 'amount' => 300.0, 'currency' => 'MXN'],
 *       'targeting'     => ['locations' => ['MX'], 'interests' => [...], 'keywords' => [...]],
 *       'placements'    => ['automatic' => true, 'includes' => [], 'excludes' => []],
 *       'metadata'      => ['raw' => {...}]
 *   ]
 *
 * - Ad (creative):
 *   [
 *       'external_id'   => '789',
 *       'container_id'  => '456',
 *       'name'          => 'Creativo A',
 *       'status'        => 'enabled|paused|removed|draft',
 *       'format'        => 'image|video|responsive|text|html5',
 *       'assets'        => ['headline' => '...', 'text' => '...', 'image_id' => '...', 'video_id' => '...'],
 *       'tracking'      => ['url' => 'https://...', 'utm' => [...]],
 *       'metadata'      => ['raw' => {...}]
 *   ]
 *
 * Fila de métricas normalizada (fetchStats):
 * [
 *   'date'          => '2025-01-01',
 *   'level'         => 'campaign|container|ad',
 *   'external_id'   => '789',
 *   'campaign_id'   => '123',
 *   'container_id'  => '456',
 *   'impressions'   => 1000,
 *   'clicks'        => 50,
 *   'spend'         => 25.50,
 *   'currency'      => 'MXN',
 *   'leads'         => 5,
 *   'conversions'   => 2,
 *   'revenue'       => 180.00,     // opcional si existe
 *   'reach'         => 800,        // opcional
 *   'video_views'   => 120,        // opcional
 *   'ctr'           => 0.05,       // opcional (puede calcularse)
 *   'cpc'           => 0.51,       // opcional (puede calcularse)
 *   'cpm'           => 25.50,      // opcional (puede calcularse)
 *   'cpl'           => 5.10,       // opcional (puede calcularse)
 *   'cpa'           => 12.75,      // opcional (puede calcularse)
 *   'roas'          => 7.05,       // opcional (puede calcularse)
 *   'metadata'      => ['raw' => {...}]
 * ]
 */
interface AdsPlatformDriver
{
    /**
     * Asocia el registro DealAdPlatform (con payload/credenciales) al driver.
     *
     * @param DealAdPlatform $platform Modelo con integration_type y credenciales en payload.
     * @return static
     *
     * @example $driver->using($dealAdPlatform);
     */
    public function using(DealAdPlatform $platform): static;

    /**
     * Devuelve un mapa de capacidades del driver para que la app sepa qué habilitar.
     *
     * Ejemplo de salida:
     * [
     *   'oauth' => true,
     *   'api_key' => false,
     *   'entities' => ['campaign' => true, 'container' => true, 'ad' => true],
     *   'lead_forms' => true,
     *   'assets' => true,
     *   'audiences' => true,
     *   'keywords' => true, // si aplica (search)
     *   'placements' => true,
     *   'experiments' => true,
     *   'offline_conversions' => true,
     *   'webhooks' => ['leads' => true, 'conversions' => false],
     * ]
     *
     * @return array<string,mixed>
     */
    public function getCapabilities(): array;

    // -------------------- Autorización / Conexión --------------------

    /**
     * ¿Soporta OAuth? Devuelve URL de autorización (si aplica).
     *
     * @param string|null $state Valor para anti-CSRF/devolución.
     * @param array $scopes Scopes opcionales.
     * @return string URL a la que debes enviar al usuario.
     */
    public function authorizationUrl(?string $state = null, array $scopes = []): string;

    /**
     * Maneja el callback OAuth y guarda tokens en el payload (si aplica).
     *
     * @param array $queryOrBody Datos recibidos en el callback.
     * @return array Tokens/metadata persistidos (access_token, refresh_token, expires_at, etc.).
     */
    public function handleOAuthCallback(array $queryOrBody): array;

    /**
     * Refresca el access token (si aplica).
     *
     * @return array Nuevos tokens/metadata.
     */
    public function refreshAccessToken(): array;

    /**
     * Conexión por API Key u otras credenciales estáticas.
     *
     * @param array $credentials ['api_key' => '...', 'api_secret' => '...'] u otros.
     * @return void
     */
    public function connectWithCredentials(array $credentials): void;

    /**
     * Verifica conexión y permisos mínimos.
     *
     * @return array Metadata útil (account_id, account_name, scopes, expires_at, etc.).
     */
    public function verifyConnection(): array;

    /**
     * Desconecta/revoca (si aplica) y limpia credenciales del payload.
     *
     * @return void
     */
    public function disconnect(): void;

    /**
     * Información de la cuenta publicitaria activa (id, nombre, moneda, zona horaria).
     *
     * @return array{account_id?:string,account_name?:string,currency?:string,timezone?:string,extra?:array}
     */
    public function getAccount(): array;

    // -------------------- Entidades (CRUD genérico) --------------------

    /**
     * Lista entidades por nivel.
     *
     * @param string $level "campaign"|"container"|"ad"
     * @param string|null $parentExternalId Requerido para niveles hijos.
     * @param array $params Filtros: status, search, limit, cursor, etc.
     * @return iterable<array<string,mixed>>
     */
    public function listEntities(string $level, ?string $parentExternalId = null, array $params = []): iterable;

    /**
     * Obtiene una entidad puntual por nivel/ID externo.
     *
     * @param string $level "campaign"|"container"|"ad"
     * @param string $externalId
     * @return array<string,mixed>
     */
    public function getEntity(string $level, string $externalId): array;

    /**
     * Crea entidad en la plataforma.
     *
     * @param string $level "campaign"|"container"|"ad"
     * @param array $payload Ver doc de normalización arriba.
     * @param string|null $parentExternalId Requerido para niveles hijos.
     * @return array<string,mixed> Entidad creada.
     */
    public function createEntity(string $level, array $payload, ?string $parentExternalId = null): array;

    /**
     * Actualiza entidad.
     *
     * @param string $level
     * @param string $externalId
     * @param array $payload
     * @return array<string,mixed> Entidad actualizada.
     */
    public function updateEntity(string $level, string $externalId, array $payload): array;

    /**
     * Pausa entidad.
     *
     * @param string $level
     * @param string $externalId
     * @return void
     */
    public function pauseEntity(string $level, string $externalId): void;

    /**
     * Reanuda entidad.
     *
     * @param string $level
     * @param string $externalId
     * @return void
     */
    public function resumeEntity(string $level, string $externalId): void;

    /**
     * Ajustes de presupuesto/puja a cualquier nivel (si aplica).
     *
     * @param string $level "campaign"|"container"|"ad"
     * @param string $externalId
     * @param array $params Ej.: ['budget_daily' => 600.0] o ['bid' => 15.0]
     * @return array<string,mixed> Resultado/estado normalizado.
     */
    public function adjustBudget(string $level, string $externalId, array $params): array;

    /**
     * Ajustes de puja/estrategia (alias explícito si lo separas).
     *
     * @param string $level
     * @param string $externalId
     * @param array $params ['strategy' => 'cpa|roas|...', 'bid' => 10.0]
     * @return array<string,mixed>
     */
    public function adjustBid(string $level, string $externalId, array $params): array;

    // -------------------- Métricas / Costos --------------------

    /**
     * Métricas/costos normalizados por ventana y nivel.
     *
     * @param string $level "campaign"|"container"|"ad"
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @param array $dims Filtros/desgloses (ids, breakdown=date|hour|device, status...)
     * @return iterable<array<string,mixed>>
     */
    public function fetchStats(string $level, DateTimeInterface $from, DateTimeInterface $to, array $dims = []): iterable;

    // -------------------- Leads / Webhooks --------------------

    /**
     * ¿Soporta lead forms/webhooks nativos?
     *
     * @return bool
     */
    public function supportsLeadForms(): bool;

    /**
     * Suscribe un webhook a un tema (p. ej., "leads").
     *
     * @param string $topic "leads"|"conversions"|...
     * @param string $callbackUrl
     * @param array $options verify_token/secret/etc.
     * @return array<string,mixed> Datos de suscripción (id, status, etc.).
     */
    public function subscribeWebhook(string $topic, string $callbackUrl, array $options = []): array;

    /**
     * Cancela una suscripción de webhook.
     *
     * @param string $topic
     * @param string $subscriptionId
     * @return void
     */
    public function unsubscribeWebhook(string $topic, string $subscriptionId): void;

    /**
     * Verifica firma de webhook (si aplica).
     *
     * @param array $headers
     * @param string $rawBody
     * @param string $topic
     * @return bool true si la firma es válida.
     */
    public function verifyWebhookSignature(array $headers, string $rawBody, string $topic): bool;

    /**
     * Normaliza un payload de lead recibido (webhook o polling).
     *
     * @param array $payload Raw de la plataforma.
     * @return array Normalizado: ['external_id' => '...', 'ad_id' => '...', 'campaign_id' => '...', 'fields' => [...], 'created_at' => '...']
     */
    public function normalizeIncomingLead(array $payload): array;

    /**
     * Polling de leads en un rango de tiempo (fallback cuando no hay webhooks).
     *
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @param array $params
     * @return iterable<array<string,mixed>> Filas normalizadas (ver normalizeIncomingLead()).
     */
    public function fetchLeads(DateTimeInterface $from, DateTimeInterface $to, array $params = []): iterable;

    // -------------------- Offline conversions / CRM revenue --------------------

    /**
     * Sube conversiones offline asociadas a click_id o lead_id.
     *
     * @param iterable<array<string,mixed>> $rows
     *   Ejemplo de row:
     *   [
     *     'click_id'   => 'gclid|fbclid|ttclid|...',
     *     'lead_id'    => 'external_lead_id', // opcional
     *     'event_name' => 'Qualified'|'Sale',
     *     'value'      => 100.0,
     *     'currency'   => 'MXN',
     *     'occurred_at'=> '2025-01-01T12:00:00Z',
     *     'order_id'   => 'ABC-123', // opcional
     *   ]
     * @param array $options ['attribution' => 'last_click|...']
     * @return array {success:int, failed:int, errors?:array}
     */
    public function uploadOfflineConversions(iterable $rows, array $options = []): array;

    /**
     * Sube eventos de revenue desde CRM (cuando la plataforma lo soporta).
     *
     * @param iterable<array<string,mixed>> $rows Igual formato que uploadOfflineConversions.
     * @param array $options
     * @return array
     */
    public function uploadCRMRevenue(iterable $rows, array $options = []): array;

    // -------------------- Assets / Creatives --------------------

    /**
     * Lista assets (imágenes, videos, catálogos, etc.).
     *
     * @param array $params Filtros/paginación.
     * @return iterable<array<string,mixed>>
     */
    public function listAssets(array $params = []): iterable;

    /**
     * Sube/crea un asset.
     *
     * @param array $payload ['type' => 'image|video|html5|feed', 'source' => 'path|url|binary', ...]
     * @return array<string,mixed> Asset creado (con external_id).
     */
    public function uploadAsset(array $payload): array;

    /**
     * Actualiza metadatos de un asset (si aplica).
     *
     * @param string $externalId
     * @param array $payload
     * @return array<string,mixed>
     */
    public function updateAsset(string $externalId, array $payload): array;

    /**
     * Archiva/borra asset (si aplica).
     *
     * @param string $externalId
     * @return void
     */
    public function archiveAsset(string $externalId): void;

    // -------------------- Audiences --------------------

    /**
     * Lista audiencias.
     *
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public function listAudiences(array $params = []): iterable;

    /**
     * Crea audiencia (customer list/lookalike/etc.).
     *
     * @param array $payload
     * @return array<string,mixed>
     */
    public function createAudience(array $payload): array;

    /**
     * Añade usuarios a una audiencia (hashing según plataforma).
     *
     * @param string $audienceExternalId
     * @param iterable<array<string,mixed>> $users Ej.: [['email' => 'a@b.com', 'phone' => '+52...'], ...]
     * @param array $options
     * @return array {success:int, failed:int}
     */
    public function addUsersToAudience(string $audienceExternalId, iterable $users, array $options = []): array;

    /**
     * Elimina usuarios de una audiencia (si aplica).
     *
     * @param string $audienceExternalId
     * @param iterable<array<string,mixed>> $users
     * @param array $options
     * @return array
     */
    public function removeUsersFromAudience(string $audienceExternalId, iterable $users, array $options = []): array;

    // -------------------- Keywords / Placements (search/display) --------------------

    /**
     * Lista keywords en un container (si aplica).
     *
     * @param string $containerExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public function listKeywords(string $containerExternalId, array $params = []): iterable;

    /**
     * Crea keywords en un container (si aplica).
     *
     * @param string $containerExternalId
     * @param array $keywords Ej.: [['text' => 'seguro de auto', 'match' => 'exact|phrase|broad', 'bid' => 10.0], ...]
     * @return array<string,mixed>
     */
    public function createKeywords(string $containerExternalId, array $keywords): array;

    /**
     * Elimina keywords por IDs externos (si aplica).
     *
     * @param string $containerExternalId
     * @param array $keywordExternalIds
     * @return void
     */
    public function removeKeywords(string $containerExternalId, array $keywordExternalIds): void;

    /**
     * Lista negative keywords (si aplica).
     *
     * @param string $containerExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public function listNegativeKeywords(string $containerExternalId, array $params = []): iterable;

    /**
     * Añade negative keywords (si aplica).
     *
     * @param string $containerExternalId
     * @param array $keywords ['text' => 'gratis', 'match' => 'phrase']...
     * @return array<string,mixed>
     */
    public function addNegativeKeywords(string $containerExternalId, array $keywords): array;

    /**
     * Lista placements (si aplica).
     *
     * @param string $containerExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public function listPlacements(string $containerExternalId, array $params = []): iterable;

    /**
     * Excluye placements (si aplica).
     *
     * @param string $containerExternalId
     * @param array $placements Ej.: ['youtube.com/channel/xxx', 'mobile_app_123']
     * @return array<string,mixed>
     */
    public function excludePlacements(string $containerExternalId, array $placements): array;

    // -------------------- Experimentos --------------------

    /**
     * Lista experimentos/pruebas A/B.
     *
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public function listExperiments(array $params = []): iterable;

    /**
     * Crea experimento (objetivo, variantes, split).
     *
     * @param array $payload
     * @return array<string,mixed>
     */
    public function createExperiment(array $payload): array;

    /**
     * Inicia experimento.
     *
     * @param string $externalId
     * @return void
     */
    public function startExperiment(string $externalId): void;

    /**
     * Detiene/archiva experimento.
     *
     * @param string $externalId
     * @return void
     */
    public function stopExperiment(string $externalId): void;

    // -------------------- Diagnóstico / Modo sandbox --------------------

    /**
     * Hint de rate limits, cuotas y tiempos de backoff recomendados.
     *
     * @return array {max_requests_per_minute?:int, backoff_seconds?:int, burst?:int, notes?:string}
     */
    public function rateLimitHints(): array;

    /**
     * Estado de salud de la conexión/driver.
     *
     * @return array {ok:bool, last_checked_at?:string, errors?:array, extra?:array}
     */
    public function health(): array;

    /**
     * Activa/desactiva modo sandbox (si la plataforma lo soporta).
     *
     * @param bool $enabled
     * @return void
     */
    public function setSandbox(bool $enabled): void;
}