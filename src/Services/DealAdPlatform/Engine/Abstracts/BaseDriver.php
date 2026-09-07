<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Abstracts;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Contracts\AdsPlatformDriver;
use Illuminate\Support\Facades\Log;
use DateTimeInterface;

abstract class BaseDriver implements AdsPlatformDriver
{
    protected ?DealAdPlatform $platform = null;

    public function using(DealAdPlatform $platform): static
    {
        $this->platform = $platform;
        return $this;
    }

    public function getCapabilities(): array
    {
        return [
            'oauth' => false,
            'api_key' => false,
            'entities' => ['campaign' => true, 'container' => true, 'ad' => true],
            'lead_forms' => false,
            'assets' => false,
            'audiences' => false,
            'keywords' => false,
            'placements' => false,
            'experiments' => false,
            'offline_conversions' => false,
            'webhooks' => ['leads' => false, 'conversions' => false],
        ];
    }

    // -------------------- Auth --------------------

    public function authorizationUrl(?string $state = null, array $scopes = []): string
    {
        $this->unsupported(__FUNCTION__);
        return '';
    }

    public function handleOAuthCallback(array $queryOrBody): array
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    public function refreshAccessToken(): array
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    public function connectWithCredentials(array $credentials): void
    {
        $this->unsupported(__FUNCTION__);
    }

    public function verifyConnection(): array
    {
        $this->unsupported(__FUNCTION__);
        return ['ok' => false];
    }

    public function disconnect(): void
    {
        $this->unsupported(__FUNCTION__);
    }

    public function getAccount(): array
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    // -------------------- Entities --------------------

    public function listEntities(string $level, ?string $parentExternalId = null, array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__, compact('level', 'parentExternalId'));
        return [];
    }

    public function getEntity(string $level, string $externalId): array
    {
        $this->unsupported(__FUNCTION__, compact('level', 'externalId'));
        return [];
    }

    public function createEntity(string $level, array $payload, ?string $parentExternalId = null): array
    {
        $this->unsupported(__FUNCTION__, compact('level'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function updateEntity(string $level, string $externalId, array $payload): array
    {
        $this->unsupported(__FUNCTION__, compact('level', 'externalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function pauseEntity(string $level, string $externalId): void
    {
        $this->unsupported(__FUNCTION__, compact('level', 'externalId'));
    }

    public function resumeEntity(string $level, string $externalId): void
    {
        $this->unsupported(__FUNCTION__, compact('level', 'externalId'));
    }

    public function adjustBudget(string $level, string $externalId, array $params): array
    {
        $this->unsupported(__FUNCTION__, compact('level', 'externalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function adjustBid(string $level, string $externalId, array $params): array
    {
        $this->unsupported(__FUNCTION__, compact('level', 'externalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    // -------------------- Stats --------------------

    public function fetchStats(string $level, DateTimeInterface $from, DateTimeInterface $to, array $dims = []): iterable
    {
        $this->unsupported(__FUNCTION__, compact('level'));
        return [];
    }

    // -------------------- Leads / Webhooks --------------------

    public function supportsLeadForms(): bool
    {
        return false;
    }

    public function subscribeWebhook(string $topic, string $callbackUrl, array $options = []): array
    {
        $this->unsupported(__FUNCTION__, compact('topic'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function unsubscribeWebhook(string $topic, string $subscriptionId): void
    {
        $this->unsupported(__FUNCTION__, compact('topic', 'subscriptionId'));
    }

    public function verifyWebhookSignature(array $headers, string $rawBody, string $topic): bool
    {
        $this->unsupported(__FUNCTION__, compact('topic'));
        return false;
    }

    public function normalizeIncomingLead(array $payload): array
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    public function fetchLeads(DateTimeInterface $from, DateTimeInterface $to, array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    // -------------------- Offline conversions / CRM revenue --------------------

    public function uploadOfflineConversions(iterable $rows, array $options = []): array
    {
        $this->unsupported(__FUNCTION__);
        return ['success' => 0, 'failed' => 0];
    }

    public function uploadCRMRevenue(iterable $rows, array $options = []): array
    {
        $this->unsupported(__FUNCTION__);
        return ['success' => 0, 'failed' => 0];
    }

    // -------------------- Assets --------------------

    public function listAssets(array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    public function uploadAsset(array $payload): array
    {
        $this->unsupported(__FUNCTION__);
        return ['ok' => false, 'unsupported' => true];
    }

    public function updateAsset(string $externalId, array $payload): array
    {
        $this->unsupported(__FUNCTION__, compact('externalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function archiveAsset(string $externalId): void
    {
        $this->unsupported(__FUNCTION__, compact('externalId'));
    }

    // -------------------- Audiences --------------------

    public function listAudiences(array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    public function createAudience(array $payload): array
    {
        $this->unsupported(__FUNCTION__);
        return ['ok' => false, 'unsupported' => true];
    }

    public function addUsersToAudience(string $audienceExternalId, iterable $users, array $options = []): array
    {
        $this->unsupported(__FUNCTION__, compact('audienceExternalId'));
        return ['success' => 0, 'failed' => 0];
    }

    public function removeUsersFromAudience(string $audienceExternalId, iterable $users, array $options = []): array
    {
        $this->unsupported(__FUNCTION__, compact('audienceExternalId'));
        return ['success' => 0, 'failed' => 0];
    }

    // -------------------- Keywords / Placements --------------------

    public function listKeywords(string $containerExternalId, array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
        return [];
    }

    public function createKeywords(string $containerExternalId, array $keywords): array
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function removeKeywords(string $containerExternalId, array $keywordExternalIds): void
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
    }

    public function listNegativeKeywords(string $containerExternalId, array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
        return [];
    }

    public function addNegativeKeywords(string $containerExternalId, array $keywords): array
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    public function listPlacements(string $containerExternalId, array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
        return [];
    }

    public function excludePlacements(string $containerExternalId, array $placements): array
    {
        $this->unsupported(__FUNCTION__, compact('containerExternalId'));
        return ['ok' => false, 'unsupported' => true];
    }

    // -------------------- Experimentos --------------------

    public function listExperiments(array $params = []): iterable
    {
        $this->unsupported(__FUNCTION__);
        return [];
    }

    public function createExperiment(array $payload): array
    {
        $this->unsupported(__FUNCTION__);
        return ['ok' => false, 'unsupported' => true];
    }

    public function startExperiment(string $externalId): void
    {
        $this->unsupported(__FUNCTION__, compact('externalId'));
    }

    public function stopExperiment(string $externalId): void
    {
        $this->unsupported(__FUNCTION__, compact('externalId'));
    }

    // -------------------- Diagnóstico --------------------

    public function rateLimitHints(): array
    {
        return ['notes' => 'No rate limit hints provided by base driver.'];
    }

    public function health(): array
    {
        return ['ok' => true, 'extra' => ['driver' => static::class]];
    }

    public function setSandbox(bool $enabled): void
    {
        $this->unsupported(__FUNCTION__, ['enabled' => $enabled]);
    }

    // -------------------- Utils --------------------

    /**
     * Log estandarizado de features no soportados.
     */
    protected function unsupported(string $method, array $context = []): void
    {
        try {
            $ctx = array_merge([
                'driver' => static::class,
                'platform_id' => $this->platform->id ?? null,
                'integration_type' => $this->platform->integration_type ?? null,
                'message' => 'Feature not supported by this driver.',
            ], $context);

            Log::warning("AdsDriver unsupported method: {$method}", $ctx);
        } catch (\Throwable $e) {
            // Evitar que un fallo de log rompa el flujo.
        }
    }

    /**
     * Mapea estados de plataforma a estandar: enabled|paused|removed|draft.
     */
    protected function normalizeStatus(string $platformStatus): string
    {
        $map = [
            'ACTIVE' => 'enabled', 'ENABLED' => 'enabled', 'ON' => 'enabled', 'RUNNING' => 'enabled',
            'PAUSED' => 'paused', 'OFF' => 'paused', 'STOPPED' => 'paused',
            'DELETED' => 'removed', 'REMOVED' => 'removed',
            'DRAFT' => 'draft',
        ];
        return $map[strtoupper($platformStatus)] ?? 'enabled';
    }
}
