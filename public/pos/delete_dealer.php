<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
if(isset($_GET['d_code']))
{
 $sql_query="DELETE FROM delar WHERE d_code=".$_GET['d_code'];
 mysqli_query($conn,$sql_query);
 header("Location: manage_delar.php");
}
if(isset($_GET['cid']))
{
 $sql_query="DELETE FROM customer WHERE cid=".$_GET['cid'];
 mysqli_query($conn,$sql_query);
 header("Location: manage_client.php");
}


?>