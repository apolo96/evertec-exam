@extends('app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-info" role="alert">
                ¡Welcome to eBookCommerce!
            </div>
            <h1>Buy the eBook! Only $40 USD</h1>
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control"placeholder="Enter mobile number" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">New Order</button>
            </form>

        </div>
    </div>

@stop
