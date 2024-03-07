<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A list of the resource.
     */
    public function testListProducts(): void
    {
        $response = $this->get('/api/v1/products');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $response->assertJsonCount(15, 'data');
    }
}
