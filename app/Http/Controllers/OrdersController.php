<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSmsJob;
use App\Mail\OrderMail;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use AfricasTalking\SDK\AfricasTalking;
use Safaricom\Mpesa\Mpesa;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $orders = Order::orderBy('id','DESC')->get();

        return view('orders.index',compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = Customer::orderBy('id','DESC')->get();

        return view('orders.create',compact('customers'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([

            'customer_id'=>'required|numeric',

        ]);

        $order = Order::create([

            'customer_id'=>$request->customer_id,
            'user_id'=> Auth::user()->id,
            'total'=>0

        ]);

        $customer = Customer::find($request->customer_id);

        if($order)
        {
           // $email = new OrderMail();
           //Mail::to('kwalanick@gmail.com')->send($email);

            $phone = $customer->phone;
            $message = "Your order number #".$order->id." has been dispatched";

            //$this->sms($customer->phone, $message); -- direct

            //$this->dispatch(new SendSmsJob($phone,$message)); // Background Process

            //$this->dispatch(new SendEmailJob($customer,$order)); // Background Process

            $this->pay();


            return redirect()->route('orders.index')->with('success','Order Created');
        }

        return back()->withInput()->with('error','Order creation Failed!');

    }

    public function pay()
    {

        $mpesa = new Mpesa();

        $BusinessShortCode="174379";
        $LipaNaMpesaPasskey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType="CustomerPayBillOnline";
        $Amount="1";
        $PartyA="254710492692";
        $PartyB="174379";   // similar to business shortcode
        $PhoneNumber="254710492692";
        $CallBackURL="https://255c5130.ngrok.io/mpesa/confirm";
        $AccountReference="Testing";
        $TransactionDesc="Testing";
        $Remarks="Testing";

        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey,
                                                     $TransactionType, $Amount, $PartyA, $PartyB,
                                                     $PhoneNumber, $CallBackURL, $AccountReference,
                                                     $TransactionDesc, $Remarks);

        dd($stkPushSimulation);

    }

    //Policy
    //php artisan make:policy OrderPolicy --model=Order

    //php artisan make:job SendEmailJob
    //queues
    //queue driver == database redis beanstalk aws
    //php artisan queue:table

    // Change Queue Connection in .env to database

    // Dispatch Queue

    // Start a Queue
    // php artisan queue:work



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
        $products = Product::orderBy('id','DESC')->get();
        $order = Order::find($id);


        return view('orders.update',compact('order','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        $customers = Customer::orderBy('id','DESC')->get();

        $order = Order::find($order->id);



        return view('orders.update',compact('order','customers'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //

        $request->validate([

            'quantity'=>'required|integer|min:1'
        ]);


        $order = Order::find($order->id);

        $product = Product::find($request->product_id);

        $order->total +=$product->price * $request->quantity;

        $order->save();

        OrderDetail::create([

            'order_id'=>$order->id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'total'=>$product->price * $request->quantity,
        ]);

        return back()->withInput()->with('success','Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function destroy(Order $order)
    {
        //
        $deleteOrder = Order::find($order->id)->delete();

        if($deleteOrder)
        {
            return redirect()->route('orders.index')->with('success','Order Deleted');
        }
        return back()->withInput()->with('error','Order Deletion failed');
    }
}
