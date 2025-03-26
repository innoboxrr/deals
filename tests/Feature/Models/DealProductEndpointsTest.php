<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealProductEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_product_policies_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealProduct->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-product/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_product_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-product/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_product_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-product/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_product_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-product/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_product_show_auth_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_product_id' => $dealProduct->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-product/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_product_show_guest_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_product_id' => $dealProduct->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-product/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_product_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealProduct::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-product/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_product_update_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealProduct::factory()->make()->getAttributes(),
            'deal_product_id' => $dealProduct->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-product/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_product_delete_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_product_id' => $dealProduct->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-product/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_product_restore_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_product_id' => $dealProduct->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-product/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_product_force_delete_endpoint()
    {

        $dealProduct = \Innoboxrr\Deals\Models\DealProduct::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_product_id' => $dealProduct->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-product/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_product_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-product/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
