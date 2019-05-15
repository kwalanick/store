@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        All Orders

                        <button class="float-right btn btn-primary"><a class="text-white" href="{{ route('orders.create') }}">New Order</a></button>


                    </div>

                    <div class="card-body">


                        <table class="table table-bordered" id="orders">

                            <thead>

                            <tr>
                                <th>#</th>
                                <th>Customer Name </th>
                                <th>Phone </th>
                                <th>Total </th>
                                <th>Order Status </th>

                                <th></th>
                                <th></th>
                                <th></th>


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

                                    <td><button class="btn btn-button btn-block btn-primary text-white"><a href="{{route('orders.show',[$order->id])}}" class="text-white">Details</a></button></td>
                                    <td><button class="btn btn-button btn-block btn-success text-white"><a href="{{route('orders.edit',[$order->id])}}" class="text-white">edit</a></button></td>
                                    <td>
                                        @if(!$order->shipped)
                                        @can('delete',$order)
                                        <button class="btn btn-button btn-block btn-danger text-white">

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


                                            </form>



                                        </button>
                                        @endcan
                                        @endif


                                    </td>

                                    <!-- Alternative -->



                                     {{--  <form action="{{ route('orders.destroy',[ $order->id ]) }}" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger">Removw</button>
                                      </form>--}}



                                </tr>
                            @endforeach

                            </tbody>




                        </table>



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
            $('#orders').DataTable();
        } );

    </script>

@endsection