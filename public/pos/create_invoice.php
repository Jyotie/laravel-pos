<?php require_once('Connections/conn.php'); ?>
<?php require_once('access_check.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    if (isset($_POST['itemNo'])) {
    $invoice_date = date("Y-m-d", strtotime($_POST['invoice_date']));
    $cid = $_POST['cid'];
    $subtotal = $_POST['subtotal'];
    $tax = $_POST['tax'];
    $taxAmount = $_POST['taxAmount'];
    $total_bill = $_POST['total_bill'];
    $predue = $_POST['predue'];
    $ttlbill = $_POST['ttlbill'];
    $cash = $_POST['cash'];
    $due = $_POST['due'];
    $created_by = $_POST['created_by'];
    $insertSQL = "INSERT INTO invoice(invoice_date, cid, subtotal, tax, taxAmount, total_bill, predue, ttlbill, cash, due, created_by )
               VALUES('$invoice_date','$cid','$subtotal','$tax','$taxAmount','$total_bill', '$predue', '$ttlbill', '$cash', '$due','$created_by')";
    mysqli_select_db($conn, $database_conn);
    mysqli_query($conn, $insertSQL) or die(mysqli_error($conn));
    $invoice_id = mysqli_insert_id($conn);

        $itemNo = $_POST['itemNo'];
        foreach ($itemNo as $aa => $items) {
            $itemNo = $_POST['itemNo'][$aa];
            $price = $_POST['price'][$aa];
            $quantity = $_POST['quantity'][$aa];
            $total = $_POST['total'][$aa];
            $query2 = "INSERT INTO sale(invoice_id, itemNo, price, quantity, total)
           VALUES('$invoice_id','$itemNo', '$price', '$quantity', '$total')";
            mysqli_query($conn, $query2) or die(mysqli_error($conn));
            $query3 = "UPDATE products SET quantityInStock= quantityInStock-'$quantity' WHERE productCode='$itemNo'";
            mysqli_query($conn, $query3) or die(mysqli_error($conn));
        }
    }
    if ($cash != 0) {
        $query4 = "INSERT INTO payment (pay_date, cid, amount,created_by) VALUES ('$invoice_date', '$cid', '$cash','$created_by')";
        mysqli_query($conn, $query4) or die(mysqli_error($conn));
    }
    $insertGoTo = "invoice_print.php?invoice_id=$invoice_id";

    header(sprintf("Location: %s", $insertGoTo));
}
mysqli_select_db($conn, $database_conn);
$query_Recordset1 = "SELECT * FROM customer order by c_name";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <style>
        @font-face {
            font-family: 'Siyam Rupali';
            src: url('https://bits.wikimedia.org/static-current/extensions/UniversalLanguageSelector/data/fontrepo/fonts/SiyamRupali/SiyamRupali.eot?version=1.070');
            src: local('Siyam Rupali'), url('https://bits.wikimedia.org/static-current/extensions/UniversalLanguageSelector/data/fontrepo/fonts/SiyamRupali/SiyamRupali.woff?version=1.070') format('woff'), url('https://bits.wikimedia.org/static-current/extensions/UniversalLanguageSelector/data/fontrepo/fonts/SiyamRupali/SiyamRupali.ttf?version=1.070') format('truetype');
            font-style: normal;
        }
    </style>
    <title>Haji Pipes</title>
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
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                document.getElementById("txtHints").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                        document.getElementById("txtHints").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "getuser.php?cid=" + str, true);
                xmlhttp.send();
            }
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
            <?php include('menu.php'); ?>
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
                    <a href="#">নতুন বিক্রয়ঃ</a>
                </li>
            </ul>
            <!--/row-->

            <div class="row-fluid sortable"><!--/span-->

                <div class="row-fluid sortable">
                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon edit"></i><span class="break"></span>নতুন বিক্রয়</h2>
                            <div class="box-icon"><a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a
                                    href="#" class="btn-close"><i class="halflings-icon remove"></i></a></div>
                        </div>

                        <div class="box-content">
                            <form class="form-horizontal" method="post" name="form1"
                                  action="<?php echo $editFormAction; ?>" id="invoice-form" role="form" novalidate>

                                <fieldset>
                                    <div class="row-fluid">
                                        <div class="span6">

                                            <h1> ক্যাশমেমো তৈরি করুন</h1>
                                            <div class="control-group">
                                                <label class="control-label" for="date01">তারিখঃ</label>
                                                <div class="controls">
                                                    <input name="invoice_date" type="text"
                                                           class="input-xlarge datepicker" id="date01"
                                                           value="<?php echo $today ?>">

                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">ক্রেতার নামঃ</label>
                                                <div class="controls">
                                                    <select name="cid" id="selectError3"
                                                            onchange="showUser(this.value)">
                                                        <option value="">ক্রেতার নাম দেখুন:</option>
                                                        <?php
                                                        do {
                                                            ?>
                                                            <option
                                                                value="<?php echo $row_Recordset1['cid'] ?>"><?php echo $row_Recordset1['c_name'] ?>
                                                                &nbsp;(<?php echo $row_Recordset1['address'] ?>)
                                                            </option>
                                                            <?php
                                                        } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
                                                        $rows = mysqli_num_rows($Recordset1);
                                                        if ($rows > 0) {
                                                            mysqli_data_seek($Recordset1, 0);
                                                            $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">সাবেক বকেয়া:</label>
                                                <div class="controls" id="txtHints">বকেয়া দেখানো হবে...
                                                </div>
                                            </div>

                                        </div>
                                        <div class="span6">

                                        </div>
                                    </div>

                                    <div class="box-content"><!--/row -->
                                        <div class="row-fluid sortable">
                                            <div class="span9">
                                                <table width="80%" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th width="5%"><input id="check_all" class="formcontrol"
                                                                              type="checkbox"/></th>
                                                        <th width="20%">পন্য নাম্বার</th>
                                                        <th width="20%">পন্যের নাম</th>
                                                        <th width="20%">পরিমান</th>
                                                        <th width="20%">মজুদ</th>
                                                        <th width="20%">দর</th>
                                                        <th width="20%">মোট</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td><input name="itemNo[]" type="number"
                                                                   class="form-control autocomplete_txt" id="itemNo_1"
                                                                   autocomplete="off" data-type="productCode"></td>

                                                        <td><input type="text" data-type="productName" name="itemName[]"
                                                                   id="itemName_1" class="form-control autocomplete_txt"
                                                                   autocomplete="off"></td>
                                                        <td><input type="number" name="quantity[]" id="quantity_1"
                                                                   class="form-control changesNo" autocomplete="off"
                                                                   onkeypress="return IsNumeric(event);"
                                                                   ondrop="return false;" onpaste="return false;">
                                                        </td>

                                                        <td><input type="number" name="quantityInStock[]"
                                                                   id="quantityInStock_1" class="form-control changesNo"
                                                                   autocomplete="off" disabled></td>
                                                        <td><input type="number" name="price[]" id="price_1"
                                                                   class="form-control changesNo" autocomplete="off"
                                                                   onkeypress="return IsNumeric(event);"
                                                                   ondrop="return false;" onpaste="return false;"></td>

                                                        <td><input type="number" name="total[]" id="total_1"
                                                                   class="form-control totalLinePrice"
                                                                   autocomplete="off"
                                                                   onkeypress="return IsNumeric(event);"
                                                                   ondrop="return false;" onpaste="return false;"
                                                                   readonly></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button class="btn btn-danger delete" type="button">- বাতিল</button>
                                                <button class="btn btn-success addmore" type="button">+ যোগ করুন
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="box offset7">
                                        <div class="box-content">

                                            <div class="control-group">
                                                <label class="control-label" for="subTotal">মোটঃ</label>
                                                <div class="controls">
                                                    <input type="number" name="subtotal" class="form-control"
                                                           id="subTotal" placeholder="Subtotal"
                                                           onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                           onpaste="return false;" readonly>টাকা
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="tax">কমিশনঃ</label>
                                                <div class="controls">
                                                    <input type="number" name="tax" class="form-control" id="tax"
                                                           placeholder="কমিশন%" onkeypress="return IsNumeric(event);"
                                                           ondrop="return false;" onpaste="return false;"> %
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="taxAmount">কমিশনের পরিমানঃ</label>
                                                <div class="controls">
                                                    <input type="number" name="taxAmount" class="form-control"
                                                           id="taxAmount" placeholder="Tax" ondrop="return false;"
                                                           onpaste="return false;" readonly>টাকা
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="totalAftertax">সর্বমোট বিলঃ</label>
                                                <div class="controls">
                                                    <input name="total_bill" type="number" class="form-control"
                                                           id="totalAftertax" placeholder="Total"
                                                           onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                           onpaste="return false;" readonly>টাকা
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="amountPaid">সাবেক বকেয়াঃ</label>
                                                <div class="controls" id="txtHint">বকেয়া দেখানো হবে...
                                                    <!-- <input name="predue" type="number" class="form-control" id="amountPaid" value="0" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly>টাকা-->
                                                </div>
                                            </div>
                                            <label class="control-label" for="ttlbill">বকেয়া সহ সর্বমোট বিলঃ</label>
                                            <div class="controls">
                                                <input name="ttlbill" type="number" class="form-control ttlbill"
                                                       id="ttlbill" placeholder="বকেয়া সহ বিল"
                                                       onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                       onpaste="return false;" readonly>টাকা
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="cashPaid">নগদ পরিশোধঃ</label>
                                            <div class="controls">
                                                <input name="cash" type="number" class="form-control" id="cashPaid"
                                                       value="0" placeholder="Amount Paid"
                                                       onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                       onpaste="return false;">টাকা
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="amountDue"> সর্বমোট বকেয়া:</label>
                                            <div class="controls">
                                                <input name="due" type="number" class="form-control amountDue"
                                                       id="amountDue" placeholder="Amount Due"
                                                       onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                       onpaste="return false;" readonly>টাকা
                                            </div>
                                        </div>
                                    </div>

                                    <p>প্রস্তুতকারকঃ</br> <input type="hidden" name="created_by"
                                                                 value="<?php echo $username; ?>"><?php echo $username; ?>
                                    </p>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary" value="বিক্রয় করুন"/>
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

