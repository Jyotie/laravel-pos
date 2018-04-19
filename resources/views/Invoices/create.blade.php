@extends('layout.master')
@section('content')
<script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Create Invoice.
            <small class="pull-right">Date: {{date('d/m/Y')}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
          Select Product
    <form id="product">
    <select class="productName form-control" style="width:400px;" id="productName" price="0" name="productName"></select><br/>
    <input class="quantity form-control" style="width:200px;" type="text" id="quantity" placeholder="quantity">
    <input type="button" class="add-row" value="Add Row">
     </form>
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Select Customer</b><br>
          <form id="customer" action="/invoices" method="post">
      {{ csrf_field() }}
    <select class="cid form-control" style="width:400px;" id="cid" price="0" name="cid"></select><br/>

    Date:<input type="date" name="invoice_date" format="dd/MM/yyyy" value="{{date('Y-m-d')}}"> <br>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="producttbl" name="" class="table table-striped">
            <thead>
            <tr>
                <th width="10%">Select</th>
                <th width="25%">Product Code</th>
                <th width="25%">Product Name</th>
                <th width="10%">quantity</th>
                <th width="10%">Price</th>
                <th width="20%">Total</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <button type="button" class="delete-row">Delete Row</button>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-8">
          <p class="lead">&nbsp;</p>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
                         <div class="form-group">
                  <label for="inputEmail3" class="col-sm-5 control-label">Total</label>

                  <div class="col-sm-5">
                     <input type="number" name="subtotal" class="form-control" id="subTotal" placeholder="Subtotal"
                                                           onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                           onpaste="return false;" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-5 control-label">Vat</label>

                  <div class="col-sm-5">
                     <input type="number" name="tax" class="form-control" id="tax"
                                                           placeholder="Vat %" onkeypress="return IsNumeric(event);"
                                                           ondrop="return false;" onpaste="return false;">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-5 control-label">Vat Amount</label>

                  <div class="col-sm-5">
                    <input type="number" name="taxAmount" class="form-control"
                                                           id="taxAmount" placeholder="Tax" ondrop="return false;"
                                                           onpaste="return false;" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-5 control-label">Total Bill</label>

                  <div class="col-sm-5">
                                                    <input name="total_bill" type="number" class="form-control"
                                                           id="totalAftertax" placeholder="Total"
                                                           onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                           onpaste="return false;" readonly>
                  </div>
                </div>


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
<input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
<button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>Submit</button>
     </form>
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
       

      </div>
    </section>
<script>
  var postBaseUrl = '{{url("/")}}';
</script>
<script src="{{ asset('js/auto.js') }}"></script>          

@endsection
