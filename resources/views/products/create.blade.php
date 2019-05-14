@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Product</div>

                    <div class="card-body">

                        <form action="{{ route('products.store') }}" method="post">

                            @csrf

                            <div class="form-group">
                                <label >Product Name </label>
                                <input type="text" name="name"  class="form-control" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Product Price </label>
                                <input type="text" name="price"  class="form-control" value="{{ old('price') }}">
                                @if($errors->has('price'))
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Product Quantity </label>
                                <input type="text" name="quantity"  class="form-control" value="{{ old('quantity') }}">
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