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

                                <tr><td class="font-weight-bold">Customer Name</td><td class="" style="" align="center">{{ $order->customer->name }}</td></tr>
                                <tr><td class="font-weight-bold">Phone No</td><td align="center">{{ $order->customer->phone }}</td></tr>
                                <tr><td class="font-weight-bold">Status</td><td align="center">{{ $order->shipped }}</td></tr>
                               {{-- <tr><td class="font-weight-bold">Order Total</td><td>{{ $order->total }}</td></tr>
--}}
                            </table>





                        </div>

                        <br>
                        <hr>


                        <div class="details">

                            <table class="table table-bordered" id="">

                                <thead>
                                   <tr>
                                       <th class="font-weight-bold text-primary">#</th>
                                       <th class="font-weight-bold text-primary">Product</th>
                                       <th class="font-weight-bold text-primary">Quantity</th>
                                       <th class="font-weight-bold text-primary">Total</th>
                                   </tr>

                                </thead>

                                <tbody>

                                    @foreach($order->details As $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->total }}</td>

                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-bold">Order Total</td>
                                        <td class="font-weight-bold text-danger">Ksh.  {{ $order->total }}</td>
                                    </tr>



                                </tbody>

                            </table>

                        </div>



                        <br>
                        <hr>

                        @if(!$order->shipped)


                            <table class="table" id="products">

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

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>

    <script type="application/javascript">

        $(document).ready(function()
        {
            $('#orderitems').DataTable();
        } );

        $(document).ready(function()
        {
            $('#products').DataTable();
        } );

    </script>

@endsection
