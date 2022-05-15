<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CarTest extends TestCase
{
    public function clearTestCar()
    {
        $carIdForDelete = Car::where('model', 'AUDI')->value('id');
        $this->json('delete', "api/cars/$carIdForDelete");
    }

    public function testGetCars()
    {
        $this->json('get', 'api/cars')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'model',
                            'created_at',
                        ]
                    ]
                ]
            );
    }

    public function testGetCar()
    {
        $this->clearTestCar();

        $carData = [
            'model' => 'AUDI',
        ];

        $car = Car::create(
            $carData
        );

        $this->json('get', 'api/cars', ['id' => $car->id])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'model',
                            'created_at',
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('cars', $carData);
    }

    public function testCreateCar()
    {
        $this->clearTestCar();

        $carData = [
            'model' => 'AUDI',
        ];

        $this->json('post', 'api/cars', $carData)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'model',
                        'created_at',
                    ]
                ]
            );
        $this->assertDatabaseHas('cars', $carData);
    }

    public function testUpdateCar()
    {
        $this->clearTestCar();

        $car = Car::create([
            'model' => 'AUDI',
        ]);

        $carUpdate = [
            'model' => 'BMW',
        ];

        $this->json('put', "api/cars/$car->id", $carUpdate)
            ->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteCar()
    {
        $this->clearTestCar();

        $carData = [
            'model' => 'AUDI',
        ];

        $car = Car::create(
            $carData
        );

        $this->json('delete', "api/cars/$car->id")
            ->assertNoContent();
        $this->assertDatabaseMissing('cars', $carData);
    }
}
