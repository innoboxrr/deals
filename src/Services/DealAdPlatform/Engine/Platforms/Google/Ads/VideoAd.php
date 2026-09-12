<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Ads;

use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Abstracts\BaseAdAction;
use Google\Ads\GoogleAds\V21\Common\VideoAdInfo;
use Google\Ads\GoogleAds\V21\Resources\Ad;
use Google\Ads\GoogleAds\V21\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;

/**
 * Video Ad (necesita asset de video existente).
 *
 * create() payload:
 * [
 *   "ad_group_id"         => "1112223333",
 *   "ad_name"             => "Video Promo",
 *   "video_asset_resource"=> "customers/{c}/assets/{assetId}", // requerido
 *   "final_urls"          => ["https://example.com/landing"],  // requerido
 *   "headline"            => "Título",         // opcional
 *   "description1"        => "Línea 1",        // opcional
 *   "description2"        => "Línea 2",        // opcional
 *   "status"              => "PAUSED|ENABLED"
 * ]
 */
final class VideoAd extends BaseAdAction
{
    public function create(array $payload): array
    {
        foreach (['ad_group_id','video_asset_resource'] as $k) {
            if (empty($payload[$k])) {
                throw new \InvalidArgumentException("Falta campo requerido: {$k}");
            }
        }
        $finalUrls = (array)($payload['final_urls'] ?? []);
        if (!$finalUrls) {
            throw new \InvalidArgumentException('final_urls requerido (>=1).');
        }

        $video = new VideoAdInfo([
            // En v21 el enlace del asset de video se infiere desde el Ad; setear fields básicos
        ]);

        // Nota: Google recomienda usar formatos orientados a Video campaigns;
        // aquí usamos VideoAdInfo básico (outstream/instream se define a nivel de ad group/campaign type).

        $ad = new Ad([
            'name'        => (string)($payload['ad_name'] ?? ('VIDEO '.date('c'))),
            'video_ad'    => $video,
            'final_urls'  => array_values($finalUrls),
            // Para headlines/descriptions de algunos formatos:
            // 'headline' / 'description1' / 'description2' no son campos directos de Ad en v21,
            // se configuran por tipo de formato; si usas Discovery/VideoAction cambia el flujo.
        ]);

        // IMPORTANTE: para asociar el video asset al Ad en v21,
        // usualmente se usa AdVideoAsset (para algunos tipos),
        // o bien se referencia en AssetGroup (PMax). Mantén esta clase para casos básicos.

        $adGroupAd = new AdGroupAd([
            'ad_group' => $this->adGroupResource((string)$payload['ad_group_id']),
            'status'   => strtoupper((string)($payload['status'] ?? 'PAUSED')) === 'ENABLED'
                ? AdGroupAdStatus::ENABLED : AdGroupAdStatus::PAUSED,
            'ad'       => $ad,
        ]);

        $op = new AdGroupAdOperation();
        $op->setCreate($adGroupAd);

        return $this->mutateAdGroupAds($op);
    }
}
