<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;

class OrderController extends Controller
{
    public function checkout(Request $request){

        $request->request->add(['total_price' => $request->qty * 10000, 'status' => 'unpaid']);
        

        $order = Order::create($request->all());
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
                'gross_amount' => '10000',
            ),
            'customer_details' => array(
                'name' => $order->name,
                'phone' => $request->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        dd($snapToken);
        // return view('checkout',compact('snapToken','order',));
    }
}
