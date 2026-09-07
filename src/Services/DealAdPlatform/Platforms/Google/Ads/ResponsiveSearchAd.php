<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Ads;

use Google\Ads\GoogleAds\Util\V21\ResourceNames;
use Google\Ads\GoogleAds\V21\Common\AdTextAsset;
use Google\Ads\GoogleAds\V21\Common\ResponsiveSearchAdInfo;
use Google\Ads\GoogleAds\V21\Resources\Ad;
use Google\Ads\GoogleAds\V21\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Abstracts\BaseAdAction;

/**
 * Creador/Editor de Responsive Search Ads (RSA).
 *
 * create() payload:
 * [
 *   "ad_group_id"  => "1112223333",               // requerido
 *   "name"         => "RSA #1",
 *   "final_urls"   => ["https://example.com"],    // requerido (>=1)
 *   "path1"        => "cotiza",                   // opcional
 *   "path2"        => "auto",                     // opcional
 *   "headlines"    => ["A","B","C"],              // >=3 (<=15; <=30 chars c/u)
 *   "descriptions" => ["D1","D2"],                // >=2 (<=4; <=90 chars c/u)
 *   "status"       => "ENABLED|PAUSED"
 * ]
 *
 * update() payload:
 * [
 *   "ad_group_id"          => "1112223333",  // o "ad_group_ad_resource"
 *   "ad_id"                => "9999999999",
 *   "status"               => "ENABLED|PAUSED",
 *   "final_urls"           => [...],
 *   "headlines"            => [...],
 *   "descriptions"         => [...],
 *   "path1"                => "...",
 *   "path2"                => "..."
 * ]
 */
final class ResponsiveSearchAd extends BaseAdAction
{
    public function create(array $payload): array
    {
        $adGroupId    = (string)($payload['ad_group_id'] ?? '');
        $finalUrls    = (array) ($payload['final_urls'] ?? []);
        $headlines    = (array) ($payload['headlines'] ?? []);
        $descriptions = (array) ($payload['descriptions'] ?? []);

        if (!$adGroupId || !$finalUrls || count($headlines) < 3 || count($descriptions) < 2) {
            throw new \InvalidArgumentException(
                'RSA inválido: requiere ad_group_id, final_urls(>=1), headlines(>=3), descriptions(>=2).'
            );
        }

        $rsa = new ResponsiveSearchAdInfo([
            'headlines'    => array_map(fn($t)=> new AdTextAsset(['text'=>(string)$t]), $headlines),
            'descriptions' => array_map(fn($t)=> new AdTextAsset(['text'=>(string)$t]), $descriptions),
        ]);
        if (!empty($payload['path1'])) $rsa->setPath1((string)$payload['path1']);
        if (!empty($payload['path2'])) $rsa->setPath2((string)$payload['path2']);

        $ad = new Ad([
            'name'                 => (string)($payload['name'] ?? ('RSA '.date('c'))),
            'final_urls'           => array_values($finalUrls),
            'responsive_search_ad' => $rsa,
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

    public function update(array $payload): array
    {
        $resource = (string)($payload['ad_group_ad_resource'] ?? '');
        if ($resource === '') {
            $adGroupId = (string)($payload['ad_group_id'] ?? '');
            $adId      = (string)($payload['ad_id'] ?? '');
            if ($adGroupId === '' || $adId === '') {
                throw new \InvalidArgumentException(
                    'Proporciona "ad_group_ad_resource" o "ad_group_id" + "ad_id".'
                );
            }
            $resource = ResourceNames::forAdGroupAd($this->customerId, (int)$adGroupId, (int)$adId);
        }

        $after = new AdGroupAd(['resource_name' => $resource]);

        if (isset($payload['status'])) {
            $after->setStatus(
                strtoupper((string)$payload['status']) === 'ENABLED'
                    ? AdGroupAdStatus::ENABLED : AdGroupAdStatus::PAUSED
            );
        }

        if (!empty($payload['final_urls']) || !empty($payload['headlines']) || !empty($payload['descriptions']) ||
            array_key_exists('path1', $payload) || array_key_exists('path2', $payload)) {

            $ad  = new Ad();
            $rsa = new ResponsiveSearchAdInfo();

            if (!empty($payload['final_urls'])) {
                $ad->setFinalUrls(array_values((array)$payload['final_urls']));
            }
            if (!empty($payload['headlines'])) {
                $rsa->setHeadlines(array_map(
                    fn($t)=> new AdTextAsset(['text'=>(string)$t]),
                    (array)$payload['headlines']
                ));
            }
            if (!empty($payload['descriptions'])) {
                $rsa->setDescriptions(array_map(
                    fn($t)=> new AdTextAsset(['text'=>(string)$t]),
                    (array)$payload['descriptions']
                ));
            }
            if (array_key_exists('path1', $payload)) $rsa->setPath1((string)$payload['path1']);
            if (array_key_exists('path2', $payload)) $rsa->setPath2((string)$payload['path2']);

            $ad->setResponsiveSearchAd($rsa);
            $after->setAd($ad);
        }

        $before = new AdGroupAd(['resource_name' => $resource]);
        $mask   = $this->fieldMask($before, $after);

        $op = new AdGroupAdOperation();
        $op->setUpdate($after);
        $op->setUpdateMask($mask);

        return $this->mutateAdGroupAds($op);
    }
}
