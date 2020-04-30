<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;
    public function testListIngredients()
    {
        $response = $this->json('GET', '/api/ingredient/list');
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Ingredients list"]);
        $response->assertJsonStructure(
            $this->listJsonStructure()
        );
    }

    public function testCreateIngredients()
    {
        $data  = [
            'name' => 'banana',
            'measure' => 'pieces',
            'supplier' => "Justrite"
        ];

        $response = $this->json('POST', '/api/ingredient/create',$data);
        $response->assertStatus(201);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Ingredient created"]);
        $response->assertJsonStructure(
            $this->createJsonStructure()
        );
    }

    private function listJsonStructure()
    {
        return [
            "status",
            "message",
            "data" => [
                "ingredients" => [
                    "*" => [
                        "id",
                        "name",
                        "measure",
                        "supplier"
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
                "measure",
                "supplier",
                "id",
            ]
            ];
    }
}
