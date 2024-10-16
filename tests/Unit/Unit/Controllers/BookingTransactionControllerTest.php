<?php

namespace Tests\Unit\Unit\Controllers;

use App\Http\Controllers\Api\BookingTransactionController;
use App\Models\BookingTransaction;
use App\Models\OfficeSpace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class BookingTransactionControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    // use RefreshDatabase;

    public function test_it_requires_phone_number_and_booking_trx_id()
    {
        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209',
        ])->postJson('api/check-booking', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['phone_number', 'booking_trx_id']);
    }

    public function test_it_requires_booking_trx_id_if_only_phone_number_is_provided()
    {
        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209',
        ])->postJson('api/check-booking', [
            'phone_number'=> '088882821',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['booking_trx_id']);
    }
    
    public function test_it_requires_phone_number_if_only_booking_trx_id_is_provided()
    {
        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209',
        ])->postJson('api/check-booking', [
            'booking_trx_id'=> 'OTRX7623'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['phone_number']);
    }

    public function test_it_returns_not_found_if_booking_does_not_exist()
    {
        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209',
        ])->postJson(
            '/api/check-booking',
            [
                'phone_number' => '111110000',
                'booking_trx_id' => 'OTRX0965'

            ]
        );

        $response->assertStatus(404)
            ->assertJson([
                'message'=>'Booking not found'
            ]);
    }

    public function test_it_returns_booking_details_if_booking_exists()
    {
        $response = $this->withHeaders([
            'x-api-key' => 'adkukgi28262eih98209'
        ])->postJson(
            '/api/check-booking',
            [
                'phone_number' => '+1 (463) 374-3168',
                'booking_trx_id' => 'OTRX4774'
            ]
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'booking_trx_id',
                    'name',
                    'phone_number',
                    'is_paid',
                    'office' => [
                        'id',
                        'name', 
                        'city' => [
                            'id',
                            'name']
                    ],
                    'total_amount',
                    'duration',
                    'started_at',
                    'ended_at',
                ]
            ]);
    }

    public function test_it_can_generates_unique_booking_trx_id()
    {

        $generateUniqueTrxId = BookingTransaction::generateUniqueTrxId();

        $this->assertNotEquals('OTRX4774', $generateUniqueTrxId);
        $this->assertMatchesRegularExpression('/OTRX[0-9]{4}/', $generateUniqueTrxId);
    }
}
