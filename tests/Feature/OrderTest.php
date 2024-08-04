<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_order_validation_1()
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

    public function test_order_validation_2()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'elody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 2050,
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Name is not capitalized']);
    }

    public function test_order_validation_3()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 1,
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 1990,
            'currency' => 'TWD',
        ]);

        $response->assertStatus(422);
    }

    public function test_order_validation_4()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => '測試Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 1990,
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Name contains non-English characters']);
    }

    public function test_order_validation_5()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 2001,
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Price is over 2000']);
    }


    public function test_order_validation_6()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 1990,
            'currency' => 'TWW',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Currency format is wrong']);
    }

    public function test_order_validation_7()
    {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 1990,
            'currency' => 'USD',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['price'=> 61690, 'currency' => 'TWD']);
    }
}
