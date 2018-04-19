 
@extends('layout.master')
 
 @section('content')
 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Customer</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/customers" method="post">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="c_name" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="address" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="phone" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">E mail</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="email" placeholder="email">
                  </div>
                </div>
                
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
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
 @endsection
  