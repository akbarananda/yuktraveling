<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {

        // $validatedData = $request->validated();

        // // Pastikan 'price' memiliki nilai sebelum menyimpan
        // if (!isset($validatedData['price'])) {
        //     $validatedData['price'] = 0; // Sesuaikan dengan nilai default yang sesuai
        // }

        $order = Booking::create($request->all());

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->price,
            ),
            'customer_details' => array(
                'first_name' => $order->name,
                'phone' => $request->number_phone,
                'email' => $request->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        return view('checkout',compact('snapToken','order',));

        // return redirect()->back()->with([
        //     'message' => "Success, we'll process your booking",compact('snapToken','order')
        // ]);
    }
}
