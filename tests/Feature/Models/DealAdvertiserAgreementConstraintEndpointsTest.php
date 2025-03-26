<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementConstraintEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_constraint_policies_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_constraint_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_constraint_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_constraint_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_constraint_show_auth_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_constraint_id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_constraint_show_guest_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_constraint_id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_constraint_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_constraint_update_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_constraint_id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_constraint_delete_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_constraint_id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_constraint_restore_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_constraint_id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_constraint_force_delete_endpoint()
    {

        $dealAdvertiserAgreementConstraint = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_constraint_id' => $dealAdvertiserAgreementConstraint->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_constraint_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-constraint/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
