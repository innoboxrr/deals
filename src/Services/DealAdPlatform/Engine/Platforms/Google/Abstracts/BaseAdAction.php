<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Abstracts;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support\ClientFactory;
use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Services\MutateAdGroupAdsRequest;
use Google\Ads\GoogleAds\Util\V21\ResourceNames;
use Google\Protobuf\FieldMask;
use Google\Ads\GoogleAds\Util\V21\FieldMasks;

/**
 * Base común para acciones de anuncios Google Ads.
 * - Resuelve customer_id desde payload.credentials.customer_id
 * - Expone helpers para mutar AdGroupAds y construir field masks
 */
abstract class BaseAdAction
{
    protected DealAdPlatform $platform;
    protected string $customerId;

    public function __construct(DealAdPlatform $platform, ?string $customerId = null)
    {
        $this->platform = $platform;
        $this->customerId = $customerId
            ?? (string)($platform->getPayload('credentials.customer_id') ?? '');

        if ($this->customerId === '') {
            throw new \InvalidArgumentException(
                'Falta customer_id. Define credentials.customer_id en el payload de DealAdPlatform.'
            );
        }
    }

    /** Construye el resource name de un AdGroup. */
    protected function adGroupResource(string $adGroupId): string
    {
        return ResourceNames::forAdGroup($this->customerId, (int)$adGroupId);
    }

    /** Envía operaciones create/update de AdGroupAd y normaliza el resultado. */
    protected function mutateAdGroupAds(AdGroupAdOperation ...$ops): array
    {
        $client  = ClientFactory::fromPlatform($this->platform);
        $service = $client->getAdGroupAdServiceClient();

        $resp = $service->mutateAdGroupAds(
            MutateAdGroupAdsRequest::build($this->customerId, $ops)
        );

        $out = [];
        foreach ($resp->getResults() as $r) {
            $out[] = [
                'resource_name' => $r->getResourceName(),
                'external_id'   => $this->lastId($r->getResourceName()),
            ];
        }
        return $out;
    }

    /** Crea una FieldMask comparando before/after. */
    protected function fieldMask(object $before, object $after): FieldMask
    {
        return FieldMasks::compare($before, $after);
    }

    /** Toma el último segmento de un resource name. */
    protected function lastId(string $resourceName): ?string
    {
        $parts = explode('/', $resourceName);
        return $parts ? end($parts) : null;
    }
}
