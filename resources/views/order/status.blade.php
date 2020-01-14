@extends('app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-secondary" role="alert">
                <h3><a href="{{route('order.new')}}" class="badge badge-info">Click here to new Order</a></h3>
            </div>
            <div class="alert alert-info" role="alert">
                ¡Order Status!
            </div>
            <div class="card">
                <h5 class="card-header">An bestseller eBook! Only COP $80,000</h5>
                <div class="card-body">
                    <h4>Payment ID: {{$order->pay_id}}</h4>
                    <h2><span class="badge badge-info">{{$order->status}}</span></h2>
                    <div class="card-body">
                        <h4>Name</h4>
                        <h5>{{$order->customer_name}}</h5>
                        <h4>Email</h4>
                        <h5>{{$order->customer_email}}</h5>
                        <hr>
                        @if($order->status != 'PAYED')
                            <a href="{{$order->pay_process_url}}" class="btn btn-primary btn-lg btn-block">Retry Pay</a>
                        @else
                            <h4><span class="badge badge-success">Thanks! Order PAID</span></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
