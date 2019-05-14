<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;

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
            'total'=>0

        ]);

        if($order)
        {
            return redirect()->route('orders.index')->with('success','Order Created');
        }

        return back()->withInput()->with('error','Order creation Failed!');

    }

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
