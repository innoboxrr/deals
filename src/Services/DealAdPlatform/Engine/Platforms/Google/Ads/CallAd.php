<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Ads;

use Google\Ads\GoogleAds\V21\Common\CallAdInfo;
use Google\Ads\GoogleAds\V21\Resources\Ad;
use Google\Ads\GoogleAds\V21\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V21\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;

/**
 * Call-only Ad.
 *
 * create() payload:
 * [
 *   "ad_group_id"   => "1112223333",
 *   "ad_name"       => "Llamadas Centro",
 *   "country_code"  => "MX",
 *   "phone_number"  => "+525512345678",
 *   "business_name" => "MiMarca",
 *   "headline1"     => "Cotiza hoy",
 *   "headline2"     => "Atención 24/7",
 *   "description1"  => "Habla con un asesor",
 *   "description2"  => "Sin compromiso",
 *   "final_urls"    => ["https://example.com"],
 *   "status"        => "PAUSED|ENABLED"
 * ]
 */
final class CallAd extends BaseAdAction
{
    public function create(array $payload): array
    {
        foreach (['ad_group_id','country_code','phone_number','business_name','headline1','headline2','description1','description2'] as $k) {
            if (empty($payload[$k])) {
                throw new \InvalidArgumentException("Falta campo requerido: {$k}");
            }
        }
        $finalUrls = (array)($payload['final_urls'] ?? []);
        if (!$finalUrls) {
            throw new \InvalidArgumentException('final_urls requerido (>=1).');
        }

        $call = new CallAdInfo([
            'country_code'  => (string)$payload['country_code'],
            'phone_number'  => (string)$payload['phone_number'],
            'business_name' => (string)$payload['business_name'],
            'headline1'     => (string)$payload['headline1'],
            'headline2'     => (string)$payload['headline2'],
            'description1'  => (string)$payload['description1'],
            'description2'  => (string)$payload['description2'],
        ]);

        $ad = new Ad([
            'name'       => (string)($payload['ad_name'] ?? ('CALL '.date('c'))),
            'call_ad'    => $call,
            'final_urls' => array_values($finalUrls),
        ]);

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
