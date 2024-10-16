<?php

namespace Tests\Unit\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class OfficeSpaceControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    // use RefreshDatabase;

    public function test_office_index()
    {

        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209',
        ])->getJson('api/offices');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'thumbnail',
                        'price',
                        'about',
                        'slug',
                        'city' => ['id', 'name', 'slug', 'photo'],
                        'address',
                    ]
                ]
            ]);
    }

    public function test_it_shows_office_space_details()
    {

        $response = $this->withHeaders([
            'X-API-KEY' => 'adkukgi28262eih98209',
        ])->getJson('api/office/quae-voluptatem-ut-magnam-magnam-quam');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'price',
                    'about',
                    'city' => ['id', 'name', 'slug', 'photo'],
                    'photos' => ['*'=> ['id', 'photo']],
                    'benefits' => ['*'=> ['id', 'name']],
                    'address'
                ]
            ]);
    }
}
