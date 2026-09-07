<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google;

use DateTimeInterface;
use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\BaseDriver;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Contracts\AdsPlatformDriver;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support\ClientFactory;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support\Gaql;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support\Mappers;

use Google\Ads\GoogleAds\V21\Services\SearchGoogleAdsStreamRequest;
use Google\Ads\GoogleAds\V21\Services\SearchGoogleAdsRequest;
use Google\Ads\GoogleAds\V21\Services\GoogleAdsServiceClient;

use Google\Ads\GoogleAds\V21\Resources\Campaign;
use Google\Ads\GoogleAds\V21\Resources\CampaignBudget;
use Google\Ads\GoogleAds\V21\Resources\AdGroup;
use Google\Ads\GoogleAds\V21\Resources\AdGroupCriterion;
use Google\Ads\GoogleAds\V21\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V21\Resources\Asset;

use Google\Ads\GoogleAds\V21\Services\CampaignOperation;
use Google\Ads\GoogleAds\V21\Services\CampaignBudgetOperation;
use Google\Ads\GoogleAds\V21\Services\MutateCampaignsRequest;
use Google\Ads\GoogleAds\V21\Services\MutateCampaignBudgetsRequest;

use Google\Ads\GoogleAds\V21\Services\AdGroupOperation;
use Google\Ads\GoogleAds\V21\Services\MutateAdGroupsRequest;

use Google\Ads\GoogleAds\V21\Services\AdGroupCriterionOperation;
use Google\Ads\GoogleAds\V21\Services\MutateAdGroupCriteriaRequest;

use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Services\MutateAdGroupAdsRequest;

use Google\Ads\GoogleAds\V21\Services\AssetOperation;
use Google\Ads\GoogleAds\V21\Services\MutateAssetsRequest;

use Google\Ads\GoogleAds\V21\Services\UploadClickConversionsRequest;
use Google\Ads\GoogleAds\V21\Services\ClickConversion;

use Google\Ads\GoogleAds\V21\Common\ManualCpc;
use Google\Ads\GoogleAds\V21\Common\ResponsiveSearchAdInfo;
use Google\Ads\GoogleAds\V21\Common\AdTextAsset;
use Google\Ads\GoogleAds\V21\Common\KeywordInfo;
use Google\Ads\GoogleAds\V21\Common\PlacementInfo;
use Google\Ads\GoogleAds\V21\Common\TextAsset as TextAssetInfo;
use Google\Ads\GoogleAds\V21\Common\ImageAsset as ImageAssetInfo;

use Google\Ads\GoogleAds\V21\Enums\CampaignStatusEnum\CampaignStatus;
use Google\Ads\GoogleAds\V21\Enums\AdvertisingChannelTypeEnum\AdvertisingChannelType;
use Google\Ads\GoogleAds\V21\Enums\AdGroupStatusEnum\AdGroupStatus;
use Google\Ads\GoogleAds\V21\Enums\AdGroupTypeEnum\AdGroupType;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;
use Google\Ads\GoogleAds\V21\Enums\AdGroupCriterionStatusEnum\AdGroupCriterionStatus;
use Google\Ads\GoogleAds\V21\Enums\KeywordMatchTypeEnum\KeywordMatchType;
use Google\Ads\GoogleAds\V21\Enums\AssetTypeEnum\AssetType;

use Google\Ads\GoogleAds\Util\V21\ResourceNames;
use Google\Ads\GoogleAds\Util\V21\FieldMasks;
use Google\Protobuf\FieldMask;

use Google\Auth\OAuth2;
use InvalidArgumentException;

/**
 * GoogleAdsDriver (v21) — implementación única SIN traits.
 *
 * Nota: Todas las consultas GAQL se hacen vía Support\Gaql.
 */
final class GoogleAdsDriver extends BaseDriver implements AdsPlatformDriver
{
    private ?DealAdPlatform $platform = null;
    private bool $sandbox = false;

    /* ====================== BOOT / CAPABILITIES ====================== */

    public function using(DealAdPlatform $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    public function getCapabilities(): array
    {
        return [
            'oauth' => true,
            'api_key' => false,
            'entities' => ['campaign' => true, 'container' => true, 'ad' => true],
            'lead_forms' => true,
            'assets' => true,
            'audiences' => false,      // implementar después si lo necesitas
            'keywords' => true,
            'placements' => true,
            'experiments' => false,    // implementar después si lo necesitas
            'offline_conversions' => true,
            'webhooks' => ['leads' => true, 'conversions' => false],
        ];
    }

    /* ====================== OAUTH / CONEXIÓN ====================== */

    public function authorizationUrl(?string $state = null, array $scopes = []): string
    {
        $creds = (array)$this->platform->getPayload('credentials', []);
        $clientId = (string)($creds['client_id'] ?? '');
        $redirectUri = (string)($creds['redirect_uri'] ?? '');
        if ($clientId === '' || $redirectUri === '') {
            throw new InvalidArgumentException('Faltan client_id o redirect_uri para generar la URL de autorización.');
        }

        $scopes = $scopes ?: ['https://www.googleapis.com/auth/adwords'];

        $params = [
            'response_type' => 'code',
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'scope'         => implode(' ', $scopes),
            'access_type'   => 'offline',
            'prompt'        => 'consent',
        ];
        if ($state !== null) {
            $params['state'] = $state;
        }

        return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
    }

    public function handleOAuthCallback(array $queryOrBody): array
    {
        $creds = (array)$this->platform->getPayload('credentials', []);
        $clientId = (string)($creds['client_id'] ?? '');
        $clientSecret = (string)($creds['client_secret'] ?? '');
        $redirectUri = (string)($creds['redirect_uri'] ?? '');

        $code = (string)($queryOrBody['code'] ?? '');
        if ($clientId === '' || $clientSecret === '' || $redirectUri === '' || $code === '') {
            throw new InvalidArgumentException('Datos insuficientes para intercambio de tokens OAuth.');
        }

        $oauth = new OAuth2([
            'clientId'        => $clientId,
            'clientSecret'    => $clientSecret,
            'authorizationUri'=> 'https://accounts.google.com/o/oauth2/v2/auth',
            'tokenCredentialUri' => 'https://oauth2.googleapis.com/token',
            'redirectUri'     => $redirectUri,
            'scope'           => ['https://www.googleapis.com/auth/adwords'],
        ]);
        $oauth->setCode($code);

        $tokens = $oauth->fetchAuthToken(); // ['access_token','expires_in','refresh_token',...]
        // Devuelve para que tu app lo persista en DealAdPlatform->payload['credentials'].
        return [
            'ok' => true,
            'tokens' => $tokens,
        ];
    }

    public function refreshAccessToken(): array
    {
        $creds = (array)$this->platform->getPayload('credentials', []);
        $clientId = (string)($creds['client_id'] ?? '');
        $clientSecret = (string)($creds['client_secret'] ?? '');
        $refresh = (string)($creds['refresh_token'] ?? '');

        if ($clientId === '' || $clientSecret === '' || $refresh === '') {
            throw new InvalidArgumentException('Faltan client_id/client_secret/refresh_token para refrescar token.');
        }

        $oauth = new OAuth2([
            'clientId'        => $clientId,
            'clientSecret'    => $clientSecret,
            'tokenCredentialUri' => 'https://oauth2.googleapis.com/token',
        ]);
        $oauth->setRefreshToken($refresh);
        $tokens = $oauth->fetchAuthToken();

        return ['ok' => true, 'tokens' => $tokens];
    }

    public function connectWithCredentials(array $credentials): void
    {
        // Para Google Ads, típico es OAuth; si quieres soportar API Key,
        // podrías guardar aquí metadatos. Por ahora no-op.
    }

    public function verifyConnection(): array
    {
        $client = $this->gads();
        $cid = $this->customerId();

        $it = $client->getGoogleAdsServiceClient()->search($cid, Gaql::selectCustomerPing());
        foreach ($it as $row) {
            return [
                'ok' => true,
                'account_id' => (string)$row->getCustomer()->getId(),
                'account_name' => (string)$row->getCustomer()->getDescriptiveName(),
                'scopes' => ['adwords'],
            ];
        }
        return ['ok' => true];
    }

    public function disconnect(): void
    {
        // Si quieres revocar, aquí harías la llamada a revokeToken.
        // Por defecto no hace nada; tu app puede limpiar payload.
    }

    public function getAccount(): array
    {
        $client = $this->gads();
        $cid = $this->customerId();

        $it = $client->getGoogleAdsServiceClient()->search($cid, "SELECT customer.id, customer.descriptive_name, customer.currency_code, customer.time_zone FROM customer LIMIT 1");
        foreach ($it as $row) {
            return [
                'account_id'   => (string)$row->getCustomer()->getId(),
                'account_name' => (string)$row->getCustomer()->getDescriptiveName(),
                'currency'     => (string)$row->getCustomer()->getCurrencyCode(),
                'timezone'     => (string)$row->getCustomer()->getTimeZone(),
            ];
        }
        return [];
    }

    /* ====================== ENTIDADES (CRUD) ====================== */

    public function listEntities(string $level, ?string $parentExternalId = null, array $params = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        if ($level === 'campaign') {
            $status = $params['status'] ?? null;
            $statusFilter = null;
            if (is_string($status) && $status !== '') {
                $statusFilter = preg_replace('/[^A-Z_]/', '', strtoupper($status));
            }
            $search = $params['search'] ?? null;
            $query  = Gaql::selectCampaigns($statusFilter, is_string($search) ? $search : null);

            $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $query));
            foreach ($stream->iterateAllElements() as $row) {
                yield Mappers::normalizeCampaignRow(json_decode($row->serializeToJsonString(), true));
            }
            return;
        }

        if ($level === 'container') {
            if (!$parentExternalId) return [];
            $type = strtolower((string)($params['type'] ?? 'ad_group'));

            if ($type === 'asset_group') {
                $q = Gaql::selectAssetGroupsByCampaign((string)(int)$parentExternalId);
                $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
                foreach ($stream->iterateAllElements() as $row) {
                    $ag = $row->getAssetGroup();
                    yield [
                        'external_id' => (string)$ag->getId(),
                        'campaign_id' => (string)$parentExternalId,
                        'name'        => (string)$ag->getName(),
                        'status'      => Mappers::statusToUnified((string)$ag->getStatus()),
                        'metadata'    => ['raw' => json_decode($row->serializeToJsonString(), true)],
                    ];
                }
                return;
            }

            // ad_groups
            $q = Gaql::selectAdGroups((string)(int)$parentExternalId);
            $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
            foreach ($stream->iterateAllElements() as $row) {
                $g = $row->getAdGroup();
                yield [
                    'external_id' => (string)$g->getId(),
                    'campaign_id' => (string)$parentExternalId,
                    'name'        => (string)$g->getName(),
                    'status'      => Mappers::statusToUnified((string)$g->getStatus()),
                    'type'        => \Google\Ads\GoogleAds\V21\Enums\AdGroupTypeEnum\AdGroupType::name($g->getType()),
                    'metadata'    => ['raw' => json_decode($row->serializeToJsonString(), true)],
                ];
            }
            return;
        }

        if ($level === 'ad') {
            // requiere ad_group_id como parent (para Search/Display/Video)
            $adGroupId = $params['ad_group_id'] ?? $parentExternalId;
            if (!$adGroupId) return [];
            $q = Gaql::selectAds((string)(int)$adGroupId);
            $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
            foreach ($stream->iterateAllElements() as $row) {
                $aga = $row->getAdGroupAd();
                $ad  = $aga->getAd();
                yield [
                    'external_id'  => (string)$ad->getId(),
                    'container_id' => (string)$adGroupId,
                    'name'         => (string)($ad->getName() ?: $ad->getId()),
                    'status'       => Mappers::statusToUnified((string)$aga->getStatus()),
                    'format'       => $this->detectAdFormat($ad),
                    'metadata'     => ['raw' => json_decode($row->serializeToJsonString(), true)],
                ];
            }
            return;
        }

        return [];
    }

    public function getEntity(string $level, string $externalId): array
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        if ($level === 'campaign') {
            $it = $svc->search($cid, Gaql::selectCampaignById((string)(int)$externalId));
            foreach ($it as $row) {
                return Mappers::normalizeCampaignRow(json_decode($row->serializeToJsonString(), true));
            }
            return ['ok' => false, 'error' => 'not_found'];
        }

        // Para container/ad: si necesitas exacto por ID, añade las GAQL helpers:
        // - Gaql::selectAdGroupById($adGroupId)
        // - Gaql::selectAssetGroupById($assetGroupId)
        // - Gaql::selectAdById($adId)
        return ['ok' => false, 'unsupported' => true];
    }

    public function createEntity(string $level, array $payload, ?string $parentExternalId = null): array
    {
        if ($level === 'campaign') {
            return $this->createCampaign($payload);
        }

        if ($level === 'container') {
            return $this->createContainer($payload, $parentExternalId);
        }

        if ($level === 'ad') {
            return $this->createAd($payload, $parentExternalId);
        }

        return ['ok' => false, 'unsupported' => true];
    }

    public function updateEntity(string $level, string $externalId, array $payload): array
    {
        if ($level === 'campaign') {
            return $this->updateCampaign($externalId, $payload);
        }
        if ($level === 'container') {
            return $this->updateAdGroup($externalId, $payload);
        }
        if ($level === 'ad') {
            return $this->updateAdGroupAd($externalId, $payload);
        }
        return ['ok' => false, 'unsupported' => true];
    }

    public function pauseEntity(string $level, string $externalId): void
    {
        $this->setEntityStatus($level, $externalId, 'paused');
    }

    public function resumeEntity(string $level, string $externalId): void
    {
        $this->setEntityStatus($level, $externalId, 'enabled');
    }

    public function adjustBudget(string $level, string $externalId, array $params): array
    {
        if ($level !== 'campaign') {
            return ['ok' => false, 'unsupported' => true];
        }
        $client = $this->gads();
        $cid    = $this->customerId();
        $svc    = $client->getGoogleAdsServiceClient();

        $gaql = Gaql::selectCampaignBudgetResource((string)(int)$externalId);
        $iter = $svc->search($cid, $gaql);

        $budgetRes = null;
        foreach ($iter as $row) {
            $budgetRes = $row->getCampaign()->getCampaignBudget();
            break;
        }
        if (!$budgetRes) return ['ok' => false, 'error' => 'Budget not found'];

        $amount = isset($params['amount_micros'])
            ? (int)$params['amount_micros']
            : (int)round(((float)($params['amount'] ?? 0)) * 1_000_000);

        if ($amount <= 0) return ['ok' => false, 'error' => 'amount must be > 0'];

        $before = new CampaignBudget(['resource_name' => $budgetRes]);
        $after  = new CampaignBudget(['resource_name' => $budgetRes, 'amount_micros' => $amount]);
        $mask   = FieldMasks::compare($before, $after);

        $op = new CampaignBudgetOperation();
        $op->setUpdate($after);
        $op->setUpdateMask($mask);

        $bsvc = $client->getCampaignBudgetServiceClient();
        $res  = $bsvc->mutateCampaignBudgets(MutateCampaignBudgetsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    public function adjustBid(string $level, string $externalId, array $params): array
    {
        if ($level !== 'container') {
            return ['ok' => false, 'unsupported' => true];
        }
        $client = $this->gads();
        $cid    = $this->customerId();

        $bidMicros = isset($params['bid_micros'])
            ? (int)$params['bid_micros']
            : (int)round(((float)($params['bid'] ?? 0)) * 1_000_000);

        $adGroup = new AdGroup([
            'resource_name' => ResourceNames::forAdGroup($cid, (int)$externalId),
            'cpc_bid_micros' => $bidMicros,
        ]);
        $op = new AdGroupOperation();
        $op->setUpdate($adGroup);
        $op->setUpdateMask(FieldMasks::allSetFieldsOf($adGroup));
        $res = $client->getAdGroupServiceClient()->mutateAdGroups(MutateAdGroupsRequest::build($cid, [$op]));

        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    /* ====================== MÉTRICAS ====================== */

    public function fetchStats(string $level, DateTimeInterface $from, DateTimeInterface $to, array $dims = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        $query = empty($dims['ids'])
            ? Gaql::statsByLevel($level, $from->format('Y-m-d'), $to->format('Y-m-d'))
            : Gaql::statsByLevelWithIds($level, $from->format('Y-m-d'), $to->format('Y-m-d'), (array)$dims['ids']);

        $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $query));

        foreach ($stream->iterateAllElements() as $row) {
            $raw = json_decode($row->serializeToJsonString(), true);
            if ($level === 'campaign') {
                $ids = ['self' => (string)$row->getCampaign()->getId(), 'campaign' => null, 'container' => null];
            } elseif ($level === 'container') {
                $ids = ['self' => (string)$row->getAdGroup()->getId(), 'campaign' => (string)$row->getCampaign()->getId()];
            } else {
                $ids = [
                    'self'      => (string)$row->getAdGroupAd()->getAd()->getId(),
                    'campaign'  => (string)$row->getCampaign()->getId(),
                    'container' => (string)$row->getAdGroup()->getId(),
                ];
            }
            yield Mappers::normalizeStatsRow($raw, $level, $ids);
        }
    }

    /* ====================== LEADS / WEBHOOKS ====================== */

    public function supportsLeadForms(): bool { return true; }

    public function subscribeWebhook(string $topic, string $callbackUrl, array $options = []): array
    {
        // En Google Ads se configura en el Asset del Lead Form (manual/API).
        // Aquí solo registramos/confirmamos metadatos.
        return ['ok' => true, 'topic' => $topic, 'callback_url' => $callbackUrl, 'options' => $options];
    }

    public function unsubscribeWebhook(string $topic, string $subscriptionId): void
    {
        // No-op: depende de cómo hayas guardado tuscripciones en tu app.
    }

    public function verifyWebhookSignature(array $headers, string $rawBody, string $topic): bool
    {
        // Implementa tu convención; Google Ads no firma con secreto compartido.
        return true;
    }

    public function normalizeIncomingLead(array $payload): array
    {
        return [
            'external_id' => (string)($payload['lead_id'] ?? $payload['external_id'] ?? ''),
            'ad_id'       => (string)($payload['ad_id'] ?? ''),
            'campaign_id' => (string)($payload['campaign_id'] ?? ''),
            'fields'      => (array)($payload['fields'] ?? []),
            'created_at'  => (string)($payload['created_at'] ?? ''),
            'metadata'    => ['raw' => $payload],
        ];
    }

    public function fetchLeads(DateTimeInterface $from, DateTimeInterface $to, array $params = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        $q = Gaql::selectLeadFormSubmissions(
            $from->format('Y-m-d'),
            $to->format('Y-m-d'),
            isset($params['campaign_id']) ? (string)(int)$params['campaign_id'] : null
        );

        $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
        foreach ($stream->iterateAllElements() as $row) {
            $d = $row->getLeadFormSubmissionData();
            yield [
                'external_id' => (string)$d->getLeadFormSubmissionDataResourceName(),
                'ad_id'       => (string)basename($d->getAdGroupAd()),
                'campaign_id' => (string)basename($d->getCampaign()),
                'fields'      => [
                    'gclid' => $d->getGclId(),
                    'custom_fields' => json_decode($row->serializeToJsonString(), true)['leadFormSubmissionData']['customLeadFormFieldUserInput'] ?? [],
                ],
                'created_at'  => (string)$d->getSubmissionDateTime(),
            ];
        }
    }

    /* ====================== OFFLINE CONVERSIONS ====================== */

    public function uploadOfflineConversions(iterable $rows, array $options = []): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();
        $svc    = $client->getConversionUploadServiceClient();

        $ok = 0; $fail = 0; $errors = [];

        foreach ($rows as $i => $row) {
            try {
                $convActionRes = $row['conversion_action_resource'] ?? null;
                $convActionId  = $row['conversion_action_id'] ?? null;

                if (!$convActionRes && $convActionId) {
                    $convActionRes = ResourceNames::forConversionAction($cid, (int)$convActionId);
                }
                if (!$convActionRes) {
                    throw new InvalidArgumentException('Se requiere conversion_action_resource o conversion_action_id en cada fila.');
                }

                $occurred = (string)($row['occurred_at'] ?? '');
                if ($occurred === '') {
                    throw new InvalidArgumentException('occurred_at es requerido (RFC3339 o "Y-m-d H:i:sP").');
                }

                $value    = (float)($row['value'] ?? 0.0);
                $currency = (string)($row['currency'] ?? 'USD');

                $conversion = new ClickConversion([
                    'conversion_action'   => $convActionRes,
                    'gclid'               => (string)($row['click_id'] ?? ''), // asume GCLID aquí
                    'conversion_value'    => $value,
                    'conversion_date_time'=> $occurred,
                    'currency_code'       => $currency,
                    'order_id'            => (string)($row['order_id'] ?? ''),
                ]);

                $req = new UploadClickConversionsRequest();
                $req->setCustomerId($cid);
                $req->setConversions([$conversion]);
                $req->setPartialFailure(true);

                $resp = $svc->uploadClickConversions($req);
                $err = $resp->getPartialFailureError();
                if ($err) {
                    $fail++;
                    $errors[] = $err->getMessage();
                } else {
                    $ok++;
                }
            } catch (\Throwable $e) {
                $fail++;
                $errors[] = $e->getMessage();
            }
        }

        $out = ['success' => $ok, 'failed' => $fail];
        if ($errors) $out['errors'] = $errors;
        return $out;
    }

    public function uploadCRMRevenue(iterable $rows, array $options = []): array
    {
        // En Google Ads suele ser el mismo flujo que uploadOfflineConversions
        // pero pasando conversion_value/currency/order_id. Reutiliza el de arriba.
        return $this->uploadOfflineConversions($rows, $options);
    }

    /* ====================== ASSETS ====================== */

    public function listAssets(array $params = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        $types = $params['types'] ?? [];
        $q     = Gaql::selectAssets(is_array($types) ? $types : []);

        $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
        foreach ($stream->iterateAllElements() as $row) {
            $a = $row->getAsset();
            yield [
                'external_id' => (string)$a->getId(),
                'resource'    => $a->getResourceName(),
                'name'        => (string)$a->getName(),
                'type'        => $a->getType(),
            ];
        }
    }

    public function uploadAsset(array $payload): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $type = strtoupper((string)($payload['type'] ?? 'TEXT'));
        $name = (string)($payload['name'] ?? ('asset-'.date('c')));

        $asset = new Asset(['name' => $name]);

        if ($type === 'TEXT') {
            $text = (string)($payload['text'] ?? '');
            $asset->setTextAsset(new TextAssetInfo(['text' => $text]));
        } elseif ($type === 'IMAGE') {
            // source: base64 (data:image/*;base64,...) o path
            $binary = $this->resolveImageBinary($payload);
            $asset->setImageAsset(new ImageAssetInfo(['data' => $binary]));
        } else {
            return ['ok' => false, 'unsupported' => true];
        }

        $op = new AssetOperation();
        $op->setCreate($asset);

        $res = $client->getAssetServiceClient()->mutateAssets(MutateAssetsRequest::build($cid, [$op]));
        $rn  = $res->getResults()[0]->getResourceName();

        return ['ok' => true, 'resource' => $rn];
    }

    public function updateAsset(string $externalId, array $payload): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $asset = new Asset(['resource_name' => ResourceNames::forAsset($cid, (int)$externalId)]);

        if (isset($payload['name'])) $asset->setName((string)$payload['name']);

        $mask = FieldMasks::allSetFieldsOf($asset);
        $op   = new AssetOperation();
        $op->setUpdate($asset);
        $op->setUpdateMask($mask);

        $res = $client->getAssetServiceClient()->mutateAssets(MutateAssetsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    public function archiveAsset(string $externalId): void
    {
        // Google Ads no permite "borrar" todos los assets; usualmente se desvinculan.
        // Aquí podrías implementar remove, pero requiere constraints. Lo dejamos no-op.
    }

    /* ====================== AUDIENCES (PENDIENTE) ====================== */

    public function listAudiences(array $params = []): iterable
    {
        // Implementar con GAQL a user_list si lo necesitas.
        return [];
    }

    public function createAudience(array $payload): array
    {
        return ['ok' => false, 'unsupported' => true];
    }

    public function addUsersToAudience(string $audienceExternalId, iterable $users, array $options = []): array
    {
        return ['success' => 0, 'failed' => 0, 'unsupported' => true];
    }

    public function removeUsersFromAudience(string $audienceExternalId, iterable $users, array $options = []): array
    {
        return ['success' => 0, 'failed' => 0, 'unsupported' => true];
    }

    /* ====================== KEYWORDS / PLACEMENTS ====================== */

    public function listKeywords(string $containerExternalId, array $params = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        $q = Gaql::selectKeywordsByAdGroup((string)(int)$containerExternalId);
        $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
        foreach ($stream->iterateAllElements() as $row) {
            $c = $row->getAdGroupCriterion();
            yield [
                'external_id' => (string)$c->getCriterionId(),
                'ad_group_id' => (string)$containerExternalId,
                'text'        => $c->getKeyword()->getText(),
                'match'       => KeywordMatchType::name($c->getKeyword()->getMatchType()),
                'negative'    => (bool)$c->getNegative(),
                'status'      => Mappers::statusToUnified((string)$c->getStatus()),
            ];
        }
    }

    public function createKeywords(string $containerExternalId, array $keywords): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $ops = [];
        foreach ($keywords as $k) {
            $text = (string)($k['text'] ?? '');
            $match = strtoupper((string)($k['match'] ?? 'BROAD'));
            $neg   = (bool)($k['negative'] ?? false);

            $crit = new AdGroupCriterion([
                'ad_group' => ResourceNames::forAdGroup($cid, (int)$containerExternalId),
                'status'   => AdGroupCriterionStatus::ENABLED,
                'negative' => $neg,
                'keyword'  => new KeywordInfo([
                    'text'       => $text,
                    'match_type' => KeywordMatchType::value($match),
                ]),
            ]);
            $op = new AdGroupCriterionOperation();
            $op->setCreate($crit);
            $ops[] = $op;
        }

        $res = $client->getAdGroupCriterionServiceClient()->mutateAdGroupCriteria(
            MutateAdGroupCriteriaRequest::build($cid, $ops)
        );
        return ['ok' => true, 'count' => $res->getResults()->count()];
    }

    public function removeKeywords(string $containerExternalId, array $keywordExternalIds): void
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $ops = [];
        foreach ($keywordExternalIds as $kid) {
            $op = new AdGroupCriterionOperation();
            $op->setRemove(ResourceNames::forAdGroupCriterion($cid, (int)$containerExternalId, (int)$kid));
            $ops[] = $op;
        }
        $client->getAdGroupCriterionServiceClient()->mutateAdGroupCriteria(
            MutateAdGroupCriteriaRequest::build($cid, $ops)
        );
    }

    public function listNegativeKeywords(string $containerExternalId, array $params = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        $q = Gaql::selectNegativeKeywordsByAdGroup((string)(int)$containerExternalId);
        $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
        foreach ($stream->iterateAllElements() as $row) {
            $c = $row->getAdGroupCriterion();
            yield [
                'external_id' => (string)$c->getCriterionId(),
                'ad_group_id' => (string)$containerExternalId,
                'text'        => $c->getKeyword()->getText(),
                'match'       => KeywordMatchType::name($c->getKeyword()->getMatchType()),
                'negative'    => true,
            ];
        }
    }

    public function addNegativeKeywords(string $containerExternalId, array $keywords): array
    {
        foreach ($keywords as &$k) { $k['negative'] = true; }
        return $this->createKeywords($containerExternalId, $keywords);
    }

    public function listPlacements(string $containerExternalId, array $params = []): iterable
    {
        $client = $this->gads();
        $svc    = $client->getGoogleAdsServiceClient();
        $cid    = $this->customerId();

        $q = Gaql::selectPlacementsByAdGroup((string)(int)$containerExternalId);
        $stream = $svc->searchStream(SearchGoogleAdsStreamRequest::build($cid, $q));
        foreach ($stream->iterateAllElements() as $row) {
            $c = $row->getAdGroupCriterion();
            yield [
                'external_id' => (string)$c->getCriterionId(),
                'ad_group_id' => (string)$containerExternalId,
                'url'         => $c->getPlacement()->getUrl(),
                'negative'    => (bool)$c->getNegative(),
            ];
        }
    }

    public function excludePlacements(string $containerExternalId, array $placements): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $ops = [];
        foreach ($placements as $url) {
            $crit = new AdGroupCriterion([
                'ad_group' => ResourceNames::forAdGroup($cid, (int)$containerExternalId),
                'status'   => AdGroupCriterionStatus::ENABLED,
                'negative' => true,
                'placement'=> new PlacementInfo(['url' => (string)$url]),
            ]);
            $op = new AdGroupCriterionOperation();
            $op->setCreate($crit);
            $ops[] = $op;
        }
        $res = $client->getAdGroupCriterionServiceClient()->mutateAdGroupCriteria(
            MutateAdGroupCriteriaRequest::build($cid, $ops)
        );
        return ['ok' => true, 'count' => $res->getResults()->count()];
    }

    /* ====================== EXPERIMENTS (PENDIENTE) ====================== */

    public function listExperiments(array $params = []): iterable
    {
        // Si lo necesitas: usa Gaql::selectExperiments()
        return [];
    }

    public function createExperiment(array $payload): array
    {
        return ['ok' => false, 'unsupported' => true];
    }

    public function startExperiment(string $externalId): void
    {
        // no-op
    }

    public function stopExperiment(string $externalId): void
    {
        // no-op
    }

    /* ====================== HEALTH / SANDBOX ====================== */

    public function rateLimitHints(): array
    {
        return [
            'max_requests_per_minute' => 1000,
            'backoff_seconds'         => 2,
            'burst'                   => 50,
            'notes'                   => 'Aplicar retry exponencial en 429/5xx; observar cuotas por método.',
        ];
    }

    public function health(): array
    {
        try {
            $verified = $this->verifyConnection();
            return ['ok' => ($verified['ok'] ?? false) === true, 'extra' => $verified];
        } catch (\Throwable $e) {
            return ['ok' => false, 'errors' => [$e->getMessage()]];
        }
    }

    public function setSandbox(bool $enabled): void
    {
        $this->sandbox = $enabled;
    }

    /* ====================== PRIVATES ====================== */

    private function gads()
    {
        if (!$this->platform) {
            throw new \RuntimeException('Driver sin plataforma: llama ->using($dealAdPlatform) antes.');
        }
        return ClientFactory::fromPlatform($this->platform);
    }

    private function customerId(): string
    {
        $creds = (array)$this->platform->getPayload('credentials', []);
        $cid = (string)($creds['customer_id'] ?? '');
        if ($cid === '') {
            // admite que el customer_id venga como linked_customer_id
            $cid = (string)($creds['linked_customer_id'] ?? '');
        }
        if ($cid === '') {
            throw new InvalidArgumentException('Falta credentials.customer_id en el payload.');
        }
        return $cid;
    }

    private function detectAdFormat(\Google\Ads\GoogleAds\V21\Resources\Ad $ad): string
    {
        if ($ad->hasResponsiveSearchAd()) return 'responsive';
        if ($ad->hasImageAd()) return 'image';
        if ($ad->hasVideoAd()) return 'video';
        if ($ad->hasResponsiveDisplayAd()) return 'rda';
        return 'unknown';
    }

    private function resolveAdGroupIdForAd(int $adId): int
    {
        $client = $this->gads();
        $cid    = $this->customerId();
        $svc    = $client->getGoogleAdsServiceClient();

        $query = Gaql::selectAdGroupIdByAdId((string)$adId);
        $iterator = $svc->search($cid, $query);

        foreach ($iterator as $row) {
            return (int)$row->getAdGroup()->getId();
        }

        throw new InvalidArgumentException("No se pudo resolver el ad_group_id para el anuncio {$adId}.");
    }

    private function setEntityStatus(string $level, string $externalId, string $status): void
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        if ($level === 'campaign') {
            $c = new Campaign([
                'resource_name' => ResourceNames::forCampaign($cid, (int)$externalId),
                'status' => $status === 'enabled' ? CampaignStatus::ENABLED : CampaignStatus::PAUSED,
            ]);
            $op = new CampaignOperation();
            $op->setUpdate($c);
            $op->setUpdateMask(FieldMasks::allSetFieldsOf($c));
            $client->getCampaignServiceClient()->mutateCampaigns(MutateCampaignsRequest::build($cid, [$op]));
            return;
        }

        if ($level === 'container') {
            $g = new AdGroup([
                'resource_name' => ResourceNames::forAdGroup($cid, (int)$externalId),
                'status' => $status === 'enabled' ? AdGroupStatus::ENABLED : AdGroupStatus::PAUSED,
            ]);
            $op = new AdGroupOperation();
            $op->setUpdate($g);
            $op->setUpdateMask(FieldMasks::allSetFieldsOf($g));
            $client->getAdGroupServiceClient()->mutateAdGroups(MutateAdGroupsRequest::build($cid, [$op]));
            return;
        }

        if ($level === 'ad') {
            $adGroupId = $this->resolveAdGroupIdForAd((int)$externalId);
            $aga = new AdGroupAd([
                'resource_name' => ResourceNames::forAdGroupAd($cid, $adGroupId, (int)$externalId),
                'status' => $status === 'enabled' ? AdGroupAdStatus::ENABLED : AdGroupAdStatus::PAUSED,
            ]);
            $op = new AdGroupAdOperation();
            $op->setUpdate($aga);
            $op->setUpdateMask(FieldMasks::allSetFieldsOf($aga));
            $client->getAdGroupAdServiceClient()->mutateAdGroupAds(MutateAdGroupAdsRequest::build($cid, [$op]));
            return;
        }
    }

    private function createCampaign(array $payload): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $budgetName = (string)($payload['budget']['name'] ?? ('budget-'.date('Ymd-His')));
        $budgetAmt  = isset($payload['budget']['amount_micros'])
            ? (int)$payload['budget']['amount_micros']
            : (int)round(((float)($payload['budget']['amount'] ?? 0)) * 1_000_000);

        $budget = new CampaignBudget([
            'name' => $budgetName,
            'amount_micros' => $budgetAmt,
            'explicitly_shared' => false,
        ]);
        $bop = new CampaignBudgetOperation();
        $bop->setCreate($budget);

        $bsvc = $client->getCampaignBudgetServiceClient();
        $bres = $bsvc->mutateCampaignBudgets(MutateCampaignBudgetsRequest::build($cid, [$bop]));
        $budgetRn = $bres->getResults()[0]->getResourceName();

        $campaign = new Campaign([
            'name' => (string)($payload['name'] ?? 'Campaign '.date('c')),
            'status' => CampaignStatus::PAUSED,
            'advertising_channel_type' => AdvertisingChannelType::SEARCH,
            'campaign_budget' => $budgetRn,
            'manual_cpc' => new ManualCpc(),
            'start_date' => (string)($payload['time_window']['start_date'] ?? date('Ymd', strtotime('+1 day'))),
            'end_date'   => (string)($payload['time_window']['end_date'] ?? null),
        ]);

        $cop = new CampaignOperation();
        $cop->setCreate($campaign);
        $res = $client->getCampaignServiceClient()->mutateCampaigns(MutateCampaignsRequest::build($cid, [$cop]));

        $rn = $res->getResults()[0]->getResourceName();
        return ['ok' => true, 'resource' => $rn];
    }

    private function updateCampaign(string $externalId, array $payload): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $c = new Campaign(['resource_name' => ResourceNames::forCampaign($cid, (int)$externalId)]);
        if (isset($payload['name'])) $c->setName((string)$payload['name']);
        if (isset($payload['status'])) {
            $c->setStatus(strtolower((string)$payload['status']) === 'enabled' ? CampaignStatus::ENABLED : CampaignStatus::PAUSED);
        }
        if (isset($payload['time_window']['start_date'])) $c->setStartDate((string)$payload['time_window']['start_date']);
        if (isset($payload['time_window']['end_date']))   $c->setEndDate((string)$payload['time_window']['end_date']);

        $op = new CampaignOperation();
        $op->setUpdate($c);
        $op->setUpdateMask(FieldMasks::allSetFieldsOf($c));
        $res = $client->getCampaignServiceClient()->mutateCampaigns(MutateCampaignsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    private function createContainer(array $payload, ?string $parentExternalId): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $type = strtolower((string)($payload['type'] ?? 'ad_group'));
        if ($type !== 'ad_group') {
            // asset_group de PMAX: requiere flujo distinto (no GAQL).
            return ['ok' => false, 'unsupported' => true];
        }

        if (!$parentExternalId) {
            throw new InvalidArgumentException('createContainer requiere campaign_id como parentExternalId.');
        }

        $adGroup = new AdGroup([
            'name'     => (string)($payload['name'] ?? 'AdGroup '.date('c')),
            'campaign' => ResourceNames::forCampaign($cid, (int)$parentExternalId),
            'status'   => AdGroupStatus::ENABLED,
            'type'     => AdGroupType::SEARCH_STANDARD,
            'cpc_bid_micros' => isset($payload['bid_micros'])
                ? (int)$payload['bid_micros']
                : (int)round(((float)($payload['bid'] ?? 1.0)) * 1_000_000),
        ]);
        $op = new AdGroupOperation();
        $op->setCreate($adGroup);

        $res = $client->getAdGroupServiceClient()->mutateAdGroups(MutateAdGroupsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    private function updateAdGroup(string $externalId, array $payload): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $g = new AdGroup(['resource_name' => ResourceNames::forAdGroup($cid, (int)$externalId)]);
        if (isset($payload['name'])) $g->setName((string)$payload['name']);
        if (isset($payload['status'])) {
            $g->setStatus(strtolower((string)$payload['status']) === 'enabled' ? AdGroupStatus::ENABLED : AdGroupStatus::PAUSED);
        }
        if (isset($payload['bid_micros']) || isset($payload['bid'])) {
            $g->setCpcBidMicros(isset($payload['bid_micros']) ? (int)$payload['bid_micros'] : (int)round(((float)$payload['bid']) * 1_000_000));
        }

        $op = new AdGroupOperation();
        $op->setUpdate($g);
        $op->setUpdateMask(FieldMasks::allSetFieldsOf($g));
        $res = $client->getAdGroupServiceClient()->mutateAdGroups(MutateAdGroupsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    private function createAd(array $payload, ?string $parentExternalId): array
    {
        $client = $this->gads();
        $cid    = $this->customerId();

        $format = strtolower((string)($payload['format'] ?? 'responsive'));
        if ($format !== 'responsive') {
            // Aquí podrías implementar image/video/rda cuando lo necesites.
            return ['ok' => false, 'unsupported_format' => $format];
        }

        $adGroupId = (string)($payload['ad_group_id'] ?? $parentExternalId ?? '');
        if ($adGroupId === '') {
            throw new InvalidArgumentException('createAd (responsive) requiere ad_group_id (o parentExternalId).');
        }

        $assets = (array)($payload['assets'] ?? []);
        $headlines    = array_map(fn($t) => new AdTextAsset(['text' => (string)$t]), (array)($assets['headlines'] ?? []));
        $descriptions = array_map(fn($t) => new AdTextAsset(['text' => (string)$t]), (array)($assets['descriptions'] ?? []));
        $finalUrls    = array_values(array_filter((array)($assets['final_urls'] ?? [$assets['final_url'] ?? null])));

        $rsa = new ResponsiveSearchAdInfo(['headlines' => $headlines, 'descriptions' => $descriptions]);
        if (!empty($assets['path1'])) $rsa->setPath1((string)$assets['path1']);
        if (!empty($assets['path2'])) $rsa->setPath2((string)$assets['path2']);

        $adGroupAd = new AdGroupAd([
            'ad_group' => ResourceNames::forAdGroup($cid, (int)$adGroupId),
            'status'   => AdGroupAdStatus::PAUSED,
            'ad'       => new \Google\Ads\GoogleAds\V21\Resources\Ad([
                'name'                 => (string)($payload['name'] ?? ('RSA '.date('c'))),
                'responsive_search_ad' => $rsa,
                'final_urls'           => $finalUrls,
            ]),
        ]);

        $op = new AdGroupAdOperation();
        $op->setCreate($adGroupAd);
        $res = $client->getAdGroupAdServiceClient()->mutateAdGroupAds(MutateAdGroupAdsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    private function updateAdGroupAd(string $externalId, array $payload): array
    {
        $client   = $this->gads();
        $cid      = $this->customerId();
        $adGroupId= (int)$this->requireParam('ad_group_id', $payload);

        $aga = new AdGroupAd([
            'resource_name' => ResourceNames::forAdGroupAd($cid, $adGroupId, (int)$externalId),
        ]);

        if (isset($payload['status'])) {
            $aga->setStatus(strtolower((string)$payload['status']) === 'enabled' ? AdGroupAdStatus::ENABLED : AdGroupAdStatus::PAUSED);
        }

        $op = new AdGroupAdOperation();
        $op->setUpdate($aga);
        $op->setUpdateMask(FieldMasks::allSetFieldsOf($aga));

        $res = $client->getAdGroupAdServiceClient()->mutateAdGroupAds(MutateAdGroupAdsRequest::build($cid, [$op]));
        return ['ok' => true, 'resource' => $res->getResults()[0]->getResourceName()];
    }

    private function resolveImageBinary(array $payload): string
    {
        $base64 = (string)($payload['base64'] ?? '');
        $path   = (string)($payload['path'] ?? '');

        if ($base64 !== '') {
            if (!preg_match('/^data:image\/\w+;base64,/', $base64)) {
                throw new InvalidArgumentException('base64 de imagen inválido.');
            }
            return (string)base64_decode(explode(',', $base64, 2)[1]);
        }
        if ($path !== '' && is_file($path)) {
            return (string)file_get_contents($path);
        }
        throw new InvalidArgumentException('Debes enviar base64 o path para asset IMAGE.');
    }

    private function requireParam(string $key, ?array $arr = null): string
    {
        $a = $arr ?? [];
        if (!array_key_exists($key, $a) || (string)$a[$key] === '') {
            throw new InvalidArgumentException("Falta parámetro requerido: {$key}");
        }
        return (string)$a[$key];
    }
}
