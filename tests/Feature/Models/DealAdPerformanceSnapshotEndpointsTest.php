<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdPerformanceSnapshotEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_ad_performance_snapshot_policies_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-performance-snapshot/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_performance_snapshot_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-performance-snapshot/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_ad_performance_snapshot_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-performance-snapshot/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_performance_snapshot_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-performance-snapshot/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_ad_performance_snapshot_show_auth_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_performance_snapshot_id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-performance-snapshot/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_performance_snapshot_show_guest_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_performance_snapshot_id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-performance-snapshot/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_ad_performance_snapshot_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-performance-snapshot/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_ad_performance_snapshot_update_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::factory()->make()->getAttributes(),
            'deal_ad_performance_snapshot_id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-ad-performance-snapshot/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_performance_snapshot_delete_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_performance_snapshot_id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-performance-snapshot/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_performance_snapshot_restore_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_performance_snapshot_id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-performance-snapshot/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_performance_snapshot_force_delete_endpoint()
    {

        $dealAdPerformanceSnapshot = \Innoboxrr\Deals\Models\DealAdPerformanceSnapshot::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_performance_snapshot_id' => $dealAdPerformanceSnapshot->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-performance-snapshot/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_ad_performance_snapshot_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-performance-snapshot/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
