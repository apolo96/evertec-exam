@extends('app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-info" role="alert">
                ¡Welcome to eBookCommerce!
            </div>
            <h1>Buy the eBook! Only COP $80,000</h1>
            <form method="post" action="{{route('order.store')}}">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"placeholder="Enter email" name="customer_email" required>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control"placeholder="Enter mobile number" name="customer_mobile" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">New Order</button>
            </form>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors->first()}}
                </div>
            @endif
        </div>
    </div>

@stop
