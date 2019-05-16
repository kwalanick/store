@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Customer
                        <button class="float-right btn btn-primary"><a class="text-white" href="{{ route('customers.create') }}">New Customer</a></button>
                    </div>

                    <div class="card-body">


                        <table class="table table-bordered" id="customers">

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Name </th>
                                    <th>Phone </th>
                                    <th>Address </th>

                                    <th></th>
                                    <th></th>
                                    <th></th>


                                </tr>

                            </thead>

                            <tbody>

                            @foreach($customers AS $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>

                                    <td><button class="btn btn-button btn-block btn-primary text-white"><a href="{{route('customers.index',[$customer->id])}}" class="text-white">view</a></button></td>
                                    <td><button class="btn btn-button btn-block btn-success text-white"><a href="{{route('customers.edit',[$customer->id])}}" class="text-white">edit</a></button></td>
                                    <td>
                                        <a href="#">

                                            <form action="{{ route('customers.destroy',[$customer->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>

                                            </form>

                                        </a>

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

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>

    <script type="application/javascript">

        $(document).ready(function()
        {
            $('#customers').DataTable();
        } );

    </script>

@endsection