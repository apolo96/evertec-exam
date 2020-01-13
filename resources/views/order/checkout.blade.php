@extends('app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-info" role="alert">
                ¡Order Summary!
            </div>
            <div class="card">
                <h5 class="card-header">
                    An bestseller eBook! Only $40 USD
                    <a href="#" class="badge badge-info float-right">View Status</a>
                </h5>
                <div class="card-body">
                    <h5>Name</h5>
                    <p>[ANDRES FELIPE POLO]</p>
                    <h5>Email</h5>
                    <p>[example@example.com]</p>
                    <h5>Mobile</h5>
                    <p>[3023423493]</p>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Buy Now</button>
                </div>
            </div>
        </div>
    </div>

@stop
