<?php

namespace Tests\Unit\Unit\Controllers;

use App\Http\Controllers\Api\BookingTransactionController;
use App\Models\BookingTransaction;
use App\Models\OfficeSpace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\Api\BookingTransactionController\booking_details;

class BookingTransactionControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    public function test_get_booking_details_success()
    {
        $officeSpace = OfficeSpace::factory()->create();
        $bookingTransaction = BookingTransaction::factory()->create([
            'office_space_id' => $officeSpace->id,
            'phone_number' => '08388438434',
            'booking_trx_id' => 'OTRX1234'
        ]);

        $request = Request::create('/api/booking-details', 'GET', [
            'booking_trx_id' => $bookingTransaction->booking_trx_id,
            'phone_number' => $bookingTransaction->phone_number
        ]);

        $controller = new BookingTransactionController();
        $response = $controller->booking_details($request);

        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('data', $response->getData(true));
        $this->assertEquals($bookingTransaction->id, $response->getData(true)['data']['id']);
    }

    public function test_get_booking_details_not_found()
    {
        $request = Request::create('/api/booking-details', 'GET', [
            'booking_trx_id' => 'OTRX888999O',
            'phone_number' => '0001111222333'
        ]);

        $controller = new BookingTransaction();
        $response = $controller->booking_details($request);

        $this->assertEquals(404, $response->status());
        $this->assertEquals('Booking not found', $response->getData(true)['message']);
    }

    public function test_store_booking_transaction_success()
    {
        $officeSpace = OfficeSpace::factory()->create();
        $request = Request::create('/api/booking-store', 'POST', [
            'name' => 'John Doe',
            'phone_number' => '08123456789',
            'office_space_id' => $officeSpace->id,
            'started_at' => now(),
            'total_amount' => 15000000,
        ]);

        $controller = new BookingTransactionController();
        $response = $controller->store($request);

        $this->assertEquals(201, $response->status());
        $this->assertDatabaseHas('booking_transactions', [
            'phone_number' => '08123456789',
            'office_space_id' => $officeSpace->id,
            'is_paid' => false, 
        ]);
    }

    public function test_generates_unique_booking_trx_id()
    {
        BookingTransaction::factory()->create(['booking_trx_id' => 'OTRX1111']);
        BookingTransaction::factory()->create(['booking_trx_id' => 'OTRX2222']);

        $generateUniqueTrxId = BookingTransaction::generateUniqueTrxId();

        $this->assertNotEquals('OTRX1111', $generateUniqueTrxId);
        $this->assertNotEquals('OTRX2222', $generateUniqueTrxId);
        $this->assertMatchesRegularExpression('/OTRX[0-9]{4}/', $generateUniqueTrxId);
    }
}
