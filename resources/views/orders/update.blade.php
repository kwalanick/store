@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Order</div>

                    <div class="card-body">

                        <form action="{{ route('orders.update',[$order->id]) }}" method="post">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label >Customer Name </label>
                                <select name="customer_id" class="form-control">

                                    <option value="{{ $order->customer->id }}" selected>{{ $order->customer->name }}</option>

                                    @foreach($customers as $customer)

                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach

                                </select>
                                @if($errors->has('customer_id'))
                                    <p class="text-danger">{{ $errors->first('customer_id') }}</p>
                                @endif

                            </div>



                            <div class="form-group">
                                <label>Order Total </label>
                                <input type="text" name="total"  class="form-control" value="{{$order->total }}">
                                @if($errors->has('total'))
                                    <p class="text-danger">{{ $errors->first('total') }}</p>
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