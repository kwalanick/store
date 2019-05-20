<?php

namespace App\Http\Controllers;

use App\Jobs\SendSmsJob;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Safaricom\Mpesa\Mpesa;

class MpesaController extends Controller
{
    //
    public function confirm(Request $request)
    {


        $data = $request->all();

        $string = json_encode($data);

        Storage::put('mpesa.txt',$string);

        $mpesa = json_decode($string);


        $merchant_id = $mpesa->Body->stkCallback->MerchantRequestID;
        $result_code = $mpesa->Body->stkCallback->ResultCode;

        $payment = Payment::where('merchant_id',$merchant_id)->first();

        if($payment and $result_code==0)
        {
            $payment->status=true;
            $payment->save();

            $order = Order::where('id',$payment->order_id)->first();
            $message = "Your payment for Order No #".$order->id." has been received";

            $this->dispatch(new SendSmsJob($order->customer->phone,$message));

        }


        //ngrok
        //php artisan make:controller ApiController

        //postman


    }
}
