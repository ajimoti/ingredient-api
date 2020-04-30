<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function testListRecipes()
    {
        $response = $this->json('GET', '/api/recipe/list');
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "recipes list"]);
        $response->assertJsonStructure(
            $this->listJsonStructure()
        );
    }

    public function testCreateRecipe()
    {
        $ingredient = factory(\App\Ingredient::class)->create();

        $data  = [
            'name' => 'Banana Porridge',
            'description' => 'This recipe explains how to make banana porridge',
            'ingredients' => [
                [
                    'id' => $ingredient->id,
                    'amount' => 3,
                ]
            ]
        ];

        $response = $this->json('POST', '/api/recipe/create',$data);
        $response->assertStatus(201);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "recipe created"]);
        $response->assertJsonStructure(
            $this->createJsonStructure()
        );
    }

    private function listJsonStructure()
    {
        return [
            "status",
            "message",
            "data"  => [
                "recipes" => [
                    '*'  => [
                        'id',
                        'name',
                        'description',
                        'ingredients' => [
                            "*" => [
                                'id',
                                'name',
                                'measure',
                                'supplier',
                            ]
                        ],
                    ]
                ],
                "pagination" => $this->paginationStructure()
            ]
        ];
    }


    private function createJsonStructure()
    {
        return [
            "status",
            "message",
            "data" => [
                "name",
                "description",
                "id",
                "ingredients" => [
                    "*"  => [
                            "id",
                            "name",
                            "measure",
                            "supplier",
                    ]
                ]
            ]
        ];
    }
}
