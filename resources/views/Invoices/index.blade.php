@extends('layout.master')
@section('content')

      <form action="/invoices" method="post">
      {{ csrf_field() }}

      Date:<input type="date" name="invoice_date"> <br>
      CID: <input type="number" name="cid"><br>
      subtotal: <input type="number" name="subtotal"><br>
      tax: <input type="text" name="tax"><br>
      taxamount:<input type="text" name="taxAmount"><br>
      taxamount:<input type="text" name="total_bill"><br>
      Crated By:<input type="text" name="created_by" value="{{ Auth::user()->name }}">



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