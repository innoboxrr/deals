<?php

declare(strict_types=1);

namespace Innoboxrr\Deals\Services\DealAdPlatform\Engine\Platforms\Google\Support;

/**
 * Plantillas GAQL típicas por nivel para listados y métricas.
 *
 * Tip: las funciones aceptan parámetros de conveniencia (status, contains, ids, etc.)
 *      para evitar construir strings en los traits.
 */
final class Gaql
{
    /* ===================== CAMPAIGNS ===================== */

    public static function selectCampaigns(?string $status = null, ?string $nameContains = null): string
    {
        $filters = [];
        if ($status) {
            $filters[] = "campaign.status = {$status}";
        }
        if ($nameContains !== null && $nameContains !== '') {
            $contains = addcslashes($nameContains, '"');
            $filters[] = "campaign.name CONTAINS \"{$contains}\"";
        }
        $where = $filters ? (' WHERE ' . implode(' AND ', $filters)) : '';

        return "SELECT
            campaign.id,
            campaign.name,
            campaign.status,
            campaign.advertising_channel_type,
            campaign.start_date,
            campaign.end_date,
            customer.currency_code,
            customer.time_zone
        FROM campaign{$where}
        ORDER BY campaign.id";
    }

    public static function selectCampaignById(string $campaignId): string
    {
        return "SELECT
            campaign.id,
            campaign.name,
            campaign.status,
            campaign.advertising_channel_type,
            campaign.campaign_budget,
            campaign.start_date,
            campaign.end_date
        FROM campaign
        WHERE campaign.id = {$campaignId}";
    }

    public static function selectCampaignBudgetResource(string $campaignId): string
    {
        return "SELECT
            campaign.campaign_budget
        FROM campaign
        WHERE campaign.id = {$campaignId}";
    }

    /* ===================== AD GROUPS / ASSET GROUPS ===================== */

    public static function selectAdGroups(string $campaignId): string
    {
        return "SELECT
            ad_group.id,
            ad_group.name,
            ad_group.status,
            ad_group.type,
            campaign.id
        FROM ad_group
        WHERE campaign.id = {$campaignId}
        ORDER BY ad_group.id";
    }

    public static function selectAssetGroupsByCampaign(string $campaignId): string
    {
        return "SELECT
            asset_group.id,
            asset_group.name,
            asset_group.status,
            asset_group.campaign
        FROM asset_group
        WHERE campaign.id = {$campaignId}
        ORDER BY asset_group.id";
    }

    /* ===================== ADS ===================== */

    public static function selectAds(string $adGroupId): string
    {
        return "SELECT
            ad_group_ad.ad.id,
            ad_group_ad.ad.name,
            ad_group_ad.status,
            ad_group.id,
            campaign.id
        FROM ad_group_ad
        WHERE ad_group.id = {$adGroupId}";
    }

    public static function selectAdGroupIdByAdId(string $adId): string
    {
        return "SELECT
            ad_group.id
        FROM ad_group_ad
        WHERE ad_group_ad.ad.id = {$adId}
        LIMIT 1";
    }

    /* ===================== KEYWORDS / NEGATIVES / PLACEMENTS ===================== */

    public static function selectKeywordsByAdGroup(string $adGroupId): string
    {
        return "SELECT
            ad_group_criterion.criterion_id,
            ad_group_criterion.status,
            ad_group_criterion.negative,
            ad_group_criterion.type,
            ad_group_criterion.keyword.text,
            ad_group_criterion.keyword.match_type
        FROM ad_group_criterion
        WHERE ad_group.id = {$adGroupId}
          AND ad_group_criterion.type = KEYWORD";
    }

    public static function selectNegativeKeywordsByAdGroup(string $adGroupId): string
    {
        return "SELECT
            ad_group_criterion.criterion_id,
            ad_group_criterion.keyword.text,
            ad_group_criterion.keyword.match_type
        FROM ad_group_criterion
        WHERE ad_group.id = {$adGroupId}
          AND ad_group_criterion.type = KEYWORD
          AND ad_group_criterion.negative = TRUE";
    }

    public static function selectPlacementsByAdGroup(string $adGroupId): string
    {
        return "SELECT
            ad_group_criterion.criterion_id,
            ad_group_criterion.negative,
            ad_group_criterion.placement.url
        FROM ad_group_criterion
        WHERE ad_group.id = {$adGroupId}
          AND ad_group_criterion.type = PLACEMENT";
    }

    /* ===================== ASSETS ===================== */

    public static function selectAssets(array $types = []): string
    {
        // Tipos por defecto más comunes:
        if (!$types) {
            $types = ['TEXT', 'IMAGE', 'YOUTUBE_VIDEO', 'MEDIA_BUNDLE', 'LEAD_FORM'];
        }
        $in = implode(', ', $types);

        return "SELECT
            asset.resource_name,
            asset.id,
            asset.name,
            asset.type
        FROM asset
        WHERE asset.type IN ({$in})
        ORDER BY asset.id DESC";
    }

    /* ===================== LEAD FORM SUBMISSIONS ===================== */

    public static function selectLeadFormSubmissions(string $from, string $to, ?string $campaignId = null): string
    {
        $where = "WHERE segments.date >= '{$from}' AND segments.date <= '{$to}'";
        if ($campaignId) {
            $where .= " AND campaign.id = {$campaignId}";
        }

        return "SELECT
            lead_form_submission_data.lead_form_submission_data_resource_name,
            lead_form_submission_data.asset,
            lead_form_submission_data.campaign,
            lead_form_submission_data.ad_group,
            lead_form_submission_data.ad_group_ad,
            lead_form_submission_data.lead_form_id,
            lead_form_submission_data.gcl_id,
            lead_form_submission_data.submission_date_time,
            lead_form_submission_data.custom_lead_form_field_user_input
        FROM lead_form_submission_data
        {$where}";
    }

    /* ===================== EXPERIMENTS ===================== */

    public static function selectExperiments(): string
    {
        return "SELECT
            experiment.resource_name,
            experiment.name,
            experiment.status
        FROM experiment
        ORDER BY experiment.name";
    }

    /* ===================== HEALTH ===================== */

    public static function selectCustomerPing(): string
    {
        return "SELECT customer.id, customer.descriptive_name FROM customer LIMIT 1";
    }

    /* ===================== STATS ===================== */

    public static function statsByLevel(string $level, string $from, string $to): string
    {
        // level: campaign|container|ad
        $resource = match ($level) {
            'campaign'   => 'campaign',
            'container'  => 'ad_group',
            'ad'         => 'ad_group_ad',
            default      => 'campaign',
        };

        return "SELECT
            segments.date,
            metrics.impressions,
            metrics.clicks,
            metrics.cost_micros,
            metrics.conversions,
            metrics.all_conversions,
            metrics.engagements,
            metrics.conversion_value
        FROM {$resource}
        WHERE segments.date BETWEEN '{$from}' AND '{$to}'
        ORDER BY segments.date";
    }

    /**
     * Igual que statsByLevel, pero con filtro de IDs.
     * @param array<int|string> $ids
     */
    public static function statsByLevelWithIds(string $level, string $from, string $to, array $ids): string
    {
        $base = self::statsByLevel($level, $from, $to);

        if (!$ids) return $base;

        [$idField] = match ($level) {
            'campaign'  => ['campaign.id'],
            'container' => ['ad_group.id'],
            'ad'        => ['ad_group_ad.ad.id'],
            default     => ['campaign.id'],
        };

        $in = implode(',', array_map('intval', $ids));
        // Insertamos "AND ..." antes del ORDER BY
        return str_replace(
            'ORDER BY segments.date',
            "AND {$idField} IN ({$in}) ORDER BY segments.date",
            $base
        );
    }
}
