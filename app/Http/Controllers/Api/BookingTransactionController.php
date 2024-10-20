<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingDetailsRequest;
use App\Http\Requests\StoreBookingTransactionRequest;
use App\Http\Requests\UpdateBookingTransactionRequest;
use App\Http\Resources\Api\BookingTransactionResource as ApiBookingTransactionResource;
use App\Http\Resources\Api\ViewBookingResource;
use App\Models\BookingTransaction;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class BookingTransactionController extends Controller
{
    //
    public function booking_details(BookingDetailsRequest $request)
    {
        $booking = BookingTransaction::where('phone_number', $request->phone_number)
            ->where('booking_trx_id', $request->booking_trx_id)
            ->with(['officeSpace', 'officeSpace.city'])
            ->first();

        if (!$booking) {  
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }
        return new ViewBookingResource(($booking));

    }

    public function store(StoreBookingTransactionRequest $request)
    {
        $validatedData = $request->validated();

        $officepace =OfficeSpace::find($validatedData['office_space_id']);

        $validatedData['is_paid'] = false;
        $validatedData['booking_trx_id'] = BookingTransaction::generateUniqueTrxId();
        $validatedData['duration'] = $officepace->duration;

        $validatedData['ended_at'] = (new \DateTime($validatedData['started_at']))->modify("+{$officepace->duration} days")->format('Y-m-d');

        $bookingTransaction = BookingTransaction::create($validatedData);


        //mengembalikan response
        $bookingTransaction->load('officeSpace');
        return new ApiBookingTransactionResource($bookingTransaction);
    }

    public function update_booking(UpdateBookingTransactionRequest $request, $id)
    {
        $booking = BookingTransaction::find($id);

        if(!$booking) {
            return response()->json(['message' => 'Booking Not found'], 404);
        }

        $booking->update($request->validated());

        return new ApiBookingTransactionResource($booking->load('officeSpace'));
    }

    public function cancel_booking($id)
    {
        $booking = BookingTransaction::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking cancelled successfully']);
    }
    
}
