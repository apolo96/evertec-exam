@extends('app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                ¡Welcome to eBookCommerce! - Order History
            </div>
        </div>
        <div class="col-12">
            @foreach($orders as $order)
                <div class="card mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Payment ID: {{$order->pay_id}}</h4>
                        <h4>Customer</h4>
                        <h5 class="card-text">Name: {{$order->customer_name}}</h5>
                        <h5 class="card-text">Email: {{$order->customer_email}} </h5>
                    </div>
                    <div class="card-footer">
                        <h4>Status</h4>
                        <h4><span class="badge badge-primary">{{$order->status}}</span></h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@stop
