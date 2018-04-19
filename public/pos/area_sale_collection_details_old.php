<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$start_date=date("Y-m-d",strtotime($_POST['start_date']));
$end_date=date("Y-m-d",strtotime($_POST['end_date']));
$area_code=$_POST['area_code'];
$query_DetailRS1 = "SELECT invoice_date, invoice_id , c_name, address, total_bill, area_code  FROM invoice, customer where invoice.cid= customer.cid AND customer.area_code='$area_code' AND invoice_date between '$start_date' AND '$end_date' order by invoice_date asc";
$DetailRS1 = mysqli_query($conn,$query_DetailRS1) or die(mysqli_error($conn));
//$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

$query_DetailRS3 = "SELECT pay_date, pay_id, c_name, address, area_code, amount  FROM payment, customer where payment.cid= customer.cid  AND customer.area_code='$area_code' AND pay_date between '$start_date' AND '$end_date' order by pay_date asc";
$DetailRS3 = mysqli_query($conn,$query_DetailRS3) or die(mysqli_error($conn));
//$row_DetailRS3 = mysqli_fetch_assoc($DetailRS3);
}
mysqli_select_db($conn, $database_conn);
$query_Recordset1 = "SELECT area_code FROM area order by area_code";
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
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
        <?php
        $UTCObj = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
        //$dateTimeNow = $UTCObj->format("Y-m-d H:i:s");
        
        $today = $UTCObj->format("m/d/Y"); 
        
        
        ?>
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<?php  include('menu.php'); ?>
			</div>
			<!-- end: Main Menu -->
			

			
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
					<a href="#">বিক্রয় রিপোর্ট:</a>
				</li>
			</ul>  
            <!--/row-->

			<div class="row-fluid sortable"><!--/span-->
			
			  <div class="row-fluid sortable">
			    <div class="box span12">
			      <div class="box-header" data-original-title>
			        <h2> বিক্রয় রিপোর্ট:</h2>
			        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
		          </div>
                  
			      <div class="box-content">
                  <form class="form-horizontal" method="post" name="form1" action="<?php echo $editFormAction; ?>" id="invoice-form" role="form" novalidate>
                 
			          <fieldset>
                       <div class="row-fluid">
                         <div class="span6">
                        			            <div class="control-group">
			              <label class="control-label" for="date01">তারিখ হইতেঃ</label>
			              <div class="controls">
			                <input name="start_date" type="text" class="input-xlarge datepicker" id="date01" value="<?php echo $today ?>">
                            
			              </div>
		                </div>
                                                			            <div class="control-group">
			              <label class="control-label" for="date01">তারিখ পর্যন্তঃ</label>
			              <div class="controls">
			                <input name="end_date" type="text" class="input-xlarge datepicker" id="date02" value="<?php echo $today ?>">
                            
			              </div>
		                </div>
                                                   <div class="control-group">
								<label class="control-label" for="selectError3">এরিয়া কোড:</label>
								<div class="controls">
						<select name="area_code" id="selectError3">
			                  <?php
								do {  
								?>
			                  <option value="<?php echo $row_Recordset1['area_code']?>"><?php echo $row_Recordset1['area_code']?> </option>
			                  <?php
								} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  								$rows = mysqli_num_rows($Recordset1);
  								if($rows > 0) {
      							mysqli_data_seek($Recordset1, 0);
	  							$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  								}
								?>
								  </select>
								</div>
						   </div>
                                               
                         </div>
						 
                    <div class="span6">
                 <?php 
				if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
				?>                   
                    

                    
               <?php }?>     
                    
                    </div>
                        </div>
                              
                              <div class="box-content"><!--/row -->
						  <div class="row-fluid sortable">
                          
                      
			            <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="রিপোর্ট দেখুন" />
                         <input type="hidden" name="MM_insert" value="form1">
			              <button type="reset" class="btn">বাতিল</button>
		                </div>
		              </fieldset>
		            </form>
		          </div>
		        </div>
			    <!--/span-->
		      </div>
			</div><!--/row-->
            			  <div class="row-fluid sortable">
			    <div class="box span12">
                <?php 
				if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
				?>
				
	<div id="printSec">
	<span class="cssclsNoScreen">
  <img src="images/Memo_header.png">
</span>
<?php 
$area_query = mysqli_query($conn,"SELECT area.area_code,area_name, sm_name from area, area_manager Where area.area_code=area_manager.area_code and area.area_code='$area_code' ") or die(mysqli_error($conn));
								$row_DetailRS9 = mysqli_fetch_assoc($area_query);
								?>
                               
    <div class="box-header" data-original-title>এরিয়া কোড: <?php echo $area_code; ?> এরিয়া: <?php echo $row_DetailRS9['area_name']; ?> এরিয়া ম্যানেজারঃ <?php echo $row_DetailRS9['sm_name']; ?>
      <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a></div>
    </div>
<div class="box-content">
  <div class="box-header">
			        বিক্রয় রিপোর্ট:<?php 
	$time1 = strtotime($start_date);
$myFormatForView1 = date("d/m/y", $time1);echo convertbn($myFormatForView1);?> হইতে <?php 	$time2 = strtotime($end_date);
$myFormatForView2 = date("d/m/y", $time2);echo convertbn($myFormatForView2);?> <?php 
								$bill_query = mysqli_query($conn,"SELECT sum(total_bill) as bill, count(invoice_id) as nos FROM invoice, customer where invoice.cid= customer.cid AND customer.area_code= '$area_code' AND invoice_date between '$start_date' AND '$end_date'") or die(mysqli_error($conn));
								$row_DetailRS5 = mysqli_fetch_assoc($bill_query);
								$bill=$row_DetailRS5['bill'];
								$totalrow=mysqli_num_rows($bill_query);
								?>
                                মেমোঃ <?php echo convertbn($row_DetailRS5['nos']); ?> টি  &nbsp;বিক্রয়ঃ 
                                <?php
								if($totalrow>0){
								$formatbill = number_format($bill, 2);
								echo convertbn($formatbill);
								}
								else {
									$bill=='0.00';
								echo convertbn($bill);
								}
								 ?> টাকা  
			        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
		          </div>
                  
	        <table class="table table-striped table-bordered bootstrap">
			  <thead>
							  <tr>
								  
								  <th>তারিখ </th>
								  <th>মেমো নংঃ </th>
                                   <th>ক্রেতার নামঃ </th>
								  <th>মোট বিল</th>
								  <th>এরিয়া কোড:</th>

                              </tr>
			  </thead>   
						  <tbody>
                             <?php while ($row_DetailRS1 = mysqli_fetch_assoc($DetailRS1)) { ?>
							<tr>
								
                                <td><?php 
								$originalDate = $row_DetailRS1['invoice_date'];
								$newDate = date("d-m-Y", strtotime($originalDate));
								echo convertbn ($newDate); ?></td>
                                <td class="center">
									<?php  echo convertbn($row_DetailRS1['invoice_id']); ?> </td>
                                     <td class="center">
									<?php  echo convertbn($row_DetailRS1['c_name'])." (". $row_DetailRS1['address'].")"; ?> </td>
								<td class="center"><?php echo convertbn($row_DetailRS1['total_bill']); ?>
                                </td>
                                <td><?php echo $row_DetailRS1['area_code']; ?></td>
							
                            </tr>
                              <?php }  ?>
							  
						  </tbody>
		    </table>           
				  </div>
                    <div class="box-content">
                    			      <div class="box-header" data-original-title>
			        নগদ জমা রিপোর্টঃ
                   <?php echo convertbn($myFormatForView1);?> হইতে <?php echo convertbn($myFormatForView2);?>  
<?php 
								$paid_query = mysqli_query($conn,"SELECT sum(amount) as paid, count(pay_id) as nos FROM payment, customer where payment.cid= customer.cid  AND customer.area_code= '$area_code' AND pay_date between '$start_date' AND '$end_date'") or die(mysqli_error($conn));
								$row_DetailRS4 = mysqli_fetch_assoc($paid_query);
								$paid= $row_DetailRS4['paid'];
								$totalrow2=mysqli_num_rows($paid_query);
								?>
                                 মানি রিসিটঃ  <?php echo convertbn($row_DetailRS4['nos']); ?> টি &nbsp;জমাঃ
                                <?php 
								if($totalrow2>0){
									$formatpaid = number_format($paid, 2);
								echo convertbn($formatpaid);
								}
								else {
								$paid==0.00;
								echo convertbn($paid);
								}
								
								?> টাকা
			        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
		          </div>
    			<table class="table table-striped table-bordered bootstrap">
						  <thead>
							  <tr>
								  <th>তারিখ</th>
								  <th> রিসিট নংঃ </th>
                                  <th> ক্রেতার নামঃ </th>
								  <th>পরিমান</th>
								  <th>এরিয়া কোড:</th>
                              </tr>
						  </thead>   
						  <tbody>
                             <?php while ($row_DetailRS3 = mysqli_fetch_assoc($DetailRS3)) { ?>
							<tr>
								<td><?php 
								$originalDate2 = $row_DetailRS3['pay_date'];
								$newDate = date("d-m-Y", strtotime($originalDate2));
								echo convertbn ($newDate); ?></td>
                                <td><?php echo convertbn($row_DetailRS3['pay_id']); ?></td>
                                <td class="center">
									<?php  echo convertbn($row_DetailRS3['c_name'])." (".$row_DetailRS3['address'].")"; ?> </td>
                                          <td class="center">
									<?php  echo convertbn($row_DetailRS3['amount']); ?> </td>
									<td><?php echo $row_DetailRS3['area_code']; ?></td>
                            </tr>
                              <?php }  ?>
						  </tbody>
					  </table>           
				  </div>
                    <div class="box-header" data-original-title>সামারি রিপোর্টঃ মোট বিক্রি(<?php echo convertbn($bill);?>)-মোট কালেকশন(<?php echo convertbn($paid);?>)=<?php echo convertbn($bill-$paid);  ?> টাকা
                      <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a></div>
                    </div>
                    <div class="box-content"></div>

                  <?php } ?>
</div>
</div>
    </div>
<div class="box span9">
<input type="button" class="btn-info" onclick="printContent('printSec')" value=" প্রিন্ট করুন" />
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

