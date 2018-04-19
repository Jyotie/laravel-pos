<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index',compact('customers',$customers));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
        $request->validate([
            'c_name' => 'required|min:3',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        
        $customer = Customer::create(['c_name' => $request->c_name,
        'address' => $request->address,
        'phone' => $request->phone,
        'email' => $request->email]);
        return redirect('/customers/'.$customer->cid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show',compact('customer',$customer));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer',$customer));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
            $request->validate([
            'c_name' => 'required|min:3',
            'addrress' => 'required',
        ]);
        
        $customer->c_name = $request->c_name;
        $customer->address = $request->address;
		$customer->phone = $request->phone;
		$customer->email = $request->email;
        $customer->save();
        $request->session()->flash('message', 'Successfully modified the Customer!');
        return redirect('customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        $request->session()->flash('message', 'Successfully deleted the Customer!');
        return redirect('customers');
    }
}
