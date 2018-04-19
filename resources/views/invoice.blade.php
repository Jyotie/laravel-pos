<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">

    <title>Haji Pipes</title>
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="{{ asset('pos/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('pos/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link id="base-style" href="{{ asset('pos/css/style.css') }}" rel="stylesheet">
    <link id="base-style-responsive" href="{{ asset('pos/css/style-responsive.css') }}" rel="stylesheet">
    <!-- end: CSS -->
    <link href="{{ asset('pos/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('pos/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('pos/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js') }}"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->

    <!-- end: Favicon -->

</head>

<body>

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
           
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
                                  action="" id="invoice-form" role="form" novalidate>

                                <fieldset>
                                    <div class="row-fluid">
                                        <div class="span6">

                                            <h1> ক্যাশমেমো তৈরি করুন</h1>
                                            <div class="control-group">
                                                <label class="control-label" for="date01">তারিখঃ</label>
                                                <div class="controls">
                                                    <input name="invoice_date" type="text"
                                                           class="input-xlarge datepicker" id="date01"
                                                           value="">

                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">ক্রেতার নামঃ</label>
                                                <div class="controls">
                                                    <select name="cid" id="selectError3"
                                                            onchange="showUser(this.value)">
                                                        <option value="">ক্রেতার নাম দেখুন:</option>
                                                        
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
                                                                 value="">
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


<!-- start: JavaScript-->

<!-- start: JavaScript-->

<script src="{{ asset('pos/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('pos/js/jquery-migrate-1.0.0.min.js') }}"></script>

<script src="{{ asset('pos/js/jquery-ui-1.10.0.custom.min.js') }}"></script>

<script src="{{ asset('pos/js/bootstrap.min.js') }}"></script>


<script src="{{ asset('pos/js/custom.js') }}"></script>
<!-- end: JavaScript-->

<script src="{{ asset('pos/js/auto.js') }}"></script>
</body>
</html>

