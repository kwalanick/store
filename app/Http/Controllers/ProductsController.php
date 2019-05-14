<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::orderBy('id','DESC')->get();

        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
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
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',

        ]);

        $product = Product::create([

            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,

        ]);

        if($product)
        {
            return redirect()->route('products.index')->with('success','Product has been created');
        }

        return back()->withInput()->with('error','Product creation failed');
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
    public function edit(Product $product)
    {
        //
        $product= Product::find($product->id);

        return view('products.update',compact('product'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $productUpdate = Product::find($product->id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
        ]);

        if($productUpdate)
        {
            return redirect()->route('products.index')->with('success','Product Updated');
        }

        return back()->withInput()->with('error','Product Update failed');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $deleteProduct = Product::find($product->id)->delete();

        if($deleteProduct)
        {
            return redirect()->route('products.index')->with('success','Product Deleted');
        }
        return back()->withInput()->with('error','Product Deletion failed');


    }
}
