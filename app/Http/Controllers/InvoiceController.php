<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use DB;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('invoices.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }
    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataAjax(Request $request)
    {
        $data = [];
    
    
            if($request->has('q')){
                $search = $request->q;
                $data = DB::table("customers")
                ->select("cid","c_name")
                ->where('c_name','LIKE',"%$search%")
                ->get();
            }
    
    
            return response()->json($data);
        }

        /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataAjax2(Request $request)
    {
    


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("products")
            ->select("productCode","productName","Price")
            ->where('productName','LIKE',"%$search%")
            ->get();
        }


        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                //Validate
        
        $invoice = Invoice::create(['invoice_date' => $request->invoice_date,
              'cid' => $request->cid,
              'subtotal' => $request->subtotal,
              'tax' => $request->tax,
              'taxAmount' => $request->taxAmount,
              'total_bill' => $request->total_bill,
              'created_by' => $request->created_by]);

        //dd($invoice);
        //DB::select();
        dd($request->price);
        foreach($request->productCode AS $aa => $item){
            dd($request);
            dd($request->productCode[$aa]);
            DB::table('sale')
                ->insert(
                    array(
                        'invoice_id'=>$invoice->id,
                        'productCode' => $request->productCode[$aa],
                        'price' => $request->price[$aa],
                        'quantity' => $request->quantity[$aa],
                        'total' => $request->total[$aa]
                        )
                    );
                }

            

        return redirect('/invoices/'.$invoice->invoice_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
