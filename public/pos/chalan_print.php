<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$invoice_id=$_REQUEST['invoice_id'];
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;
$query_DetailRS1 = "SELECT * FROM invoice WHERE invoice_id='$invoice_id'";
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
$cid=$row_DetailRS1['cid'];
$query_DetailRS2 = "SELECT * FROM customer WHERE cid='$cid'";
$query_limit_DetailRS2 = sprintf("%s LIMIT %d, %d", $query_DetailRS2, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS2 = mysqli_query($conn,$query_limit_DetailRS2) or die(mysqli_error($conn));
$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);

$totalPages_DetailRS3 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;

$query_DetailRS3 = "SELECT * FROM sale, products, category WHERE sale.itemNo= products.productCode and products.productLine= category.cat_id and invoice_id='$invoice_id'";
$DetailRS3 = mysqli_query($conn,$query_DetailRS3) or die(mysqli_error($conn));
$row_DetailRS3 = mysqli_fetch_assoc($DetailRS3);
$i=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Haji Motors</title>
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
	<link href="css/jquery-ui.min.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

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
	
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
		
</head>

<body>
		<?php include('header.php'); ?>
        <?php $today=date("d/m/Y"); ?>
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
					<a href="#">ক্যাশ মেমো</a>
				</li>
			</ul>  
            <!--/row-->

			<div class="row-fluid sortable"><!--/span-->
<div id="printSec">

            <div class="box span9">
            <span class="cssclsNoScreen">
  <img src="images/Memo_header.png">
</span>

					<div class="box-content"><!--/row -->
                      <table width="100%" border="0">
                        <tr>
                          <td width="33%" align="left"><h2>চালান নংঃ &nbsp;<?php echo convertbn($row_DetailRS1['invoice_id']); ?></h2></td>
                          <td width="34%" align="center"><h2>চালান</h2></td>
                          <td width="33%" align="right">তারিখঃ&nbsp;<?php
                                    $originaldate=$row_DetailRS1['invoice_date'];
									$newDate = date("d-m-Y", strtotime($originaldate));
									echo convertbn($newDate); 
									 ?></td>
                        </tr>
                      </table>
<div class="row-fluid">
                <div class="span6">
<table width="100%" border="1" cellpadding="3" cellspacing="2">
                                <tbody>
								  <tr>
								    <td width="30%"><span class="control-label">প্রতিষ্ঠানঃ</span></td>
								    <td width="70%"><?php echo $row_DetailRS2['c_name']; ?></td>
							      </tr>
								  <tr>
								    <td>ঠিকানাঃ</td>
								    <td><?php echo $row_DetailRS2['address']; ?></td>
							      </tr>
								  <tr>
								    <td>প্রোপাইটরঃ</td>
								    <td><?php echo $row_DetailRS2['propaitor']; ?></td>
							      </tr>
								  <tr>
								    <td>মোবাইলঃ</td>
								    <td><?php echo $row_DetailRS2['phone']; ?></td>
							      </tr>
								  </tbody>
								  </table>
							</div>
								<div class="span6">
								<table width="100%" border="1" cellpadding="2" cellspacing="2">
                                <tbody>
								  <tr>
								    <td width="30%">মেমো নংঃ</td>
								    <td width="70%">
									<?php echo convertbn($row_DetailRS1['invoice_id']); ?>
									</td>
							      </tr>
								  <tr>
								    <td>ডিলার কোড</td>
								    <td>&nbsp;</td>
							      </tr>
								  <tr>
								    <td>প্রস্তুতকালঃ</td>
								    <td><?= convertbn($newDate); ?></td>
							      </tr>
								  <tr>
								    <td>প্রস্তুতকারকঃ</td>
								    <td><?php echo $username;?></td>
							      </tr>
								  </tbody>
								  </table>
							
					        </div>
					  </div>
                      <p> </p>
						  <div class="row-fluid">
						    <div class="span12">
						
							  <div class="box span12">

<table width="100%" border="1" cellpadding="2" cellspacing="2">
							  <thead>
								  <tr>
                                  	  <th width="8%">নং</th>
									  <th width="40%">পন্যের নাম</th>
									  <th width="21%">পরিমান</th>
                                      <th width="16%">পরিমাপ</th>
								  </tr>
							  </thead>   
							  <tbody>

                              <?php do { ?>
							  <tr>
                                    <td class="center"><?php $i++; echo convertbn($i); ?>.</td>
									<td class="center"><?php echo $row_DetailRS3['productName']; ?></td>
									
									<td class="center"><?php echo convertbn($row_DetailRS3['quantity']); ?>&nbsp; <?php echo $row_DetailRS3['cat_unit']; ?></td>
									<td class="center"><?php $qty=$row_DetailRS3['quantity'];
									$unit=$row_DetailRS3['perunit'];
									$porimap=($qty/$unit);
									echo convertbn($porimap); 
									
									?> পিস</td>
                                  
								</tr>
                                <?php } while ($row_DetailRS3 = mysqli_fetch_assoc($DetailRS3)); ?>
                            
							  </tbody>
					  </table>
                    
				</div><!--/span-->
                
                
						  </div>	 
			  </div>
              <div class="row-fluid">
								<div class="span6">
								  
                                  <h3>&nbsp;</h3>
							</div>
								<div class="span6">
								
								<p>&nbsp;</p>
		        </div>
					  </div>
<span class="cssclsNoScreen">
                      <div id="print_footer">
                <table width="95%" border="0">
                        <tr>
                          <td width="33%" align="left"> ক্রেতার সাক্ষরঃ</br>
                         </td>
                          <td width="34%" align="center"></td>
                          <td width="33%" align="right">বিক্রেতার সাক্ষর</td>
                        </tr>
                      </table>
                      </div>
                       </span>
                </div> 
		  </div>
              </div>
              <div class="box span9">
<input type="button" class="btn-info" onclick="printContent('printSec')" value="চালান প্রিন্ট করুন" />

</div>
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
	
	<!-- start: JavaScript-->

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
</body>
</html>

