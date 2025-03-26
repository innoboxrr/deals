<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdPlatformEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_ad_platform_policies_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdPlatform->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-platform/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_platform_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-platform/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_ad_platform_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-platform/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_platform_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-platform/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_ad_platform_show_auth_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_platform_id' => $dealAdPlatform->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-platform/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_platform_show_guest_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_platform_id' => $dealAdPlatform->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-platform/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_ad_platform_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdPlatform::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-platform/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_ad_platform_update_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdPlatform::factory()->make()->getAttributes(),
            'deal_ad_platform_id' => $dealAdPlatform->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-ad-platform/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_platform_delete_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_platform_id' => $dealAdPlatform->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-platform/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_platform_restore_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_platform_id' => $dealAdPlatform->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-platform/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_platform_force_delete_endpoint()
    {

        $dealAdPlatform = \Innoboxrr\Deals\Models\DealAdPlatform::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_platform_id' => $dealAdPlatform->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-platform/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_ad_platform_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-platform/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
