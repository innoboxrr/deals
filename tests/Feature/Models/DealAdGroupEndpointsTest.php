<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdGroupEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_ad_group_policies_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdGroup->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-group/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_group_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-group/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_ad_group_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-group/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_group_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-group/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_ad_group_show_auth_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_group_id' => $dealAdGroup->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-group/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_group_show_guest_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_group_id' => $dealAdGroup->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-group/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_ad_group_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdGroup::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-group/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_ad_group_update_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdGroup::factory()->make()->getAttributes(),
            'deal_ad_group_id' => $dealAdGroup->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-ad-group/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_group_delete_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_group_id' => $dealAdGroup->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-group/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_group_restore_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_group_id' => $dealAdGroup->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-group/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_group_force_delete_endpoint()
    {

        $dealAdGroup = \Innoboxrr\Deals\Models\DealAdGroup::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_group_id' => $dealAdGroup->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-group/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_ad_group_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-group/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
