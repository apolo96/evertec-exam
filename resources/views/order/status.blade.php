@extends('app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-info" role="alert">
                ¡Order Summary!
            </div>
            <div class="card">
                <h5 class="card-header">An bestseller eBook! Only $40 USD</h5>
                <div class="card-body">
                    <h5>Payment ID: {ID}</h5>
                    <h5>Status <span class="badge badge-info">{status}</span></h5>
                    <h5>Name</h5>
                    <p>[ANDRES FELIPE POLO]</p>
                    <h5>Email</h5>
                    <p>[example@example.com]</p>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Buy Now</button>
                </div>
            </div>
        </div>
    </div>

@stop
