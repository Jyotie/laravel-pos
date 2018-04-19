<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;


class Select2AutocompleteController extends Controller
{
    /**
     * Show the application layout.
     *
     * @return \Illuminate\Http\Response
     */
    public function layout()
    {
    return view('select2');
    }


    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataAjax(Request $request)
    {
    $customers = App\Customer::pluck('c_name','cid')->toArray();
    return view('select2',compact('customers'));
    }


}
/*
require_once 'Connections/conn.php';
if(!empty($_POST['type'])){
	$type = $_POST['type'];
	$name = $_POST['name_startsWith'];
	$query = "SELECT productCode, productName,quantityInStock, Price  FROM products where quantityInStock >0 and UPPER($type) LIKE '".strtoupper($name)."%'";
	$result = mysqli_query($conn, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['productCode'].'|'.$row['productName'].'|'.$row['quantityInStock'].'|'.$row['Price'];
		array_push($data, $name);
	}
	echo json_encode($data);exit;
}
*/