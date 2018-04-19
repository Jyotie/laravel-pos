<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//test
Route::get('/', function () {
	$customers = App\Customer::pluck('c_name','cid')->toArray();
    return view('welcome',compact('customers'));
});

Route::get('/', function () {
    return view('auth.login');
    });


    
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('tasks', 'TaskController');

Route::resource('customers', 'CustomerController');
Route::resource('invoices', 'InvoiceController');
Route::get('invoices-ajax', 'InvoiceController@dataAjax');
Route::get('invoices-ajax2', 'InvoiceController@dataAjax2');


Route::get('select2-autocomplete', 'Select2AutocompleteController@layout');
Route::post('data-ajax', 'Select2AutocompleteController@dataAjax');