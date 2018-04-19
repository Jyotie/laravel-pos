<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$query1 = "SELECT count(*)as ttlcustomer FROM customer";
$DetailRS1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
$query2 = "SELECT count(*)as ttlsale, sum(predue)as tpaid, sum(due) as dues, sum(total_bill)as gt FROM invoice ";
$DetailRS2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);

$query3 = "SELECT count(*)as ttlpro FROM products ";
$DetailRS3 = mysqli_query($conn,$query3) or die(mysqli_error($conn));
$row_DetailRS3 = mysqli_fetch_assoc($DetailRS3);
$query4 = "SELECT count(*)as ttlcat FROM category ";
$DetailRS4 = mysqli_query($conn,$query4) or die(mysqli_error($conn));
$row_DetailRS4 = mysqli_fetch_assoc($DetailRS4);
$query5 = "SELECT sum(quantityInStock)as motorst FROM products where productLine=1 ";
$DetailRS5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$row_DetailRS5 = mysqli_fetch_assoc($DetailRS5);

$query6 = "SELECT sum(quantityInStock)as pipest FROM products where productLine=2 ";
$DetailRS6 = mysqli_query($conn,$query6) or die(mysqli_error($conn));
$row_DetailRS6 = mysqli_fetch_assoc($DetailRS6);

$query7 = "SELECT invoice_id, invoice_date, total_bill FROM invoice Order by invoice_id DESC limit 5 ";
$DetailRS7 = mysqli_query($conn,$query7) or die(mysqli_error($conn));
$row_DetailRS7 = mysqli_fetch_assoc($DetailRS7);

$query8 = "SELECT productName, quantityInStock, Price FROM products Order by productCode DESC limit 10 ";
$DetailRS8 = mysqli_query($conn,$query8) or die(mysqli_error($conn));
$row_DetailRS8 = mysqli_fetch_assoc($DetailRS8);


?>
<!DOCTYPE html>
<html lang="bn">
<style>
@font-face { font-family: 'Siyam Rupali';
    src: url('https://bits.wikimedia.org/static-current/extensions/UniversalLanguageSelector/data/fontrepo/fonts/SiyamRupali/SiyamRupali.eot?version=1.070');
    src: local('Siyam Rupali'),     url('https://bits.wikimedia.org/static-current/extensions/UniversalLanguageSelector/data/fontrepo/fonts/SiyamRupali/SiyamRupali.woff?version=1.070') format('woff'),        url('https://bits.wikimedia.org/static-current/extensions/UniversalLanguageSelector/data/fontrepo/fonts/SiyamRupali/SiyamRupali.ttf?version=1.070') format('truetype');
    font-style: normal;}
</style>
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
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>

			<div class="row-fluid">
				
				<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,4,2,4</div>
					<div class="number"><?php echo  convertbn($row_DetailRS1['ttlcustomer']);?> জন  </div>
					<div class="title">কাস্টমার</div>
					<div class="footer">
						<a href="manage_client.php">  রিপোর্ট দেখুন</a>
					</div>	
				</div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number"><?php echo  convertbn($row_DetailRS2['ttlsale']);?> টি</div>
					<div class="title">বিক্রয়</div>
					<div class="footer">
						<a href="all_sale.php"> রিপোর্ট দেখুন</a>
					</div>
				</div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,3,4,5,6,7,8</div>
					<div class="number"><?php echo  convertbn($row_DetailRS3['ttlpro']);?> ধরনের</div>
					<div class="title">পন্য</div>
					<div class="footer">
						<a href="manage_product.php">  রিপোর্ট দেখুন</a>
					</div>
				</div>
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
					<div class="number"><?php echo  convertbn($row_DetailRS4['ttlcat']);?>টি</div>
					<div class="title">ক্যাটাগরি</div>
					<div class="footer">
						<a href="manage_category.php">  রিপোর্ট দেখুন</a>
					</div>
				</div>	
				
			</div>		

<?php
$ttlsale=$row_DetailRS2['gt'];
$ttlpaid=$row_DetailRS2['tpaid'];
$ttldue=$row_DetailRS2['dues'];

?>
			
							
			
			
			<div class="row-fluid">
				
				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>বর্তমান পরিসংখ্যান</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li>
								<a href="#">
									<i class="icon-arrow-up green"></i>                               
									<strong><?php echo  convertbn($row_DetailRS1['ttlcustomer']);?></strong>
									সংখ্যক বর্তমান কাস্টমার                                    
								</a>
							</li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong><?php echo  convertbn($row_DetailRS2['ttlsale']);?></strong>
							  টি বিক্রয় সম্পন্ন
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong><?php echo  convertbn($row_DetailRS3['ttlpro']);?></strong>
							   ধরনের পন্য                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong><?php echo  convertbn($row_DetailRS4['ttlcat']);?></strong>
							   ক্যাটাগরির পন্য                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up green"></i>                               
							  <strong>112</strong>
							  ফুট পাইপ বিক্রয়                                    
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong>31</strong>
							   ইউনিট মোটর বিক্রি
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong><?php echo  convertbn($row_DetailRS6['pipest']);?></strong>
							   ফুট পাইপ মজুদ                                              
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong><?php echo  convertbn($row_DetailRS5['motorst']);?></strong>
							  ইউনিট মোটর মজুদ                                    
							</a>
						  </li>
						</ul>
					</div>
				</div><!--/span-->
				
				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white user"></i><span class="break"></span>সর্বশেষ ৫ টি বিক্রয়</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
                         <?php do { ?>
							<li class="green">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>মেমো নং:</strong> <?php echo  convertbn($row_DetailRS7['invoice_id']);?><br>	
								<strong>তারিখ:</strong> <?php echo  convertbn($row_DetailRS7['invoice_date']);?><br>
								<strong>সর্বমোট:</strong> <?php echo  convertbn($row_DetailRS7['total_bill']);?> টাকা             
							</li>
                             <?php } while ($row_DetailRS7 = mysqli_fetch_assoc($DetailRS7)); ?>
						</ul>
					</div>
				</div><!--/span-->
				
				<div class="box black span4 noMargin" onTablet="span12" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white check"></i><span class="break"></span>সর্বশেষ ১০ টি পন্য</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="todo metro">
							<ul class="todo-list">
                              <?php do { ?>
								<li class="blue">
									<a class="action icon-check-empty" href="#"></a>	
									<?php echo $row_DetailRS8['productName'];?>
									<strong>মূল্য :<?php echo  convertbn($row_DetailRS8['Price']);?></strong>
								</li>
                                 <?php } while ($row_DetailRS8 = mysqli_fetch_assoc($DetailRS8)); ?>
							
							</ul>
						</div>	
					</div>
				</div>
			
			</div>
			
     

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
	
<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
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
	<!-- end: JavaScript-->
	
</body>
</html>
