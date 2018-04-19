<?php require_once('Connections/conn.php'); ?>
<?php
if(isset($_GET['productCode']))
{
 $sql_query="DELETE FROM products WHERE productCode=".$_GET['productCode'];
 mysqli_query($conn,$sql_query);
 header("Location: manage_product.php");
}
?>