<?php require_once('Connections/conn.php');
$cid = intval($_GET['cid']);
$bill_query = mysqli_query($conn,"SELECT sum(total_bill) as bill FROM invoice WHERE cid='$cid'") or die(mysqli_error($conn));
$row_DetailRS3 = mysqli_fetch_assoc($bill_query);
$bill=$row_DetailRS3['bill'];

$paid_query = mysqli_query($conn,"SELECT sum(amount) as paid FROM payment WHERE cid='$cid'") or die(mysqli_error($conn));
$row_DetailRS4 = mysqli_fetch_assoc($paid_query);
$paid= $row_DetailRS4['paid'];

$due=$bill-$paid;
$formattedNum = number_format($due, 2);
?>

<input name="predue" type="number" class="form-control" id="predue" value="<?php echo $due; ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly> টাকা
