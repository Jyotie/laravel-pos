<?php
$bill_query = mysqli_query($conn,"SELECT sum(total_bill) as bill FROM invoice WHERE cid='$cid'") or die(mysqli_error($conn));
								$row_DetailRS3 = mysqli_fetch_assoc($bill_query);
								$bill=$row_DetailRS3['bill'];								
$paid_query = mysqli_query($conn,"SELECT sum(amount) as paid FROM payment WHERE cid='$cid'") or die(mysqli_error($conn));
								$row_DetailRS4 = mysqli_fetch_assoc($paid_query);
								$paid= $row_DetailRS4['paid'];
								$due=$bill-$paid;
								$formattedNum = number_format($due, 2);
								echo convertbn($formattedNum); 								
								
?>