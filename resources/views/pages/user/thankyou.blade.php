@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <div class="account-box">
        <h2>Thank You For Your Order {{Auth::user()->name}}!</h2>
        <h3>Your Order has been received.</h3>
        <div class="col-7 d-flex shopping-box"><a href="{{url('/theway-shop')}}" class="ml-auto btn hvr-hover">Go Back To Home</a>
        </div>
    </div>
</div>
@endsection