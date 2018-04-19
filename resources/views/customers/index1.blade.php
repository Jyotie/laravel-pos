@extends('layout.master')
@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Address</th>
              <th scope="col">Phone</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Created At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)
            <tr>
              <th scope="row">{{$customer->id}}</th>
              <td><a href="/customers/{{$customer->cid}}">{{$customer->c_name}}</a></td>
              <td>{{$customer->address}}</td>
              <td>{{$customer->phone}}</td>
              <td>{{$customer->email}}</td>
              <td>{{$customer->created_at->toFormattedDateString()}}</td>
              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('customers/' . $customer->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('customers', [$customer->id])}}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn btn-danger" value="Delete"/>
                  </form>
              </div>
 </td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection
 