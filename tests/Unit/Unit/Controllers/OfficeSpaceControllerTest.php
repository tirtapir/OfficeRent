<?php

namespace Tests\Unit\Unit\Controllers;

use App\Models\OfficeSpace;
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
        // $city = City::factory()->create();
        // $city = $city->has(OfficeSpace::factory()->count(3)->create());
        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209',
        ])->getJson('api/offices');
        
        // dd($response['data']['city']);
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

    // public function test_officeSpace_show_in_city()
    // {
    //     $response = $this->withHeaders([
    //         'X-API-KEY' => 'knadnu2nlekni8x7jkl2j3',
    //     ])->getJson('api/office/quaerat-exercitationem-odio-sint-id-sed');

    //     $response->assertStatus(200)
    //         ->assertJsonStructure([
    //             'data' => [
    //                 'id',
    //                 'name',
    //                 'officeSpaces_count',
    //                 'officeSpaces' => [
    //                     '*' => [
    //                         'id',
    //                         'name',
    //                         'city' => ['id', 'name'],
    //                         'photos' => [
    //                             '*' => ['id', 'photo']
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ]);
    // }
}
