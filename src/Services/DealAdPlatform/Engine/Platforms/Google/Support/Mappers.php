<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support;

use Google\Ads\GoogleAds\V21\Enums\CampaignStatusEnum\CampaignStatus;
use Google\Ads\GoogleAds\V21\Enums\AdGroupStatusEnum\AdGroupStatus;
use Google\Ads\GoogleAds\V21\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;

/**
 * Mapeos / normalizaciones (status, micros, filas métricas).
 */
final class Mappers
{
    public static function statusToUnified(string $platformStatus): string
    {
        $up = strtoupper($platformStatus);
        return match ($up) {
            'ENABLED', 'ACTIVE' => 'enabled',
            'PAUSED'            => 'paused',
            'REMOVED', 'DELETED'=> 'removed',
            'DRAFT'             => 'draft',
            default             => 'enabled',
        };
    }

    public static function microsToUnits(int $micros): float
    {
        return round($micros / 1_000_000, 6);
    }

    public static function normalizeCampaignRow(array $row): array
    {
        return [
            'external_id'   => (string)($row['campaign']['id'] ?? ''),
            'name'          => (string)($row['campaign']['name'] ?? ''),
            'status'        => self::statusToUnified((string)($row['campaign']['status'] ?? 'ENABLED')),
            'objective'     => null,
            'type'          => strtolower((string)($row['campaign']['advertising_channel_type'] ?? 'standard')),
            'budget'        => null,
            'time_window'   => [
                'start_date' => $row['campaign']['start_date'] ?? null,
                'end_date'   => $row['campaign']['end_date'] ?? null,
                'timezone'   => $row['customer']['time_zone'] ?? null,
            ],
            'tracking'      => [],
            'metadata'      => ['raw' => $row],
        ];
    }

    public static function normalizeStatsRow(array $row, string $level, array $ids): array
    {
        $spend = self::microsToUnits((int)($row['metrics']['cost_micros'] ?? 0));
        $impr  = (int)($row['metrics']['impressions'] ?? 0);
        $click = (int)($row['metrics']['clicks'] ?? 0);
        $lead  = (int)($row['metrics']['conversions'] ?? 0);

        return [
            'date'          => (string)($row['segments']['date'] ?? ''),
            'level'         => $level,
            'external_id'   => $ids['self'] ?? null,
            'campaign_id'   => $ids['campaign'] ?? null,
            'container_id'  => $ids['container'] ?? null,
            'impressions'   => $impr,
            'clicks'        => $click,
            'spend'         => $spend,
            'currency'      => $row['customer']['currency_code'] ?? 'MXN',
            'leads'         => $lead,
            'conversions'   => $lead,
            'revenue'       => null,
            'ctr'           => $impr > 0 ? $click / $impr : null,
            'cpc'           => $click > 0 ? $spend / $click : null,
            'cpm'           => $impr > 0 ? ($spend / $impr) * 1000 : null,
            'cpl'           => $lead > 0 ? $spend / $lead : null,
            'metadata'      => ['raw' => $row],
        ];
    }
}
