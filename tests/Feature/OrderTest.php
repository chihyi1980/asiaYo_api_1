<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_order_validation()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 2050,
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Price is over 2000']);
    }

    // 添加更多測試案例...
}
