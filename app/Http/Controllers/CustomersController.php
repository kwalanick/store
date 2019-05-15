<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
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
        $customers = Customer::orderBy('id','DESC')->get();

        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customers.create');
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

            'name'=>'required|min:5',
            'phone'=>'required|unique:customers',
            'address'=>'required',
            'email'=>'required|email',

        ]);

        $customers = Customer::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,

        ]);

        if($customers)
        {
            return redirect()->route('customers.index')->with('success','Created Customer');
        }

        return back()->withInput()->with('error','Error');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        $customer = Customer::find($customer->id);

        return view('customers.update',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $customerUpdate = Customer::find($customer->id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,

        ]);

        if($customerUpdate)
        {
            return redirect()->route('customers.index')->with('success','Customer Updated');
        }

        return back()->withInput()->with('error','Customer Update failed');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        $customer = Customer::find($customer->id)->delete();

        if($customer)
        {
            return redirect()->route('customers.index')->with('success','Customer Deleted');
        }

        return back()->withInput()->with('error','Customer Deletion Failed');


    }
}
