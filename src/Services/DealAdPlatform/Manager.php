<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform as DealAdPlatformModel;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Support\PlatformRegistry;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Contracts\AdsPlatformDriver;
use DateTimeInterface;

/**
 * Fachada estática para operar con cualquier plataforma de anuncios.
 * Resuelve el driver por `integration_type` y delega todas las operaciones.
 */
final class Manager
{
    /**
     * Registra un driver (integration_type → Driver::class).
     *
     * @param string $integrationType p.ej. "facebook", "google_ads", "tiktok"
     * @param class-string<AdsPlatformDriver> $driverClass
     * @return void
     */
    public static function registerDriver(string $integrationType, string $driverClass): void
    {
        PlatformRegistry::register($integrationType, $driverClass);
    }

    /**
     * Resuelve el driver para un DealAdPlatform (por id o modelo).
     *
     * @param int|DealAdPlatformModel $platform
     * @return AdsPlatformDriver
     */
    public static function adapter(int|DealAdPlatformModel $platform): AdsPlatformDriver
    {
        $model = $platform instanceof DealAdPlatformModel
            ? $platform
            : DealAdPlatformModel::query()->findOrFail($platform);

        return PlatformRegistry::resolve($model);
    }

    // ------------------- Capacidades -------------------

    /**
     * Devuelve el mapa de capacidades del driver.
     *
     * @param int $platformId
     * @return array<string,mixed>
     */
    public static function getCapabilities(int $platformId): array
    {
        return self::adapter($platformId)->getCapabilities();
    }

    // ------------------- Autorización / Conexión -------------------

    /**
     * URL de autorización OAuth (si aplica).
     *
     * @param int $platformId
     * @param string|null $state
     * @param array $scopes
     * @return string
     */
    public static function authorizationUrl(int $platformId, ?string $state = null, array $scopes = []): string
    {
        return self::adapter($platformId)->authorizationUrl($state, $scopes);
    }

    /**
     * Maneja el callback OAuth y persiste tokens.
     *
     * @param int $platformId
     * @param array $queryOrBody
     * @return array
     */
    public static function handleOAuthCallback(int $platformId, array $queryOrBody): array
    {
        return self::adapter($platformId)->handleOAuthCallback($queryOrBody);
    }

    /**
     * Refresca el access token (si aplica).
     *
     * @param int $platformId
     * @return array
     */
    public static function refreshAccessToken(int $platformId): array
    {
        return self::adapter($platformId)->refreshAccessToken();
    }

    /**
     * Conecta por API Key u otras credenciales estáticas.
     *
     * @param int $platformId
     * @param array $credentials
     * @return void
     */
    public static function connectWithCredentials(int $platformId, array $credentials): void
    {
        self::adapter($platformId)->connectWithCredentials($credentials);
    }

    /**
     * Verifica conexión y permisos mínimos.
     *
     * @param int $platformId
     * @return array
     */
    public static function verify(int $platformId): array
    {
        return self::adapter($platformId)->verifyConnection();
    }

    /**
     * Desconecta/revoca (si aplica) y limpia credenciales.
     *
     * @param int $platformId
     * @return void
     */
    public static function disconnect(int $platformId): void
    {
        self::adapter($platformId)->disconnect();
    }

    /**
     * Info de la cuenta publicitaria (id, nombre, moneda, zona horaria).
     *
     * @param int $platformId
     * @return array
     */
    public static function getAccount(int $platformId): array
    {
        return self::adapter($platformId)->getAccount();
    }

    // ------------------- Entidades (CRUD genérico) -------------------

    /**
     * Lista entidades por nivel (campaign|container|ad).
     *
     * @param int $platformId
     * @param string $level
     * @param string|null $parentExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listEntities(int $platformId, string $level, ?string $parentExternalId = null, array $params = []): iterable
    {
        return self::adapter($platformId)->listEntities($level, $parentExternalId, $params);
    }

    /**
     * Obtiene una entidad puntual por nivel/ID externo.
     *
     * @param int $platformId
     * @param string $level
     * @param string $externalId
     * @return array<string,mixed>
     */
    public static function getEntity(int $platformId, string $level, string $externalId): array
    {
        return self::adapter($platformId)->getEntity($level, $externalId);
    }

    /**
     * Crea entidad (campaign|container|ad).
     *
     * @param int $platformId
     * @param string $level
     * @param array $payload
     * @param string|null $parentExternalId
     * @return array<string,mixed>
     */
    public static function createEntity(int $platformId, string $level, array $payload, ?string $parentExternalId = null): array
    {
        return self::adapter($platformId)->createEntity($level, $payload, $parentExternalId);
    }

    /**
     * Actualiza entidad existente.
     *
     * @param int $platformId
     * @param string $level
     * @param string $externalId
     * @param array $payload
     * @return array<string,mixed>
     */
    public static function updateEntity(int $platformId, string $level, string $externalId, array $payload): array
    {
        return self::adapter($platformId)->updateEntity($level, $externalId, $payload);
    }

    /**
     * Pausa entidad.
     *
     * @param int $platformId
     * @param string $level
     * @param string $externalId
     * @return void
     */
    public static function pauseEntity(int $platformId, string $level, string $externalId): void
    {
        self::adapter($platformId)->pauseEntity($level, $externalId);
    }

    /**
     * Reactiva entidad.
     *
     * @param int $platformId
     * @param string $level
     * @param string $externalId
     * @return void
     */
    public static function resumeEntity(int $platformId, string $level, string $externalId): void
    {
        self::adapter($platformId)->resumeEntity($level, $externalId);
    }

    /**
     * Ajusta presupuesto/puja (si aplica).
     *
     * @param int $platformId
     * @param string $level
     * @param string $externalId
     * @param array $params
     * @return array<string,mixed>
     */
    public static function adjustBudget(int $platformId, string $level, string $externalId, array $params): array
    {
        return self::adapter($platformId)->adjustBudget($level, $externalId, $params);
    }

    /**
     * Ajusta estrategia/puja (alias explícito).
     *
     * @param int $platformId
     * @param string $level
     * @param string $externalId
     * @param array $params
     * @return array<string,mixed>
     */
    public static function adjustBid(int $platformId, string $level, string $externalId, array $params): array
    {
        return self::adapter($platformId)->adjustBid($level, $externalId, $params);
    }

    // ------------------- Métricas / Costos -------------------

    /**
     * Métricas/costos por ventana y nivel.
     *
     * @param int $platformId
     * @param string $level
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @param array $dims
     * @return iterable<array<string,mixed>>
     */
    public static function fetchStats(int $platformId, string $level, DateTimeInterface $from, DateTimeInterface $to, array $dims = []): iterable
    {
        return self::adapter($platformId)->fetchStats($level, $from, $to, $dims);
    }

    // ------------------- Leads / Webhooks -------------------

    /**
     * ¿Soporta lead forms/webhooks nativos?
     *
     * @param int $platformId
     * @return bool
     */
    public static function supportsLeadForms(int $platformId): bool
    {
        return self::adapter($platformId)->supportsLeadForms();
    }

    /**
     * Suscribe un webhook (p.ej. "leads").
     *
     * @param int $platformId
     * @param string $topic
     * @param string $callbackUrl
     * @param array $options
     * @return array<string,mixed>
     */
    public static function subscribeWebhook(int $platformId, string $topic, string $callbackUrl, array $options = []): array
    {
        return self::adapter($platformId)->subscribeWebhook($topic, $callbackUrl, $options);
    }

    /**
     * Cancela una suscripción de webhook.
     *
     * @param int $platformId
     * @param string $topic
     * @param string $subscriptionId
     * @return void
     */
    public static function unsubscribeWebhook(int $platformId, string $topic, string $subscriptionId): void
    {
        self::adapter($platformId)->unsubscribeWebhook($topic, $subscriptionId);
    }

    /**
     * Verifica la firma de un webhook.
     *
     * @param int $platformId
     * @param array $headers
     * @param string $rawBody
     * @param string $topic
     * @return bool
     */
    public static function verifyWebhookSignature(int $platformId, array $headers, string $rawBody, string $topic): bool
    {
        return self::adapter($platformId)->verifyWebhookSignature($headers, $rawBody, $topic);
    }

    /**
     * Normaliza un payload de lead recibido.
     *
     * @param int $platformId
     * @param array $payload
     * @return array
     */
    public static function normalizeIncomingLead(int $platformId, array $payload): array
    {
        return self::adapter($platformId)->normalizeIncomingLead($payload);
    }

    /**
     * Polling de leads en rango de tiempo (fallback).
     *
     * @param int $platformId
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function fetchLeads(int $platformId, DateTimeInterface $from, DateTimeInterface $to, array $params = []): iterable
    {
        return self::adapter($platformId)->fetchLeads($from, $to, $params);
    }

    // ------------------- Offline conversions / CRM revenue -------------------

    /**
     * Sube conversiones offline (click_id/lead_id).
     *
     * @param int $platformId
     * @param iterable<array<string,mixed>> $rows
     * @param array $options
     * @return array
     */
    public static function uploadOfflineConversions(int $platformId, iterable $rows, array $options = []): array
    {
        return self::adapter($platformId)->uploadOfflineConversions($rows, $options);
    }

    /**
     * Sube eventos de revenue provenientes del CRM (si aplica).
     *
     * @param int $platformId
     * @param iterable<array<string,mixed>> $rows
     * @param array $options
     * @return array
     */
    public static function uploadCRMRevenue(int $platformId, iterable $rows, array $options = []): array
    {
        return self::adapter($platformId)->uploadCRMRevenue($rows, $options);
    }

    // ------------------- Assets / Creatives -------------------

    /**
     * Lista assets (imágenes, videos, catálogos, etc.).
     *
     * @param int $platformId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listAssets(int $platformId, array $params = []): iterable
    {
        return self::adapter($platformId)->listAssets($params);
    }

    /**
     * Sube/crea un asset.
     *
     * @param int $platformId
     * @param array $payload
     * @return array<string,mixed>
     */
    public static function uploadAsset(int $platformId, array $payload): array
    {
        return self::adapter($platformId)->uploadAsset($payload);
    }

    /**
     * Actualiza metadatos de un asset.
     *
     * @param int $platformId
     * @param string $externalId
     * @param array $payload
     * @return array<string,mixed>
     */
    public static function updateAsset(int $platformId, string $externalId, array $payload): array
    {
        return self::adapter($platformId)->updateAsset($externalId, $payload);
    }

    /**
     * Archiva/borra un asset (si aplica).
     *
     * @param int $platformId
     * @param string $externalId
     * @return void
     */
    public static function archiveAsset(int $platformId, string $externalId): void
    {
        self::adapter($platformId)->archiveAsset($externalId);
    }

    // ------------------- Audiences -------------------

    /**
     * Lista audiencias.
     *
     * @param int $platformId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listAudiences(int $platformId, array $params = []): iterable
    {
        return self::adapter($platformId)->listAudiences($params);
    }

    /**
     * Crea audiencia.
     *
     * @param int $platformId
     * @param array $payload
     * @return array<string,mixed>
     */
    public static function createAudience(int $platformId, array $payload): array
    {
        return self::adapter($platformId)->createAudience($payload);
    }

    /**
     * Añade usuarios a una audiencia.
     *
     * @param int $platformId
     * @param string $audienceExternalId
     * @param iterable<array<string,mixed>> $users
     * @param array $options
     * @return array
     */
    public static function addUsersToAudience(int $platformId, string $audienceExternalId, iterable $users, array $options = []): array
    {
        return self::adapter($platformId)->addUsersToAudience($audienceExternalId, $users, $options);
    }

    /**
     * Elimina usuarios de una audiencia.
     *
     * @param int $platformId
     * @param string $audienceExternalId
     * @param iterable<array<string,mixed>> $users
     * @param array $options
     * @return array
     */
    public static function removeUsersFromAudience(int $platformId, string $audienceExternalId, iterable $users, array $options = []): array
    {
        return self::adapter($platformId)->removeUsersFromAudience($audienceExternalId, $users, $options);
    }

    // ------------------- Keywords / Placements -------------------

    /**
     * Lista keywords del container (si aplica).
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listKeywords(int $platformId, string $containerExternalId, array $params = []): iterable
    {
        return self::adapter($platformId)->listKeywords($containerExternalId, $params);
    }

    /**
     * Crea keywords en un container (si aplica).
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $keywords
     * @return array<string,mixed>
     */
    public static function createKeywords(int $platformId, string $containerExternalId, array $keywords): array
    {
        return self::adapter($platformId)->createKeywords($containerExternalId, $keywords);
    }

    /**
     * Elimina keywords por IDs externos.
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $keywordExternalIds
     * @return void
     */
    public static function removeKeywords(int $platformId, string $containerExternalId, array $keywordExternalIds): void
    {
        self::adapter($platformId)->removeKeywords($containerExternalId, $keywordExternalIds);
    }

    /**
     * Lista negative keywords.
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listNegativeKeywords(int $platformId, string $containerExternalId, array $params = []): iterable
    {
        return self::adapter($platformId)->listNegativeKeywords($containerExternalId, $params);
    }

    /**
     * Añade negative keywords.
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $keywords
     * @return array<string,mixed>
     */
    public static function addNegativeKeywords(int $platformId, string $containerExternalId, array $keywords): array
    {
        return self::adapter($platformId)->addNegativeKeywords($containerExternalId, $keywords);
    }

    /**
     * Lista placements (display/video).
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listPlacements(int $platformId, string $containerExternalId, array $params = []): iterable
    {
        return self::adapter($platformId)->listPlacements($containerExternalId, $params);
    }

    /**
     * Excluye placements en un container.
     *
     * @param int $platformId
     * @param string $containerExternalId
     * @param array $placements
     * @return array<string,mixed>
     */
    public static function excludePlacements(int $platformId, string $containerExternalId, array $placements): array
    {
        return self::adapter($platformId)->excludePlacements($containerExternalId, $placements);
    }

    // ------------------- Experimentos -------------------

    /**
     * Lista experimentos/pruebas A/B.
     *
     * @param int $platformId
     * @param array $params
     * @return iterable<array<string,mixed>>
     */
    public static function listExperiments(int $platformId, array $params = []): iterable
    {
        return self::adapter($platformId)->listExperiments($params);
    }

    /**
     * Crea experimento.
     *
     * @param int $platformId
     * @param array $payload
     * @return array<string,mixed>
     */
    public static function createExperiment(int $platformId, array $payload): array
    {
        return self::adapter($platformId)->createExperiment($payload);
    }

    /**
     * Inicia experimento.
     *
     * @param int $platformId
     * @param string $externalId
     * @return void
     */
    public static function startExperiment(int $platformId, string $externalId): void
    {
        self::adapter($platformId)->startExperiment($externalId);
    }

    /**
     * Detiene experimento.
     *
     * @param int $platformId
     * @param string $externalId
     * @return void
     */
    public static function stopExperiment(int $platformId, string $externalId): void
    {
        self::adapter($platformId)->stopExperiment($externalId);
    }

    // ------------------- Diagnóstico -------------------

    /**
     * Sugerencias de rate limits/backoff del driver.
     *
     * @param int $platformId
     * @return array<string,mixed>
     */
    public static function rateLimitHints(int $platformId): array
    {
        return self::adapter($platformId)->rateLimitHints();
    }

    /**
     * Estado de salud del driver/conexión.
     *
     * @param int $platformId
     * @return array<string,mixed>
     */
    public static function health(int $platformId): array
    {
        return self::adapter($platformId)->health();
    }

    /**
     * Activa/desactiva modo sandbox (si la plataforma lo soporta).
     *
     * @param int $platformId
     * @param bool $enabled
     * @return void
     */
    public static function setSandbox(int $platformId, bool $enabled): void
    {
        self::adapter($platformId)->setSandbox($enabled);
    }
}
