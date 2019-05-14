@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Order Details</div>

                    <div class="card-body">

                        <div>

                            <table class="table table-bordered">

                                <tr><td class="font-weight-bold">Customer Name</td><td>{{ $order->customer->name }}</td></tr>
                                <tr><td class="font-weight-bold">Phone No</td><td>{{ $order->customer->phone }}</td></tr>
                                <tr><td class="font-weight-bold">Status</td><td>{{ $order->shipped }}</td></tr>
                                <tr><td class="font-weight-bold">Order Total</td><td>{{ $order->total }}</td></tr>

                            </table>





                        </div>


                        <div class="details">

                            <table class="table table-bordered">
                                @foreach($order->details As $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->total }}</td>

                                </tr>
                                @endforeach

                            </table>

                        </div>

                        @if(!$order->shipped)


                            <table class="table">

                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Add</th>
                                    </tr>

                                <tbody>

                                        @foreach($products AS $product)

                                            <tr>

                                                <td> {{ $loop->iteration }}</td>
                                                <td> {{ $product->name }}</td>
                                                <td> {{ $product->price }}</td>
                                                <td>
                                                    <form class="form-inline" action="{{ route('orders.update',[$order->id ]) }}" method="post">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="product_id" value="{{$product->id }}" class="form-control">
                                                        <input type="number" value="1"  name="quantity" min="1" class="form-control">

                                                        <button class="btn btn-success">Add</button>

                                                    </form>

                                                </td>

                                            </tr>

                                        @endforeach


                                </tbody>

                                </thead>


                            </table>



                        @endif


                    </div>




                </div>
            </div>
        </div>
    </div>
@endsection
