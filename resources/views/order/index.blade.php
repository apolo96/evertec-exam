@extends('app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                ¡Welcome to eBookCommerce! - Order History
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Payment ID: {ID}</h5>
                    <h5>Customer</h5>
                    <p class="card-text">Name: </p>
                    <p class="card-text">Email: </p>
                </div>
                <div class="card-footer">
                    <p>Status</p>
                    <span class="badge badge-primary">{STATUS}</span>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Payment ID: {ID}</h5>
                    <h5>Customer</h5>
                    <p class="card-text">Name: </p>
                    <p class="card-text">Email: </p>
                </div>
                <div class="card-footer">
                    <p>Status</p>
                    <span class="badge badge-primary">{STATUS}</span>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Payment ID: {ID}</h5>
                    <h5>Customer</h5>
                    <p class="card-text">Name: </p>
                    <p class="card-text">Email: </p>
                </div>
                <div class="card-footer">
                    <p>Status</p>
                    <span class="badge badge-primary">{STATUS}</span>
                </div>
            </div>
        </div>
    </div>

@stop
