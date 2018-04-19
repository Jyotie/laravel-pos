@extends('layout.master')
  
@section('content')
            <h1>Showing Customer {{ $customer->c_name }}</h1>
 
    <div class="jumbotron text-center">
        <p>
            <strong>Customer Name:</strong> {{ $customer->c_name }}<br>
            <strong>Address:</strong> {{ $customer->address }}<br>
            <strong>phone:</strong> {{ $customer->phone }}<br>
            <strong>email:</strong> {{ $customer->email }}
        </p>
    </div>
@endsection