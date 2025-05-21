<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */



    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }



    public function test_products_can_be_indexed(): void
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }



    public function test_products_can_be_shown(): void
    {
        $product = Product::factory()->create();
        $response = $this->get('/api/products/' . $product->getKey());
        $response->assertStatus(200);
    }




    public function test_products_can_be_stored(): void
    {
        $attributes = [
            'sku' => 'testSku',
            'name' => 'test name',
            'price' => 1000.123
        ];

        $response = $this->post('/api/products', $attributes);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $attributes);
    }




    public function test_products_can_be_updated(): void
    {
        $product = Product::factory()->create();

        $attributes = [
            'sku' => 'newSku',
            'name' => 'new name',
            'price' => 1000.000
        ];

        $response = $this->patch('/api/products/' . $product->getKey(), $attributes);
        $response->assertStatus(202);
        $this->assertDatabaseHas('products', array_merge(['id' => $product->getKey()], $attributes));
    }



    public function test_products_can_be_destroyed(): void
    {
        $product = Product::factory()->create();


        $response = $this->delete('/api/products/' . $product->getKey());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->getKey()]);
    }
}
