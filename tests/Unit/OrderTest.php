<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testWeeklyOrder()
    {
        $ingredient = factory(\App\Ingredient::class)->create();

        $data  = [
            'order_date' => Carbon::now(),
            'supplier' => $ingredient->supplier
        ];

        $response = $this->json('GET', 'api/company/ingredients',$data);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Order gotten"]);
        $response->assertJsonStructure(
            $this->weeklyOrderJsonStructure()
        );
    }

    private function weeklyOrderJsonStructure()
    {
        return [
            "status",
            "message",
            "data" => [
                    "*"  => [
                        "ingredient_id",
                        "ingredient_name",
                        "ingredient_amount",
                        "ingredient_measure",
                    ]
                ]
            ];
    }
}
