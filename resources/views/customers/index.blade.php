@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Customer
                        <button class="float-right btn btn-primary"><a class="text-white" href="{{ route('customers.create') }}">New Customer</a></button>
                    </div>

                    <div class="card-body">


                        <table class="table table-bordered">

                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Name </th>
                                    <th>Phone </th>
                                    <th>Address </th>


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
                                    <td><button class="btn btn-button btn-block btn-danger text-white">

                                            <a href="#" class="text-white" onclick="

                                              var result = confirm('Are you sure you want to delete the Customer');

                                              if(result)
                                              {
                                                  event.preventDefault();
                                                  document.getElementById('delete-form').submit();
                                              }

                                            ">
                                                delete
                                            </a>

                                            <form id="delete-form" action="{{route('customers.destroy',[$customer->id])}}" method="post" style="display: none;">

                                               @csrf
                                               @method('DELETE')
                                                <input type="hidden" name="del" id="del" value="{{ $customer->id }}">

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