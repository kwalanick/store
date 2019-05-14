@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Products

                        <button class="float-right btn btn-primary"><a class="text-white" href="{{ route('products.create') }}">New Product</a></button>

                    </div>

                    <div class="card-body">


                        <table class="table table-bordered">

                            <thead>

                            <tr>
                                <th>#</th>
                                <th>Name </th>
                                <th>Price </th>
                                <th>Quantity </th>


                            </tr>

                            </thead>

                            <tbody>

                            @foreach($products AS $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>

                                    <td><button class="btn btn-button btn-block btn-primary text-white"><a href="{{route('products.index',[$product->id])}}" class="text-white">view</a></button></td>
                                    <td><button class="btn btn-button btn-block btn-success text-white"><a href="{{route('products.edit',[$product->id])}}" class="text-white">edit</a></button></td>
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

                                            <form id="delete-form" action="{{route('products.destroy',[$product->id])}}" method="post" style="display: none;">

                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="del" id="del" value="{{ $product->id }}">

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