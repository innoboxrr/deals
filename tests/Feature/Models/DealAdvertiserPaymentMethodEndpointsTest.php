<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserPaymentMethodEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_payment_method_policies_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-payment-method/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_payment_method_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-payment-method/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_payment_method_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-payment-method/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_payment_method_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-payment-method/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_payment_method_show_auth_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_payment_method_id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-payment-method/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_payment_method_show_guest_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_payment_method_id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-payment-method/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_payment_method_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-payment-method/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_payment_method_update_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::factory()->make()->getAttributes(),
            'deal_advertiser_payment_method_id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-payment-method/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_payment_method_delete_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_payment_method_id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-payment-method/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_payment_method_restore_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_payment_method_id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-payment-method/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_payment_method_force_delete_endpoint()
    {

        $dealAdvertiserPaymentMethod = \Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_payment_method_id' => $dealAdvertiserPaymentMethod->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-payment-method/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_payment_method_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-payment-method/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
