<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created_via_api(): void
    {
        $payload = [
            'name'  => 'Test Product',
            'price' => 100.50,
            'stock' => 10,
        ];

        $response = $this->postJson('/api/products', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Test Product',
                     'stock' => 10,
                 ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'stock' => 10,
        ]);
    }
}
