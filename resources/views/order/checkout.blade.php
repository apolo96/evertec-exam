@extends('app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-secondary" role="alert">
                <h3><a href="{{route('order.new')}}" class="badge badge-info">Click here to new Order</a></h3>
            </div>
            <div class="alert alert-info" role="alert">
                ¡Order Summary!
            </div>
            <div class="card">
                <h5 class="card-header">
                    An bestseller eBook! Only COP $80,000
                </h5>
                <div class="card-body">
                    <h4>Name</h4>
                    <h5>{{$order->customer_name}}</h5>
                    <h4>Email</h4>
                    <h5>{{$order->customer_email}}</h5>
                    <h4>Mobile</h4>
                    <h5>{{$order->customer_mobile}}</h5>
                    <hr>
                    <a href="{{$order->pay_process_url}}" target="_blank" class="btn btn-primary btn-lg btn-block">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

@stop
