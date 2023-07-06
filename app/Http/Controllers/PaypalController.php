<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{

    public function payment()
    {
        //
        $data = [];
        $data ["items"] = [
            [
                'name' => 'subscribe to channel',
                'price' => 1000,
                'desc' => 'Description',
                'qty' => 2
            ],
            [
                'name' => 'make like',
                'price' => 300,
                'desc' => 'Description',
                'qty' => 2
            ],
        ];

        $data["invoice_id"] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = 'http://127.0.0.1:8001/payment/success';
        $data['cancel_url'] = 'http://127.0.0.1:8001/cancel';
        $data['total'] = 2600;

        $Provider = new ExpressCheckout();
        $response = $Provider->setExpressCheckout($data, true);

//        dd($response['paypal_link']);
        return redirect($response['paypal_link']);


    }


    public function cancel()
    {
        //
        return response()->json('Payment Cancelled', 402);

    }


    public function success(Request $request)
    {
        //
        $Provider = new ExpressCheckout();
        $response = $Provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['Success', 'SUCCESSWITHWARNIG'])) {
            return response()->json('Paid Success');
        }
        return response()->json('fail payment', 402);
    }


}
