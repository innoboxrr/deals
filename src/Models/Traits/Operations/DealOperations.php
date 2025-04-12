<?php

namespace Innoboxrr\Deals\Models\Traits\Operations;

trait DealOperations
{

    public function buildPayload()
    {
        return [
            'currency' => $this->meta('currency'),
            'objective' => $this->meta('objective'),
            'type' => $this->meta('type'),
            'admin_fee_per_advertiser' => $this->meta('admin_fee_per_advertiser'),
            'min_investment_per_advertiser' => $this->meta('min_investment_per_advertiser'),
            'investment_fee' => $this->meta('investment_fee'),
            'start_date' => $this->meta('start_date'),
            'restricted_countries' => $this->meta('restricted_countries'),
            'auto_pause_campaigns_on_threshold' => $this->meta('auto_pause_campaigns_on_threshold'),

            'max_cpl' => $this->meta('max_cpl'),
            'snapshot_cron_interval' => $this->meta('snapshot_cron_interval'),
            'min_advertisers' => $this->meta('min_advertisers'),
            'max_advertisers' => $this->meta('max_advertisers'),
            'access_type' => $this->meta('access_type'),

            'last_performance_snapshot' => [
                'time' => $this->meta('last_performance_snapshot_time'),
                'daily_budget' => (int) $this->meta('last_performance_snapshot_daily_budget', 0),
                'daily_spent' => (int) $this->meta('last_performance_snapshot_daily_spent', 0),
                'leads_generated' => (int) $this->meta('last_performance_snapshot_leads_generated', 0),
                'leads_assigned' => (int) $this->meta('last_performance_snapshot_leads_assigned', 0),
                'leads_rejected' => (int) $this->meta('last_performance_snapshot_leads_rejected', 0),
                'avg_cpl' => (int) $this->meta('last_performance_snapshot_avg_cpl', 0),
                'avg_conversion_rate' => (int) $this->meta('last_performance_snapshot_avg_conversion_rate', 0),
                'avg_roi' => (int) $this->meta('last_performance_snapshot_avg_roi', 0),
            ],

            'automation_thresholds' => [
                'min_ctr' => $this->meta('automation_thresholds_min_ctr'),
                'max_cpl' => $this->meta('automation_thresholds_max_cpl'),
                'max_cpa' => $this->meta('automation_thresholds_max_cpa'),
            ],

            'hypothesis' => [
                'ctr' => $this->meta('hypothesis_ctr'),
                'cpl' => $this->meta('hypothesis_cpl'),
                'cpa' => $this->meta('hypothesis_cpa'),
                'conversion_rate' => $this->meta('hypothesis_conversion_rate'),
                'leads_per_day' => $this->meta('hypothesis_leads_per_day'),
                'roi' => $this->meta('hypothesis_roi'),
            ],

            'alerts' => [
                'emails' => $this->meta('alerts_emails'),
                'phones' => $this->meta('alerts_phones'),
            ],

            'segmentation' => [
                'min_age' => $this->meta('segmentation_min_age'),
                'max_age' => $this->meta('segmentation_max_age'),
                'genders' => $this->meta('segmentation_genders'),
                'languages' => $this->meta('segmentation_languages'),
                'interests' => $this->meta('segmentation_interests'),
                'locations' => $this->meta('segmentation_locations'),
                'devices' => $this->meta('segmentation_devices'),
                'platforms' => $this->meta('segmentation_platforms'),
                'behaviors' => $this->meta('segmentation_behaviors'),
            ],
        ];
    }

    public function updatePayload()
    {
        $this->payload = $this->buildPayload();
        return $this->save();
    }
}
