<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
mysqli_select_db($conn, $database_conn);
$pay_id=$_REQUEST['pay_id'];
$query_Recordset1 = "SELECT * FROM payment,customer where pay_id='$pay_id' and payment.cid=customer.cid";
$Recordset1 = mysqli_query($conn,$query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
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
	
		<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>মানি রিসিট</title>');
        //mywindow.document.write('<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />');
		//mywindow.document.write('<link rel="stylesheet" href="css/bootstrap-responsive.min.css" type="text/css" />');
		mywindow.document.write('<link rel="stylesheet" href="css/style.css" type="text/css" />');
		//mywindow.document.write('<link rel="stylesheet" href="css/style-responsive.css" type="text/css" />');
		//mywindow.document.write('<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>		
		
		
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
					<a href="#">নগদ জমা রশিদ</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
            <div id="printSec">
				<div class="box span8">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>নগদ জমা রশিদ</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>

							
                         
					<div class="box-content">
                                        
								
								  <h1>মেসার্স হাজী পাইপ</h1>
                                  <p></p>
                                  <h3>&nbsp;</h3>
						<form class="form-horizontal"  name="form1" action="<?php echo $editFormAction; ?>" accept-charset="utf-8" method="post">
						  <fieldset>
						    <div class="control-group">
						      <label class="control-label" for="productName2"> জমা রশিদ নাম্বারঃ</label>
						      <div class="controls">
						        <?php echo $row_Recordset1['pay_id']?>
						        
					          </div>
					        </div>
						    <div class="control-group">
							  <label class="control-label" for="productName"> ক্রেতার নামঃ</label>
							  <div class="controls">
                                <?php echo $row_Recordset1['c_name']?>
						      </div>
						    </div>
						    <div class="control-group">
							  <label class="control-label" for="productDescription">জমার তারিখঃ</label>
							  <div class="controls">
							    <?php echo $row_Recordset1['pay_date']?>
						      </div>
						    </div>
							<div class="control-group">
							  <label class="control-label" for="quantityInStock">নগদ জমাঃ</label>
								<div class="controls">
								  <?php echo $row_Recordset1['amount']?>  টাকা
								</div>
							  </div>
							<div class="form-actions">

							</div>
						  </fieldset>
                           
						</form>   
<p>প্রস্তুতকারকঃ</br> <input type="hidden" name="created_by" value="<?php echo $username;?>"><?php echo $username;?> </p>
					</div>
				</div><!--/span-->
</div>
              <div class="box span9">
<input type="button" class="btn-info" onclick="PrintElem('#printSec')" value="Print" />
</div>
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
