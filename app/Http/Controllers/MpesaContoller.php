<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Safaricom\Mpesa\Mpesa;

class MpesaContoller extends Controller
{
    //
    public function confirm(Request $request)
    {

        $mpesa = new Mpesa();
        $callBackData = $mpesa->getDataFromCallback();

        $string = json_decode($callBackData);

        Storage::put('mpesa.txt',$string);

        //ngrok


    }
}
