<?php

namespace Innoboxrr\Deals\Models\Traits\Operations;

trait DealAdvertiserOperations
{

    public function buildPayload()
    {
        return [
            'settings' => [
                'currency' => $this->meta('settings_currency'),
                'language' => $this->meta('settings_language'),
                'timezone' => $this->meta('settings_timezone'),
            ],
            'company' => [
                'name' => $this->meta('company_name'),
                'tax_number' => $this->meta('company_tax_number'),
                'tax_type' => $this->meta('company_tax_type'),
                'cfdi_use' => $this->meta('billing_cfdi_use'),
            ],
            'billing' => [
                'payment_terms' => $this->meta('billing_payment_terms'),
            ],
            'contracts' => $this->meta('contracts'),
            'address' => [
                'address' => $this->meta('address_name'),
                'city' => $this->meta('address_city'),
                'state' => $this->meta('address_state'),
                'zip' => $this->meta('address_zip'),
                'country' => $this->meta('address_country'),
                'proof_of_address_url' => $this->meta('documents_proof_of_address_url'),
            ],
            'contacts' => $this->meta('contacts'),
            'web' => [
                'website' => $this->meta('web_website'),
                'linkedin' => $this->meta('web_linkedin'),
                'twitter' => $this->meta('web_twitter'),
                'facebook' => $this->meta('web_facebook'),
                'instagram' => $this->meta('web_instagram'),
                'youtube' => $this->meta('web_youtube'),
                'tiktok' => $this->meta('web_tiktok'),
                'pinterest' => $this->meta('web_pinterest'),
                'snapchat' => $this->meta('web_snapchat'),
                'twitch' => $this->meta('web_twitch'),
                'whatsapp' => $this->meta('web_whatsapp'),
                'telegram' => $this->meta('web_telegram'),
                'discord' => $this->meta('web_discord'),
            ],
            'bank' => [
                'bank_name' => $this->meta('bank_name'),
                'bank_account' => $this->meta('bank_account'),
                'bank_iban' => $this->meta('bank_iban'),
                'bank_swift' => $this->meta('bank_swift'),
            ],
            'last_invoice' => [
                'number' => $this->meta('last_invoice_number'),
                'date' => $this->meta('last_invoice_date'),
                'amount' => $this->meta('last_invoice_amount'),
            ],
            'compliance' => [
                'verified' => $this->meta('compliance_verified'),
                'verification_date' => $this->meta('compliance_verification_date'),
                'verification_method' => $this->meta('compliance_verification_method'),
            ],
            'activity' => [
                'total_spent' => $this->meta('activity_total_spent'),
                'campaigns_count' => $this->meta('activity_campaigns_count'),
                'last_active' => $this->meta('activity_last_active'),
            ]
        ];
    }

    public function updatePayload()
    {
        $this->payload = $this->buildPayload();
        return $this->save();
    }

}
