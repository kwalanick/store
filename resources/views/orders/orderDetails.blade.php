@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Order Details

                        <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            New Item
                        </button>
                    </div>

                    <div class="card-body">


                        <table class="table table-bordered">

                            <thead>

                            <tr>
                                <th>#</th>
                                <th>Order ID </th>
                                <th>Product ID </th>
                                <th>Quantity </th>
                                <th>Total </th>
                            </tr>

                            </thead>

                            <tbody>

                            @foreach($details AS $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->order->id }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->total }}</td>

                                    <td><button class="btn btn-button btn-block btn-primary text-white"><a href="{{route('orderdetails.destroy',[$detail->id])}}" class="text-white">Delete</a></button></td>


                                </tr>
                            @endforeach

                            </tbody>




                        </table>



                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <!--Order Details Create Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <form action="">

                                <div class="form-group">
                                    <label>Order ID</label>
                                    <input type="text" name="order_id" class="form-control" value="{{ $order->id }}">
                                    @if($errors->has('order_id'))
                                        <p class="text-danger">{{ $errors->first('order_id') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label>Product</label>
                                    <select name="product_id" class="form-control">

                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach

                                    </select>

                                    @if($errors->has('product_id'))
                                        <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control" value="">
                                    @if($errors->has('quantity'))
                                        <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" name="total" class="form-control" value="">
                                    @if($errors->has('total'))
                                        <p class="text-danger">{{ $errors->first('total') }}</p>
                                    @endif

                                </div>


                            </form>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>

@endsection