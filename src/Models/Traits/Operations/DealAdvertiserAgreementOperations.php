<?php

namespace Innoboxrr\Deals\Models\Traits\Operations;

trait DealAdvertiserAgreementOperations
{

    public function buildPayload()
    {
        return [
            'general' => [
                'start_date' => $this->meta('general_start_date'),
                'end_date' => $this->meta('general_end_date'),
                'contract_terms' => $this->meta('general_contract_terms', ''),
                'completion_notes' => $this->meta('general_completion_notes', ''),
                'direct_assignment_token' => $this->meta('general_direct_assignment_token'),
                'timezone' => $this->meta('general_timezone', config('app.timezone')),
                'duplicate_lead_time' => (int) $this->meta('general_duplicate_lead_time', 30),
                'lead_id_prefix' => $this->meta('general_lead_id_prefix', ''),
                'default_country' => $this->meta('general_default_country', 'México'),
                'status' => $this->meta('general_status', 'draft'),
            ],
            'billings' => [
                'autorenewal' => (bool) $this->meta('billings_autorenewal', false),
                'currency' => $this->meta('billings_currency', 'MXN'),
                'management_fee' => (float) $this->meta('billings_management_fee', 0),
                'budget' => (float) $this->meta('billings_budget', 0),
                'budget_fee' => (float) $this->meta('billings_budget_fee', 0),
                'net_budget' => (float) $this->meta('billings_net_budget', 0),
                'budget_spent' => (float) $this->meta('billings_budget_spent', 0),
                'payment_terms' => (int) $this->meta('billings_payment_terms', 0),

                'daily_budget' => (float) $this->meta('billings_daily_budget', 0),
                'daily_budget_spent' => (float) $this->meta('billings_daily_budget_spent', 0),

                'invoice_reference' => $this->meta('billings_invoice_reference', ''),
                'billing_name' => $this->meta('billings_billing_name', ''),
                'billing_contact' => $this->meta('billings_billing_contact', ''),
                'billing_phone' => $this->meta('billings_billing_phone', ''),
            ],
            'estimate_metrics' => [
                'ctr' => (float) $this->meta('estimate_metrics_ctr', 0),
                'cpl' => (float) $this->meta('estimate_metrics_cpl', 0),
                'cpa' => (float) $this->meta('estimate_metrics_cpa', 0),
                'conversion_rate' => (float) $this->meta('estimate_metrics_conversion_rate', 0),
                'leads_per_day' => (int) $this->meta('estimate_metrics_leads_per_day', 0),
                'roi' => (float) $this->meta('estimate_metrics_roi', 0),
                'lead_qualification_rate' => (float) $this->meta('estimate_metrics_lead_qualification_rate', 0),
            ],
            'automation' => [
                'pause_until' => $this->meta('automation_pause_until'),
                'pause_reason' => $this->meta('automation_pause_reason', ''),
                'cpc' => (float) $this->meta('automation_cpc', 0),
                'cpm' => (float) $this->meta('automation_cpm', 0),
                'cpc_warn' => (float) $this->meta('automation_cpc_warn', 0),
                'cpc_critical' => (float) $this->meta('automation_cpc_critical', 0),
                'cpc_pause' => (float) $this->meta('automation_cpc_pause', 0),
                'cpm_warn' => (float) $this->meta('automation_cpm_warn', 0),
                'cpm_critical' => (float) $this->meta('automation_cpm_critical', 0),
                'cpm_pause' => (float) $this->meta('automation_cpm_pause', 0),
                'min_ctr' => (float) $this->meta('automation_min_ctr', 0),
                'min_ctr_warn' => (float) $this->meta('automation_min_ctr_warn', 0),
                'min_ctr_critical' => (float) $this->meta('automation_min_ctr_critical', 0),
                'min_ctr_pause' => (float) $this->meta('automation_min_ctr_pause', 0),
                'min_conversion_rate' => (float) $this->meta('automation_min_conversion_rate', 0),
                'min_conversion_rate_warn' => (float) $this->meta('automation_min_conversion_rate_warn', 0),
                'min_conversion_rate_critical' => (float) $this->meta('automation_min_conversion_rate_critical', 0),
                'min_conversion_rate_pause' => (float) $this->meta('automation_min_conversion_rate_pause', 0),
                'min_leads' => (int) $this->meta('automation_min_leads', 0),
                'min_leads_warn' => (int) $this->meta('automation_min_leads_warn', 0),
                'min_leads_critical' => (int) $this->meta('automation_min_leads_critical', 0),
                'min_leads_pause' => (int) $this->meta('automation_min_leads_pause', 0),
                'max_leads' => (int) $this->meta('automation_max_leads', 0),
                'max_leads_warn' => (int) $this->meta('automation_max_leads_warn', 0),
                'max_leads_critical' => (int) $this->meta('automation_max_leads_critical', 0),
                'max_leads_pause' => (int) $this->meta('automation_max_leads_pause', 0),
                'require_client_postback' => (bool) $this->meta('automation_require_client_postback', false),
                'postback_tolerance_hours' => (int) $this->meta('automation_postback_tolerance_hours', 24),
                'postback_tolerance_percentage' => (int) $this->meta('automation_postback_tolerance_percentage', 80),
                'max_integration_errors' => (int) $this->meta('automation_max_integration_errors', 0),
                'max_rejection_rate' => (float) $this->meta('automation_max_rejection_rate', 0),
                'cap_type' => $this->meta('automation_cap_type', 'daily'),
                'cap_value' => (int) $this->meta('automation_cap_value', 0),
                'cap_value_warn' => (int) $this->meta('automation_cap_value_warn', 0),
                'cap_value_critical' => (int) $this->meta('automation_cap_value_critical', 0),
                'cap_value_pause' => (int) $this->meta('automation_cap_value_pause', 0),
            ],
            'alerts' => [
                'emails' => $this->meta('alerts_emails', []),
                'phones' => $this->meta('alerts_phones', []),
            ],
            'segmentation' => [
                'platforms' => $this->meta('segmentation_platforms', []),
                'interests' => $this->meta('segmentation_interests', []),
                'devices' => $this->meta('segmentation_devices', []),
                'states' => $this->meta('segmentation_states', []),
                'min_age' => (int) $this->meta('segmentation_min_age', 0),
                'max_age' => (int) $this->meta('segmentation_max_age', 100),
                'genders' => $this->meta('segmentation_genders', []),
                'excluded_states' => $this->meta('segmentation_excluded_states', []),
                'counties' => $this->meta('segmentation_counties', []),
                'excluded_postal_codes' => $this->meta('segmentation_excluded_postal_codes', []),
            ],
            'integration' => [
                'calls' => $this->meta('integration_calls', []),
            ],
            'distribution' => [
                'current_cpl' => (float) $this->meta('distribution_current_cpl', 0),
                'current_cpa' => (float) $this->meta('distribution_current_cpa', 0),
                'current_ctr' => (float) $this->meta('distribution_current_ctr', 0),
                'current_cpm' => (float) $this->meta('distribution_current_cpm', 0),
                'current_cpc' => (float) $this->meta('distribution_current_cpc', 0),
                'current_leads_assigned' => (int) $this->meta('distribution_current_leads_assigned', 0),
                'current_leads_duplicates' => (int) $this->meta('distribution_current_leads_duplicates', 0),
                'current_leads_waiting' => (int) $this->meta('distribution_current_leads_waiting', 0),
                'current_leads_rejected' => (int) $this->meta('distribution_current_leads_rejected', 0),
                'current_leads_approved' => (int) $this->meta('distribution_current_leads_approved', 0),
                'current_roi' => (float) $this->meta('distribution_current_roi', 0),
            ],
            'postback' => [
                'token' => $this->meta('postback_token'),
                'enabled' => (bool) $this->meta('postback_enabled', false),
                'method' => $this->meta('postback_method', 'POST'),
                'allowed_ips' => $this->meta('postback_allowed_ips', []),
            ]
        ];
    }     

    public function updatePayload()
    {
        $this->payload = $this->buildPayload();
        return $this->save();
    }
}
