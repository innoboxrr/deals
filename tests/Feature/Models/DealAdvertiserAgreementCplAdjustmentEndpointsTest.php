<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementCplAdjustmentEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_cpl_adjustment_policies_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_cpl_adjustment_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_cpl_adjustment_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_cpl_adjustment_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_cpl_adjustment_show_auth_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_cpl_adjustment_id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_show_guest_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_cpl_adjustment_id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_update_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_cpl_adjustment_id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_delete_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_cpl_adjustment_id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_restore_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_cpl_adjustment_id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_force_delete_endpoint()
    {

        $dealAdvertiserAgreementCplAdjustment = \Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_cpl_adjustment_id' => $dealAdvertiserAgreementCplAdjustment->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_cpl_adjustment_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-cpl-adjustment/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
