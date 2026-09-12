<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Ads;

use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Abstracts\BaseAdAction;
use Google\Ads\GoogleAds\V21\Common\AdImageAsset;
use Google\Ads\GoogleAds\V21\Common\AdTextAsset;
use Google\Ads\GoogleAds\V21\Common\ResponsiveDisplayAdInfo;
use Google\Ads\GoogleAds\V21\Resources\Ad;
use Google\Ads\GoogleAds\V21\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;

/**
 * Responsive Display Ad (Display responsivo clásico).
 *
 * create() payload:
 * [
 *   "ad_group_id"  => "1112223333",
 *   "name"         => "RDA #1",
 *   "final_urls"   => ["https://example.com"],
 *   "headlines"    => ["Seguro barato"],         // 1..5
 *   "long_headline"=> "Cotiza en 2 minutos",     // <=90
 *   "descriptions" => ["Ahorra hoy"],            // 1..5
 *   // assets (resource names de Asset subidos):
 *   "marketing_image_assets"        => ["customers/x/assets/1"],
 *   "square_marketing_image_assets" => ["customers/x/assets/2"],
 *   "logo_assets"                   => ["customers/x/assets/3"],
 *   "business_name" => "MiMarca",   // opcional
 *   "call_to_action_text" => "LEARN_MORE", // opcional
 *   "status" => "PAUSED|ENABLED"
 * ]
 */
final class ResponsiveDisplayAd extends BaseAdAction
{
    public function create(array $payload): array
    {
        $adGroupId = (string)($payload['ad_group_id'] ?? '');
        $finalUrls = (array) ($payload['final_urls'] ?? []);
        $heads     = (array) ($payload['headlines'] ?? []);
        $descs     = (array) ($payload['descriptions'] ?? []);
        $longHead  = (string)($payload['long_headline'] ?? '');

        if (!$adGroupId || !$finalUrls || !$heads || !$descs || $longHead === '') {
            throw new \InvalidArgumentException(
                'RDA inválido: ad_group_id, final_urls, headlines(>=1), descriptions(>=1) y long_headline son requeridos.'
            );
        }

        $info = new ResponsiveDisplayAdInfo([
            'headlines'     => array_map(fn($t)=> new AdTextAsset(['text'=>(string)$t]), $heads),
            'descriptions'  => array_map(fn($t)=> new AdTextAsset(['text'=>(string)$t]), $descs),
            'long_headline' => new AdTextAsset(['text' => $longHead]),
        ]);

        foreach ((array)($payload['marketing_image_assets'] ?? []) as $res) {
            $info->getMarketingImages()[] = new AdImageAsset(['asset' => (string)$res]);
        }
        foreach ((array)($payload['square_marketing_image_assets'] ?? []) as $res) {
            $info->getSquareMarketingImages()[] = new AdImageAsset(['asset' => (string)$res]);
        }
        foreach ((array)($payload['logo_assets'] ?? []) as $res) {
            $info->getLogoImages()[] = new AdImageAsset(['asset' => (string)$res]);
        }

        if (!empty($payload['business_name'])) {
            $info->setBusinessName((string)$payload['business_name']);
        }
        if (!empty($payload['call_to_action_text'])) {
            $info->setCallToActionText((string)$payload['call_to_action_text']);
        }

        $ad = new Ad([
            'name'                  => (string)($payload['name'] ?? ('RDA '.date('c'))),
            'final_urls'            => array_values($finalUrls),
            'responsive_display_ad' => $info,
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
