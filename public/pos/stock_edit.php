<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
header('Content-Type: text/html; charset=utf-8');
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$pid=$_POST['productCode'];
$UTCObj = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
$stockDate=$UTCObj->format("Y-m-d");

$stockamount=$_POST['stockamount'];
$supplier=$_POST['supplier'];
$created_by=$_POST['created_by'];
$insertSQL = sprintf("INSERT INTO stock( pid, stockDate, stockamount, supplier, createdby) VALUES ('$pid', '$stockDate', '$stockamount', '$supplier', '$created_by')");
$query2 = "UPDATE products SET quantityInStock= quantityInStock+'$stockamount' WHERE productCode='$pid'";
mysqli_select_db($conn,$database_conn);
$Result1 = mysqli_query($conn,$insertSQL) or die(mysqli_error($conn));
$Result2 =mysqli_query($conn,$query2) or die(mysqli_error($conn));
$insertGoTo = "manage_product.php";
header(sprintf("Location: %s", $insertGoTo));  
}
$colname_Recordset1 = "-1";
if (isset($_GET['productCode'])) {
  $colname_Recordset1 = $_GET['productCode'];
}
$query_Recordset1 = sprintf("SELECT * FROM products, category WHERE products.productLine= category.cat_id and  productCode = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysql_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
$query_Recordset2 = "SELECT * FROM category";
$Recordset2 = mysqli_query($conn,$query_Recordset2) or die(mysqli_error($conn));
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
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
					<a href="#">পণ্যের স্টক হালনাগাদ</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>পণ্যের স্টক হালনাগাদ</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  name="form1" action="<?php echo $editFormAction; ?>" accept-charset="utf-8" method="post">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="productName">প্রোডাক্ট এর নামঃ (ইংরেজি)</label>
							  <div class="controls">
								<input name="productName" type="text" class="span6 typeahead" id="productName"  value="<?php echo($row_Recordset1['productName']); ?>" disabled>
							  </div>
							</div>
							<script type="text/javascript">
function Checktype(val){
 var element1=document.getElementById('Motor');
 var element2=document.getElementById('Pipe');
 var element3=document.getElementById('default');
 if(val==1){
   element1.style.display='inline';
   element2.style.display='none';
   element3.style.display='none';
 }
 if(val==2){
   element1.style.display='none';
   element2.style.display='inline';
   element3.style.display='none';
}
}
        </script>
							<div class="control-group">
							  <label class="control-label" for="productDescription">প্রোডাক্ট এর নামঃ (বাংলা)</label>
							  <div class="controls">
                                <textarea name="productDescription" disabled class="span6 typeahead" id="productDescription"><?php echo($row_Recordset1['productDescription']); ?></textarea>
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="quantityInStock">পূর্ব মজুদ</label>
							  <div class="controls">
                                <input type="text" name="quantityInStock" class="span6 typeahead" id="quantityInStock" value="<?php echo($row_Recordset1['quantityInStock']); ?>" disabled> <span id ="default" style="display:inline" class="label label-success"> <?php echo $row_Recordset1['cat_unit']; ?></span> <span id="Motor" class="label label-success" style="display:none">Piece</span>
        <span id="Pipe" class="label label-success" style="display:none"> feet</span>
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="stockamount">নতুন জমাঃ</label>
							  <div class="controls">
							    <input name="stockamount" type="text" class="span6 typeahead" id="stockamount"  value="">
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="supplier">সাপ্লায়ার এর নামঃ</label>
							  <div class="controls">
							    <input name="supplier" type="text" class="span6 typeahead" id="supplier"  value=" ">
						      </div>
						    </div>
							<p>&nbsp;</p>
							<div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
							 <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
                               <input type="hidden" name="MM_insert" value="form1">
      <input type="hidden" name="productCode" value="<?php echo $row_Recordset1['productCode']; ?>" />
      <input type="hidden" name="created_by" value="<?php echo $username;?>">
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
	
		<script src="js/jquery.iproductLine.toggle.js"></script>
	
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
