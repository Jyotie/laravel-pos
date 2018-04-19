<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$start_date=date("Y-m-d",strtotime($_POST['start_date']));
$end_date=date("Y-m-d",strtotime($_POST['end_date']));
$cid=$_POST['cid'];
$query_DetailRS1 = "SELECT * FROM invoice where cid='$cid' AND invoice_date between '$start_date' AND '$end_date' order by invoice_id";
$DetailRS1 = mysqli_query($conn,$query_DetailRS1) or die(mysqli_error($conn));
//$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

$query_DetailRS3 = "SELECT * FROM payment where cid='$cid' AND pay_date between '$start_date' AND '$end_date' order by pay_id";
$DetailRS3 = mysqli_query($conn,$query_DetailRS3) or die(mysqli_error($conn));
//$row_DetailRS3 = mysqli_fetch_assoc($DetailRS3);
}
mysqli_select_db($conn, $database_conn);
$query_Recordset1 = "SELECT * FROM customer ORDER BY c_name";
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysqli_error($conn));
//$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
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
					<a href="#">কাস্টমার রিপোর্ট</a>
				</li>
			</ul>  
            <!--/row-->

			<div class="row-fluid sortable"><!--/span-->
			
			  <div class="row-fluid sortable">
			    <div class="box span12">
			      <div class="box-header" data-original-title>
			        <h2>কাস্টমার রিপোর্ট</h2>
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
								<label class="control-label" for="selectError3">ক্রেতার নামঃ</label>
								<div class="controls">
						                <select name="cid" id="selectError3">
                                        <option>দেখুন</option>
			                  <?php
							  while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)) {
								?>
			                  <option value="<?php echo $row_Recordset1['cid']?>"><?php echo $row_Recordset1['c_name']." (".$row_Recordset1['address'].")"?></option>
			                  <?php
								}
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
                  
	<div class="box-content">
              <p><span class="cssclsNoScreen">
                <img src="images/Memo_header.png">
                </span>
  <?php 
				if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
				?>   				               
              </p>
              <div class="box-header" data-original-title>
                <h2> ক্রেতার রিপোর্ট</h2>
                <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a></div>
              </div>
              
              <table width="100%" border="1" cellpadding="5">
                <tr>
    <td width="28%">ক্রেতার নামঃ</td>
    <td width="22%"><?php 
								$query_DetailRS2 = "SELECT c_name, propaitor, address FROM customer WHERE cid='$cid'";
								$DetailRS2 = mysqli_query($conn,$query_DetailRS2) or die(mysqli_error($conn));
								$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);
								echo $row_DetailRS2['c_name']." (". $row_DetailRS2['address'].")"; ?></td>
    <td width="15%">মোট বিক্রয়ঃ</td>
    <td width="35%" align="right"><?php 
								$bill_query = mysqli_query($conn,"SELECT sum(total_bill) as bill FROM invoice WHERE cid='$cid' AND invoice_date between '$start_date' AND '$end_date'") or die(mysqli_error($conn));
								$row_DetailRS5 = mysqli_fetch_assoc($bill_query);
								$bill=$row_DetailRS5['bill'];
								$totalrow=mysqli_num_rows($bill_query);
								if($totalrow>0){
								$formatbill = number_format($bill, 2);
								echo convertbn($formatbill);
								}
								else {
									$bill=='0.00';
								echo convertbn($bill);
								}
								 ?>
টাকা</td>
                </tr>
  <tr>
    <td>প্রোপাইটর:</td>
    <td>
		<?php
			echo $row_DetailRS2['propaitor'];
		?>
	</td>
    <td>মোট জমাঃ</td>
    <td align="right"><?php 
								$paid_query = mysqli_query($conn,"SELECT sum(amount) as paid FROM payment WHERE cid='$cid' AND pay_date between '$start_date' AND '$end_date'") or die(mysqli_error($conn));
								$row_DetailRS4 = mysqli_fetch_assoc($paid_query);
								$paid= $row_DetailRS4['paid'];
								$totalrow2=mysqli_num_rows($paid_query);
								if($totalrow2>0){
									$formatpaid = number_format($paid, 2);
								echo convertbn($formatpaid);
								}
								else {
								$paid==0.00;
								echo convertbn($paid);
								}
								
								?>
টাকা</td>
    </tr>
  <tr>
    <td>সময় কালঃ</td>
    <td><?php
		$time1 = strtotime($start_date);
		$myFormatForView1 = date("d/m/y", $time1);echo convertbn($myFormatForView1);
		?>
		&nbsp; হইতে - &nbsp;&nbsp;
		<?php
		$time2 = strtotime($end_date);
$myFormatForView2 = date("d/m/y", $time2);echo convertbn($myFormatForView2);?> পর্যন্ত</td>
    <td >বকেয়াঃ</td>
    <td align="right"><?php $due=$bill-$paid;
								$formattedNum = number_format($due, 2);
								echo convertbn($formattedNum); ?>
      টাকা</td>
  </tr>
  </table>
               <?php }?> 
	        <div class="box-header" data-original-title>
			        <h2> বিক্রয় রিপোর্ট</h2>
			        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
	          </div>
	        <table class="table table-striped table-bordered bootstrap">
			  <thead>
							  <tr>
								  <th>মেমো নং</th>
								  <th>তারিখ </th>
								  <th>সর্ব মোট</th>
								  <th>নগদ</th>
								  <th>বাকী</th>
                                  <th>বিক্রেতা</th>
							  </tr>
			  </thead>   
						  <tbody>
                             <?php  while ($row_DetailRS1 = mysqli_fetch_assoc($DetailRS1)) { ?>
							<tr>
								<td><?php echo  convertbn($row_DetailRS1['invoice_id']); ?></td>
                                <td><?php 
								$originalDate = $row_DetailRS1['invoice_date'];
								$newDate = date("d-m-Y", strtotime($originalDate));
								echo convertbn ($newDate); ?></td>
                                <td class="center">
									<?php  echo convertbn($row_DetailRS1['total_bill']); ?> </td>
								<td class="center"><?php echo convertbn($row_DetailRS1['cash']); ?>
                                </td>
								<td class="center"><?php echo convertbn( $row_DetailRS1['due']); ?></td>
                                <td class="center"><?php echo $row_DetailRS1['created_by']; ?></td>
							</tr>
                              <?php } ?>
						  </tbody>
		    </table>           
		    </div>
            <div class="box-content">
		      <div class="box-header" data-original-title>
			        <h2> নগদ জমা রিপোর্ট</h2>
			        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
	          </div>
   			  <table class="table table-striped table-bordered bootstrap">
					    <thead>
						    <tr>
							    <th>মেমো/রিসিট নং</th>
							    <th>তারিখ </th>
							    <th>নগদ</th>
                                <th>গ্রহিতা</th>
						    </tr>
					    </thead>   
					    <tbody>
                           <?php while ($row_DetailRS3 = mysqli_fetch_assoc($DetailRS3)) { ?>
						  <tr>
							  <td><?php echo  convertbn($row_DetailRS3['pay_id']); ?></td>
                              <td><?php 
								$originalDate2 = $row_DetailRS3['pay_date'];
								$newDate = date("d-m-Y", strtotime($originalDate2));
								echo convertbn ($newDate); ?></td>
                              <td class="center">
								  <?php  echo convertbn($row_DetailRS3['amount']); ?> </td>
                              <td class="center"><?php echo $row_DetailRS3['created_by']; ?></td>
						  </tr>
                            <?php }  ?>
					    </tbody>
		      </table>           
			  </div>
                  <?php } ?>
</div>
</div>
              <div class="box span9">
<input type="button" class="btn-info" onclick="printContent('printSec')" value=" প্রিন্ট করুন" />
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

