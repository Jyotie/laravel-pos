<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$pay_date=date("Y-m-d",strtotime($_POST['pay_date']));
$cid=$_POST['cid'];
$amount=$_POST['amount'];
$created_by=$_POST['created_by'];
$insertSQL = sprintf("INSERT INTO payment (pay_date, cid, amount,created_by) VALUES ('$pay_date', '$cid', '$amount','$created_by')");
mysqli_select_db($conn,$database_conn);
$Result1 = mysqli_query($conn,$insertSQL) or die(mysqli_error($conn));
$pay_id = mysqli_insert_id($conn);
$insertGoTo = "print_receipt.php?pay_id=$pay_id";
header(sprintf("Location: %s", $insertGoTo));
}
mysqli_select_db($conn, $database_conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>-::Hazi Pipe POS::-</title>

	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">

	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<?php include('header.php'); ?>
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<?php  include('menu.php'); ?>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">নীড়</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">প্রোডাক্ট রেজিস্ট্রেশন ফরম</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>নগদ জমা রশিদ</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  name="form1" action="<?php echo $editFormAction; ?>" accept-charset="utf-8" method="post">
						  <fieldset>
                          <?php
if ((isset($_REQUEST['cid'])) && ($_REQUEST['due'])){
$cid=$_REQUEST['cid'];
$due=$_REQUEST['due'];
$query_Recordset1 = "SELECT * FROM customer where cid='$cid'";
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
                          <div id="redirect">
						    <div class="control-group">
							  <label class="control-label" for="productName"> ক্রেতার নামঃ</label>
							  <div class="controls">
                              <input type="hidden" name="cid" value="<?php echo $cid?>">
							    <input class="input-xlarge disabled" id="disabledInput" type="text" value="<?php echo $row_Recordset1['c_name']?>" disabled="">
						      </div>
						    </div> 
							<div class="control-group">
							  <label class="control-label" for="productLine">বকেয়াঃ</label>
							  <div class="controls">
               <input class="input-xlarge disabled" id="disabledInput" type="text" value="<?php echo $due;?>" disabled="">
  						      </div>
						    </div>
                            </div>
                           <?php } 
						   else { 			   
						   
						   ?> 
                            <div id="direct">
						    <div class="control-group">
							  <label class="control-label" for="productName"> ক্রেতার নামঃ</label>
							  <div class="controls">
                              
							    <select name="cid" id="selectError3">
			                  <?php
							  mysqli_select_db($conn, $database_conn);
$query_Recordset2 = "SELECT * FROM customer";
$Recordset2 = mysqli_query($conn,$query_Recordset2) or die(mysqli_error($conn));
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
								do {  
								?>
			                  <option value="<?php echo $row_Recordset2['cid']?>"><?php echo $row_Recordset2['c_name']?></option>
			                  <?php
								} while ($row_Recordset2 = mysqli_fetch_assoc($Recordse2));
  								$rows = mysqli_num_rows($Recordset2);
  								if($rows > 0) {
      							mysqli_data_seek($Recordset2, 0);
	  							$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
  								}
								?>
								  </select>
						      </div>
						    </div> 
							<div class="control-group">
							  <label class="control-label" for="productLine">বকেয়াঃ</label>
							  <div class="controls">
               
  						      </div>
						    </div>
                            </div>
                            <?php } ?>
                            
								<div class="control-group">
							  <label class="control-label" for="productDescription">জমার তারিখঃ</label>
							  <div class="controls"><?php $UTCObj = new DateTime("now", new DateTimeZone("Asia/Dhaka"));

											$today = $UTCObj->format("m/d/Y");
										 ?>
							    <input type="text" name="pay_date" class="input-xlarge datepicker" id="date01" value="<?php echo $today ; ?>">
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="quantityInStock">নগদ জমাঃ</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<span class="add-on">টাকা</span><input id="appendedPrependedInput" name="amount" size="16" type="text"><span class="add-on">.00</span>
								  </div>
								</div>
							  </div>
                              <p>প্রস্তুতকারকঃ</br> <input type="hidden" name="created_by" value="<?php echo $username;?>"><?php echo $username;?> </p>
                              
							<div class="form-actions">
                            <button type="submit" class="btn btn-primary">যোগ করুন</button>
							 <button type="reset" class="btn">বাতিল</button>
							</div>
						  </fieldset>
                           <input type="hidden" name="MM_insert" value="form1">
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

			<div class="row-fluid sortable"><!--/span-->
			
			</div><!--/row-->
			
	

    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
		<?php include('footer.php'); ?>
	
		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->

  
	
</body>
</html>
