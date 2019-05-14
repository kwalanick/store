@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Orders

                        <button class="float-right btn btn-primary"><a class="text-white" href="{{ route('orders.create') }}">New Order</a></button>


                    </div>

                    <div class="card-body">


                        <table class="table table-bordered">

                            <thead>

                            <tr>
                                <th>#</th>
                                <th>Customer Name </th>
                                <th>Phone </th>
                                <th>Total </th>
                                <th>Order Status </th>


                            </tr>

                            </thead>

                            <tbody>

                            @foreach($orders AS $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->shipped?'Shipped':'Pending' }}</td>

                                    <td><button class="btn btn-button btn-block btn-primary text-white"><a href="{{route('orders.show',[$order->id])}}" class="text-white">Order Details</a></button></td>
                                    <td><button class="btn btn-button btn-block btn-success text-white"><a href="{{route('orders.edit',[$order->id])}}" class="text-white">edit</a></button></td>
                                    <td><button class="btn btn-button btn-block btn-danger text-white">

                                            <a href="#" class="text-white" onclick="

                                              var result = confirm('Are you sure you want to delete the order');

                                              if(result)
                                              {
                                                  event.preventDefault();
                                                  document.getElementById('delete-form').submit();
                                              }

                                            ">
                                                delete
                                            </a>

                                            <form id="delete-form" action="{{route('orders.destroy',[$order->id])}}" method="post" style="display: none;">

                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="del" id="del" value="{{ $order->id }}">

                                            </form>

                                        </button>

                                    </td>

                                </tr>
                            @endforeach

                            </tbody>




                        </table>



                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection