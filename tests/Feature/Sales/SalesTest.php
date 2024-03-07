<?php

namespace Tests\Feature\Sales;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesTest extends TestCase
{
    /**
     * List of sales.
     */
    public function testListSales(): void
    {
        $response = $this->get('/api/v1/sales');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $response->assertJsonCount(15, 'data');
    }

    /**
     * Detail of sales.
     */
    public function testDetailSales(): void
    {
        $response = $this->get('/api/v1/sales/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
        $response->assertJsonFragment(['id' => 1]);
    }

    /**
     * Detail of sales not found.
     */
    public function testDetailSalesNotFound(): void
    {
        $response = $this->get('/api/v1/sales/0');

        $response->assertStatus(404);
    }

    /**
     * Create new sale
     */
    public function testCreateSale(): void
    {
        $response = $this->post('/api/v1/sales', [
            'products' => [
                [
                    'id' => 1,
                    'quantity' => 1,
                ],
            ],
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['data']);
        $response->assertJsonFragment(['id' => 1]);

        $this->assertDatabaseHas('sales', ['id' => $response->json('data.id')]);
        $this->assertDatabaseHas('sale_product', ['sale_id' => $response->json('data.id'), 'product_id' => $response->json('data.products.0.product.id')]);
    }

    /**
     * Add products to sale
     */
    public function testAddProductsToSale(): void
    {
        $response = $this->post('/api/v1/sales/1/add-products', [
            'products' => [
                [
                    'id' => 1,
                    'quantity' => 1,
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
        $response->assertJsonFragment(['id' => 1]);

        $this->assertDatabaseHas('sale_product', ['sale_id' => 1, 'product_id' => $response->json('data.products.0.product.id')]);
    }

    /**
     * Cancel sale
     */
    public function testCancelSale(): void
    {
        $response = $this->json('PATCH', '/api/v1/sales/1/cancel');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
        $response->assertJsonFragment(['id' => 1]);

        $this->assertDatabaseHas('sales', ['id' => 1, 'cancelled' => 1]);
    }
}
