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
    use RefreshDatabase;

    public function test_booking_details_success()
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

    public function test_booking_details_failed()
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
}
