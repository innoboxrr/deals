<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealPixelFireEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_pixel_fire_policies_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealPixelFire->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-pixel-fire/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_pixel_fire_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-pixel-fire/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_pixel_fire_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-pixel-fire/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_pixel_fire_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-pixel-fire/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_pixel_fire_show_auth_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_pixel_fire_id' => $dealPixelFire->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-pixel-fire/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_pixel_fire_show_guest_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_pixel_fire_id' => $dealPixelFire->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-pixel-fire/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_pixel_fire_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealPixelFire::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-pixel-fire/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_pixel_fire_update_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealPixelFire::factory()->make()->getAttributes(),
            'deal_pixel_fire_id' => $dealPixelFire->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-pixel-fire/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_pixel_fire_delete_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_pixel_fire_id' => $dealPixelFire->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-pixel-fire/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_pixel_fire_restore_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_pixel_fire_id' => $dealPixelFire->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-pixel-fire/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_pixel_fire_force_delete_endpoint()
    {

        $dealPixelFire = \Innoboxrr\Deals\Models\DealPixelFire::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_pixel_fire_id' => $dealPixelFire->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-pixel-fire/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_pixel_fire_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-pixel-fire/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
