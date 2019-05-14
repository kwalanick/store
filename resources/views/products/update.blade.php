@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Product</div>

                    <div class="card-body">

                        <form action="{{ route('products.update',[$product->id]) }}" method="post">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label >Products Name </label>
                                <input type="text" name="name"  class="form-control" value="{{ $product->name }}">
                                @if($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Products Price </label>
                                <input type="text" name="price"  class="form-control" value="{{ $product->price  }}">
                                @if($errors->has('price'))
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Products Quantity </label>
                                <input type="text" name="quantity"  class="form-control" value="{{$product->quantity }}">
                                @if($errors->has('quantity'))
                                    <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                @endif

                            </div>

                            <button class="btn btn-button btn-block">Save</button>



                        </form>



                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection