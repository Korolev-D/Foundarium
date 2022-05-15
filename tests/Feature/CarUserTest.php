<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator;
use Illuminate\Http\Response;
use Tests\TestCase;

class CarUserTest extends TestCase
{
    public function clearTestUser()
    {
        $carUserIdForDelete = CarUser::where('car_id', 23)->value('id');
        $this->json('delete', "api/carusers/$carUserIdForDelete");
    }

    public function testGetCarUsers()
    {
        $this->json('get', 'api/carusers')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'created_at',
                            'car' => [
                                'id',
                                'model',
                                'created_at',
                            ]
                        ]
                    ]
                ]
            );
    }

    public function testGetCarUser()
    {
        $this->clearTestUser();

        $carUserData = [
            'name'   => 'Иванов Иван Иванович',
            'car_id' => 23,
        ];

        $carUser = CarUser::create(
            $carUserData
        );

        $this->json('get', 'api/carusers', ['id' => $carUser->id])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'created_at',
                            'car' => [
                                'id',
                                'model',
                                'created_at',
                            ]
                        ]
                    ]
                ]
            );

        $this->assertDatabaseHas('car_users', $carUserData);
    }

    public function testCreateCarUser()
    {
        $this->clearTestUser();

        $carUser = [
            'name'   => 'Иванов Иван Иванович',
            'car_id' => 23,
        ];
        $this->json('post', 'api/carusers', $carUser)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'created_at',
                        'car' => [
                            'id',
                            'model',
                            'created_at',
                        ]
                    ]
                ]
            );
        $this->assertDatabaseHas('car_users', $carUser);
    }

    public function testUpdateCarUser()
    {
        $this->clearTestUser();

        $carUser = CarUser::create([
            'name'   => 'Иванов Иван Иванович',
            'car_id' => 23,
        ]);

        $carUserUpdate = [
            'name'   => 'Тарасов Иван Иванович',
            'car_id' => 23,
        ];

        $this->json('put', "api/carusers/$carUser->id", $carUserUpdate)
            ->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteCarUser()
    {
        $this->clearTestUser();

        $carUserData = [
            'name'   => 'Иванов Иван Иванович',
            'car_id' => 23,
        ];

        $carUser = CarUser::create(
            $carUserData
        );

        $this->json('delete', "api/carusers/$carUser->id")
            ->assertNoContent();
        $this->assertDatabaseMissing('car_users', $carUserData);
    }
}
