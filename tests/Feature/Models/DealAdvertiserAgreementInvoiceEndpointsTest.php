<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementInvoiceEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_invoice_policies_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_invoice_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_invoice_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_invoice_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_invoice_show_auth_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_invoice_id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_invoice_show_guest_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_invoice_id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_invoice_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_invoice_update_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_invoice_id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_invoice_delete_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_invoice_id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_invoice_restore_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_invoice_id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_invoice_force_delete_endpoint()
    {

        $dealAdvertiserAgreementInvoice = \Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_invoice_id' => $dealAdvertiserAgreementInvoice->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_invoice_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-invoice/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
