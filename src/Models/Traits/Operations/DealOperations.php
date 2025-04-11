<?php

namespace Innoboxrr\Deals\Models\Traits\Operations;

trait DealOperations
{

    public function buildPayload()
    {
        return [
            'max_cpl' => $this->meta('max_cpl'),
            'snapshot_cron_interval' => $this->meta('snapshot_cron_interval'),
            'min_advertisers' => $this->meta('min_advertisers'),
            'max_advertisers' => $this->meta('max_advertisers'),
            'access_type' => $this->meta('access_type'),

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

            'currency' => $this->meta('currency'),
            'objective' => $this->meta('objective'),
            'type' => $this->meta('type'),
            'admin_fee_per_advertiser' => $this->meta('admin_fee_per_advertiser'),
            'min_investment_per_advertiser' => $this->meta('min_investment_per_advertiser'),
            'investment_fee' => $this->meta('investment_fee'),
            'start_date' => $this->meta('start_date'),
            'restricted_countries' => $this->meta('restricted_countries'),
            'auto_pause_campaigns_on_threshold' => $this->meta('auto_pause_campaigns_on_threshold'),
            'workspace_id' => $this->meta('workspace_id'),
            'app_workspace_id' => $this->meta('app_workspace_id'),
        ];
    }

    public function updatePayload()
    {
        $this->payload = $this->buildPayload();
        return $this->save();
    }
}
