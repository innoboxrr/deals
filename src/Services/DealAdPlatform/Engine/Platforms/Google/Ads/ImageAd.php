<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Ads;

use Google\Ads\GoogleAds\V21\Common\ImageAdInfo;
use Google\Ads\GoogleAds\V21\Resources\Ad;
use Google\Ads\GoogleAds\V21\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;

/**
 * Image Ad clásico (si necesitas un banner one-shot).
 *
 * create() payload:
 * [
 *   "ad_group_id" => "1112223333",
 *   "ad_name"     => "Banner 1200x628",
 *   // Opción A (reusar):
 *   "ad_id_to_copy_image_from" => "1234567890",
 *   // Opción B (inline):
 *   "image_data_base64" => "data:image/jpeg;base64,...",
 *   "mime_type"         => "IMAGE_JPEG|IMAGE_PNG",
 *   "final_urls"        => ["https://example.com"],
 *   "status"            => "PAUSED|ENABLED"
 * ]
 */
final class ImageAd extends BaseAdAction
{
    public function create(array $payload): array
    {
        $adGroupId = (string)($payload['ad_group_id'] ?? '');
        $finalUrls = (array) ($payload['final_urls'] ?? []);
        if (!$adGroupId || !$finalUrls) {
            throw new \InvalidArgumentException('ImageAd requiere ad_group_id y final_urls.');
        }

        $info = new ImageAdInfo();

        if (!empty($payload['ad_id_to_copy_image_from'])) {
            $info->setAdIdToCopyImageFrom((int)$payload['ad_id_to_copy_image_from']);
        } elseif (!empty($payload['image_data_base64'])) {
            $parts  = explode(',', (string)$payload['image_data_base64'], 2);
            $binary = base64_decode($parts[1] ?? '', true);
            if (!$binary) {
                throw new \InvalidArgumentException('image_data_base64 inválido.');
            }
            $info->setData($binary);
            if (!empty($payload['mime_type'])) {
                $info->setMimeType((string)$payload['mime_type']);
            }
        } else {
            throw new \InvalidArgumentException('Proporciona image_data_base64 o ad_id_to_copy_image_from.');
        }

        $ad = new Ad([
            'name'       => (string)($payload['ad_name'] ?? ('IMG '.date('c'))),
            'image_ad'   => $info,
            'final_urls' => array_values($finalUrls),
        ]);

        $adGroupAd = new AdGroupAd([
            'ad_group' => $this->adGroupResource($adGroupId),
            'status'   => strtoupper((string)($payload['status'] ?? 'PAUSED')) === 'ENABLED'
                ? AdGroupAdStatus::ENABLED : AdGroupAdStatus::PAUSED,
            'ad'       => $ad,
        ]);

        $op = new AdGroupAdOperation();
        $op->setCreate($adGroupAd);

        return $this->mutateAdGroupAds($op);
    }
}
