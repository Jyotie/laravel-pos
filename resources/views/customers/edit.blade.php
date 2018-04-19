@extends('layout.master')
 
@section('content')
    <h1>Edit Customer</h1>
    <hr>
     <form action="{{url('customers', [$customer->cid])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Customer Name</label>
        <input type="text" value="{{$customer->c_name}}" class="form-control" id="taskTitle"  name="c_name" >
      </div>
      <div class="form-group">
        <label for="description">Address</label>
        <input type="text" value="{{$customer->address}}" class="form-control" id="taskDescription" name="address" >
      </div>
         <div class="form-group">
        <label for="description">Phone</label>
        <input type="text" value="{{$customer->phone}}" class="form-control" id="taskDescription" name="phone" >
      </div>
         <div class="form-group">
        <label for="description">email</label>
        <input type="text" value="{{$customer->email}}" class="form-control" id="taskDescription" name="email" >
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection