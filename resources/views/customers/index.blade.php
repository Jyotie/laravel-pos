@extends('layout.master')
@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
              <div class="box-header">
              <h3 class="box-title">Customer</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        </table>
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                <tr>
                  <td>{{$customer->cid}}</td>
                  <td><a href="/customers/{{$customer->cid}}">{{$customer->c_name}}</a></td>
                  <td>{{$customer->address}}</td>
                  <td>{{$customer->phone}}</td>
                  <td>{{$customer->email}}</td>
                  <td><div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('customers/' . $customer->cid . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>
                  
                  </td>
                  <td><form action="{{url('customers', [$customer->cid])}}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn btn-danger" value="Delete"/>
                  </form></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>

    
        
@endsection

 