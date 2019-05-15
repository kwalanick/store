@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Customer</div>

                    <div class="card-body">

                        <form action="{{ route('customers.store') }}" method="post">

                            @csrf

                            <div class="form-group">
                                <label >Customers Name </label>
                                <input type="text" name="name"  class="form-control" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Customers Phone </label>
                                <input type="text" name="phone"  class="form-control" value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Customers Address </label>
                                <input type="text" name="address"  class="form-control" value="{{ old('address') }}">
                                @if($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Customers Email </label>
                                <input type="email" name="email"  class="form-control" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
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