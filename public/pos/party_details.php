<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$maxRows_DetailRS1 = 10000;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;
$query_DetailRS1 = "SELECT DISTINCT cid FROM invoice order by invoice_id ";
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysqli_query($conn,$query_limit_DetailRS1) or die(mysqli_error($conn));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysqli_query($conn,$query_DetailRS1);
  $totalRows_DetailRS1 = mysqli_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>-::Hazi Pipe POS::-</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
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
					<a href="#">লেনদেন ব্যবস্থাপনা </a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">

					<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>লেনদেন ব্যবস্থাপনা </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ক্রেতার নাম</th>
								  <th>মালিক</th>
								  <th>ঠিকানা</th>
								  <th>সর্বমোট বিল</th>
								  <th>সর্বমোট পরিশোধ</th>
								  <th>বকেয়া</th>
								  <th>কর্মপ্রক্রিয়া</th>
							  </tr>
						  </thead>   
						  <tbody>
                             <?php do { ?>
                             
							<tr>
								<td class="center"><?php 
								$cid=$row_DetailRS1['cid'];
								$query_DetailRS2 = "SELECT c_name,propaitor,address FROM customer WHERE cid='$cid'";
								$query_limit_DetailRS2 = sprintf("%s LIMIT %d, %d", $query_DetailRS2, $startRow_DetailRS1, $maxRows_DetailRS1);
								$DetailRS2 = mysqli_query($conn,$query_limit_DetailRS2) or die(mysqli_error($conn));
								$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);
								echo $row_DetailRS2['c_name']; ?></td>
								<td class="center"><?= $row_DetailRS2['propaitor']; ?></td>
								<td class="center"><?= $row_DetailRS2['address']; ?></td>


								<td class="center">
									<?php
								$bill_query = mysqli_query($conn,"SELECT sum(total_bill) as bill FROM invoice WHERE cid='$cid'") or die(mysqli_error($conn));
								$row_DetailRS3 = mysqli_fetch_assoc($bill_query);
								$bill=$row_DetailRS3['bill'];
								$totalrow=mysqli_num_rows($bill_query);
								if($totalrow>0){
								$formatbill = number_format($bill, 2);
								echo convertbn($formatbill);
								}
								else {
									$bill=='0.00';
								echo $bill;
								}
								 ?> </td>
								<td class="center"><?php
								$paid_query = mysqli_query($conn,"SELECT sum(amount) as paid FROM payment WHERE cid='$cid'") or die(mysqli_error($conn));
								$row_DetailRS4 = mysqli_fetch_assoc($paid_query);
								$paid= $row_DetailRS4['paid'];
								$totalrow2=mysqli_num_rows($paid_query);
								if($totalrow2>0){
									$formatpaid = number_format($paid, 2);
								echo convertbn($formatpaid);
								}
								else {
								$paid==0.00;
								echo $paid;
								}

								?>
								</td>
								<td class="center"><?php $due=$bill-$paid;
								$formattedNum = number_format($due, 2);
								echo convertbn($formattedNum); ?></td>
								<td class="center">

                                <form method="post" action="customer_payment.php" name="form1">
                              <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                              <input type="hidden" name="due" value="<?php echo $formattedNum; ?>">
									<button type="submit" class="btn btn-primary">নগদ জমা</button>
										</form>
								</td>

							</tr>
                              <?php } while ($row_DetailRS1 = mysqli_fetch_assoc($DetailRS1)); ?>
						  </tbody>
					  </table>
					</div>
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
	
		<script src="js/jquery-ui.js"></script>
	
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

    <script src="js/auto.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
