<?php

namespace Tests\Unit\Unit\Controllers;

use App\Models\City;
use App\Models\OfficeSpace;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    // use RefreshDatabase;

    public function test_city_index()
    {
        // $city = City::factory()->create();
        // $city = $city->has(OfficeSpace::factory()->count(3)->create());
        $response = $this->withHeaders([
            'X-API-KEY' => 'knadnu2nlekni8x7jkl2j3',
        ])->getJson('api/cities');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name', 'slug', 'photo', 'officeSpaces_count']
                     ]
                 ]);
    }

    public function test_officeSpace_show_in_city()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => 'knadnu2nlekni8x7jkl2j3',
        ])->getJson('api/city/excepturi-repudiandae-maiores-est-laboriosam');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'officeSpaces_count',
                'officeSpaces' => [
                    '*' => [
                        'id',
                        'name',
                        'city' => ['id', 'name'],
                        'photos' => [
                            '*' => ['id', 'photo']
                        ]
                    ]
                ]
            ]
        ]);

    }

}