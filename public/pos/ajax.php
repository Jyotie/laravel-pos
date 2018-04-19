<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
//setup php for working with Unicode data

header( 'Content-Type: text/html; charset=utf-8' ); 
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


