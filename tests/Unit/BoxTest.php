<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoxTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBox()
    {
        $user = factory(\App\User::class)->create();
        $recipe = factory(\App\Recipe::class)->create();

        $data  = [
            'user_id' => $user->id,
            'delivery_date' => Carbon::now()->addDays(3),
            'recipe_ids' => [$recipe->id]
        ];

        $response = $this->json('POST', '/api/box/create',$data);

        $response->assertStatus(201);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Box created"]);
        $response->assertJsonStructure(
            $this->createJsonStructure()
        );
    }

    private function createJsonStructure()
    {
        return [
            "status",
            "message",
            "data" => [
                "user_id",
                "delivery_date",
                "id",
                "recipes" => [
                    "*"  => [
                        "id",
                        "recipe_id",
                        "ingredient_id",
                        "amount",
                        "ingredient" => [
                            "id",
                            "name",
                            "measure",
                            "supplier",
                        ],
                    ]
                ]
            ]
        ];
    }
}
