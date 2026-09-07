<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Ads;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support\ClientFactory;
use Google\Ads\GoogleAds\Util\V21\ResourceNames;
use Google\Ads\GoogleAds\V21\Resources\AssetGroup;
use Google\Ads\GoogleAds\V21\Resources\AssetGroupAsset;
use Google\Ads\GoogleAds\V21\Services\AssetGroupOperation;
use Google\Ads\GoogleAds\V21\Services\AssetGroupAssetOperation;
use Google\Ads\GoogleAds\V21\Services\MutateGoogleAdsRequest;
use Google\Ads\GoogleAds\V21\Services\MutateOperation;
use Google\Ads\GoogleAds\V21\Enums\AssetGroupStatusEnum\AssetGroupStatus;
use Google\Ads\GoogleAds\V21\Enums\AssetFieldTypeEnum\AssetFieldType;
use Google\ApiCore\Serializer;
use Google\Protobuf\FieldMask;
use Google\Ads\GoogleAds\Util\V21\FieldMasks;

/**
 * Creador/administrador de **Asset Groups** para campañas Performance Max.
 *
 * # create()
 * Espera un payload con:
 *  - campaign_id              (string|int)  → Requerido (o usar $parentExternalId)
 *  - name                     (string)      → Nombre del asset group.
 *  - final_urls               (string[] )   → Al menos 1 URL final.
 *  - status                   ('ENABLED'|'PAUSED') (opcional; default: PAUSED)
 *
 *  - (opcional) assets ya existentes (resource_names):
 *      'headlines'                => ['customers/xxx/assets/###', ...]
 *      'long_headlines'           => [...]
 *      'descriptions'             => [...]
 *      'business_names'           => [...]
 *      'marketing_images'         => [...]
 *      'square_marketing_images'  => [...]
 *      'logos'                    => [...]
 *      'youtube_videos'           => [...]
 *
 * **Nota:** Esta clase **no** crea Assets; solo los vincula al Asset Group.
 *
 * # update()
 * Permite actualizar campos del Asset Group y agregar/quitar vínculos de assets:
 *  - asset_group_id | asset_group_resource | external_id   (uno requerido)
 *  - name, status, final_urls                                   (opcionales)
 *  - add: mismas claves de create() para añadir assets
 *      p.ej. 'add' => ['headlines' => ['customers/.../assets/###']]
 *  - remove: resource_names de AssetGroupAsset a eliminar
 *      p.ej. 'remove' => ['asset_group_asset_resources' => ['customers/.../assetGroupAssets/###']]
 */
final class PerformanceMaxAssetGroup extends BaseAdAction
{
    public function __construct(DealAdPlatform $platform, ?string $customerId = null)
    {
        parent::__construct($platform, $customerId);
    }

    /**
     * Crea un Asset Group y vincula assets existentes.
     *
     * @param array       $payload           Ver encabezado de clase.
     * @param string|null $parentExternalId  Si se provee, se usa como campaign_id.
     * @return array<string,mixed>
     */
    public function create(array $payload, ?string $parentExternalId = null): array
    {
        $campaignId = (string)($payload['campaign_id'] ?? $parentExternalId ?? '');
        $name       = (string)($payload['name'] ?? ('PMax Asset Group '.date('c')));
        $finalUrls  = array_values((array)($payload['final_urls'] ?? []));
        $status     = strtoupper((string)($payload['status'] ?? 'PAUSED')) === 'ENABLED'
            ? AssetGroupStatus::ENABLED
            : AssetGroupStatus::PAUSED;

        if ($campaignId === '' || count($finalUrls) < 1) {
            throw new \InvalidArgumentException('create(): campaign_id y al menos un final_url son obligatorios.');
        }

        // Usamos IDs temporales para referenciar el Asset Group dentro del mismo mutate.
        $tempAssetGroupId  = self::nextTempId(); // e.g. -3, -4...
        $assetGroupTempRes = ResourceNames::forAssetGroup($this->customerId, $tempAssetGroupId);

        $ops = [];

        // 1) Operación: crear Asset Group
        $ops[] = new MutateOperation([
            'asset_group_operation' => new AssetGroupOperation([
                'create' => new AssetGroup([
                    'resource_name'     => $assetGroupTempRes,
                    'name'              => $name,
                    'campaign'          => ResourceNames::forCampaign($this->customerId, (int)$campaignId),
                    'final_urls'        => $finalUrls,
                    'final_mobile_urls' => $finalUrls,
                    'status'            => $status,
                ]),
            ]),
        ]);

        // 2) Operaciones: vincular assets existentes por tipo de campo
        $map = $this->assetFieldMapFromPayload($payload);

        foreach ($map as $fieldType => $assetResourceNames) {
            foreach ($assetResourceNames as $assetRes) {
                $ops[] = new MutateOperation([
                    'asset_group_asset_operation' => new AssetGroupAssetOperation([
                        'create' => new AssetGroupAsset([
                            'asset_group' => $assetGroupTempRes,
                            'asset'       => (string)$assetRes,
                            'field_type'  => $fieldType,
                        ]),
                    ]),
                ]);
            }
        }

        // 3) Ejecutar Mutate
        $client  = ClientFactory::fromPlatform($this->platform);
        $service = $client->getGoogleAdsServiceClient();
        $resp    = $service->mutate(MutateGoogleAdsRequest::build($this->customerId, $ops));

        // 4) Parsear resultados (obtener el recurso definitivo del Asset Group)
        $result = [
            'ok'            => true,
            'resource_name' => null,
            'external_id'   => null,
            'linked_counts' => $this->countByFieldType($map),
            'raw'           => [],
        ];

        foreach ($resp->getMutateOperationResponses() as $m) {
            // Usamos Serializer para obtener el getter correcto del "oneof"
            $getter       = Serializer::getGetter($m->getResponse());
            $oneofResult  = $m->$getter();
            $resourceName = $oneofResult->getResourceName();

            $result['raw'][] = [
                'type'          => (new \ReflectionClass($oneofResult))->getShortName(), // e.g. AssetGroupResult
                'resource_name' => $resourceName,
            ];

            // Guardar el AssetGroup definitivo
            if (method_exists($oneofResult, 'getResourceName') && str_contains($resourceName, '/assetGroups/')) {
                $result['resource_name'] = $resourceName;
                $result['external_id']   = $this->lastId($resourceName);
            }
        }

        return $result;
    }

    /**
     * Actualiza el Asset Group y (opcionalmente) añade o elimina vínculos de assets.
     *
     * @param array $payload
     *  - asset_group_resource | asset_group_id | external_id  (uno requerido)
     *  - name, status, final_urls (opcionales)
     *  - add    => (ver keys de create() para añadir)
     *  - remove => ['asset_group_asset_resources' => [...]]  resource_names a eliminar
     * @return array<string,mixed>
     */
    public function update(array $payload): array
    {
        $assetGroupRes = (string)($payload['asset_group_resource'] ?? '');
        $assetGroupId  = (string)($payload['asset_group_id'] ?? $payload['external_id'] ?? '');

        if ($assetGroupRes === '') {
            if ($assetGroupId === '') {
                throw new \InvalidArgumentException(
                    'update(): proporciona "asset_group_resource" o "asset_group_id"/"external_id".'
                );
            }
            $assetGroupRes = ResourceNames::forAssetGroup($this->customerId, (int)$assetGroupId);
        }

        $ops = [];

        // 1) Update del Asset Group (name/status/final_urls)
        $before = new AssetGroup(['resource_name' => $assetGroupRes]);
        $after  = new AssetGroup(['resource_name' => $assetGroupRes]);

        $hasChanges = false;

        if (isset($payload['name'])) {
            $after->setName((string)$payload['name']);
            $hasChanges = true;
        }
        if (isset($payload['status'])) {
            $status = strtoupper((string)$payload['status']) === 'ENABLED'
                ? AssetGroupStatus::ENABLED
                : AssetGroupStatus::PAUSED;
            $after->setStatus($status);
            $hasChanges = true;
        }
        if (!empty($payload['final_urls'])) {
            $after->setFinalUrls(array_values((array)$payload['final_urls']));
            $after->setFinalMobileUrls(array_values((array)$payload['final_urls']));
            $hasChanges = true;
        }

        if ($hasChanges) {
            $mask = FieldMasks::compare($before, $after);
            $ops[] = new MutateOperation([
                'asset_group_operation' => new AssetGroupOperation([
                    'update'      => $after,
                    'update_mask' => $mask instanceof FieldMask ? $mask : null,
                ]),
            ]);
        }

        // 2) Añadir nuevos vínculos de assets
        if (!empty($payload['add']) && is_array($payload['add'])) {
            $map = $this->assetFieldMapFromPayload($payload['add']);
            foreach ($map as $fieldType => $assetResourceNames) {
                foreach ($assetResourceNames as $assetRes) {
                    $ops[] = new MutateOperation([
                        'asset_group_asset_operation' => new AssetGroupAssetOperation([
                            'create' => new AssetGroupAsset([
                                'asset_group' => $assetGroupRes,
                                'asset'       => (string)$assetRes,
                                'field_type'  => $fieldType,
                            ]),
                        ]),
                    ]);
                }
            }
        }

        // 3) Eliminar vínculos de assets (requiere resource_name de AssetGroupAsset)
        if (!empty($payload['remove']['asset_group_asset_resources'])) {
            foreach ((array)$payload['remove']['asset_group_asset_resources'] as $agaRes) {
                $ops[] = new MutateOperation([
                    'asset_group_asset_operation' => new AssetGroupAssetOperation([
                        'remove' => (string)$agaRes,
                    ]),
                ]);
            }
        }

        if (empty($ops)) {
            return ['ok' => true, 'message' => 'Sin cambios.'];
        }

        $client  = ClientFactory::fromPlatform($this->platform);
        $service = $client->getGoogleAdsServiceClient();
        $resp    = $service->mutate(MutateGoogleAdsRequest::build($this->customerId, $ops));

        $raw = [];
        foreach ($resp->getMutateOperationResponses() as $m) {
            $getter       = Serializer::getGetter($m->getResponse());
            $oneofResult  = $m->$getter();
            $raw[] = [
                'type'          => (new \ReflectionClass($oneofResult))->getShortName(),
                'resource_name' => $oneofResult->getResourceName(),
            ];
        }

        return ['ok' => true, 'raw' => $raw];
    }

    /**
     * Mapea keys del payload → AssetFieldType::* y normaliza a arrays de resource_names.
     *
     * @param array $payload
     * @return array<int, string[]>
     */
    private function assetFieldMapFromPayload(array $payload): array
    {
        // Claves aceptadas en payload y su AssetFieldType
        $map = [
            'headlines'               => AssetFieldType::HEADLINE,
            'long_headlines'          => AssetFieldType::LONG_HEADLINE,
            'descriptions'            => AssetFieldType::DESCRIPTION,
            'business_names'          => AssetFieldType::BUSINESS_NAME,
            'marketing_images'        => AssetFieldType::MARKETING_IMAGE,
            'square_marketing_images' => AssetFieldType::SQUARE_MARKETING_IMAGE,
            'logos'                   => AssetFieldType::LOGO,
            'youtube_videos'          => AssetFieldType::YOUTUBE_VIDEO,
        ];

        $out = [];
        foreach ($map as $key => $fieldType) {
            if (empty($payload[$key])) {
                continue;
            }
            $values = array_values(array_filter((array)$payload[$key], fn($v) => is_string($v) && $v !== ''));
            if ($values) {
                $out[$fieldType] = $values;
            }
        }
        return $out;
    }

    /**
     * Conteo rápido de vínculos por tipo (útil para reportar).
     *
     * @param array<int, string[]> $map
     * @return array<string,int>
     */
    private function countByFieldType(array $map): array
    {
        $labels = [
            AssetFieldType::HEADLINE               => 'HEADLINE',
            AssetFieldType::LONG_HEADLINE          => 'LONG_HEADLINE',
            AssetFieldType::DESCRIPTION            => 'DESCRIPTION',
            AssetFieldType::BUSINESS_NAME          => 'BUSINESS_NAME',
            AssetFieldType::MARKETING_IMAGE        => 'MARKETING_IMAGE',
            AssetFieldType::SQUARE_MARKETING_IMAGE => 'SQUARE_MARKETING_IMAGE',
            AssetFieldType::LOGO                   => 'LOGO',
            AssetFieldType::YOUTUBE_VIDEO          => 'YOUTUBE_VIDEO',
        ];

        $out = [];
        foreach ($map as $fieldType => $items) {
            $out[$labels[$fieldType] ?? (string)$fieldType] = count($items);
        }
        return $out;
    }

    /** Genera IDs temporales negativos para usar en Mutate (asset group). */
    private static function nextTempId(): int
    {
        static $tid = -3;
        return $tid--;
    }
}
