<?php
if(isset($_GET['uid']))
{
 $sql_query="DELETE FROM user WHERE uid=".$_GET['uid'];
 mysqli_query($conn,$sql_query);
 header("Location:index.php");
}
?>