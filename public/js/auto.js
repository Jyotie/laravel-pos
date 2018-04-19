    $(document).ready(function(){
        $(".add-row").click(function(){
            var productCode = $("#productName").attr('productCode');
            var productName = $("#productName").val();
            var quantity = $("#quantity").val();
			var price = $("#productName").attr('price');
			var total = ($("#quantity").val()*price);
            var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='text' name='productCode[]' value='"+ productCode +"'></td><td><input type='text' name='name[]' value='"+ productName +"'></td><td><input type='text' name='quntity[]' value='" + quantity + "'></td><td><input type='text' name='price[]' value='" +price+"'></td><td><input type='text' class='form-control totalLinePrice' name='total[]' value='" + total + "'></td></tr>";
            $("table tbody").append(markup);
            calculateTotal();
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
            calculateTotal();
        });
    });    

$('.cid').select2({
        placeholder: 'Select Customer Name',
        ajax: {
          url: postBaseUrl+'/invoices-ajax',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (customer) {
                    return {
                        text: customer.c_name,
                        id: customer.cid
                    }
                })
            };
          },
          cache: true
        }
      });
	  
      var res ={};
      var prd = '';
	    $('.productName').select2({
        placeholder: 'Select Product Name',
        ajax: {
          url: postBaseUrl+'/invoices-ajax2',
          dataType: 'json',
          delay: 50,
          processResults: function (data) {
              
            return {
              results:  $.map(data, function (product) {
                
                    res = {
                        text: product.productName,
                        id: product.productName
                    }
                    prd = product;
                    return res;
                })
            };
          },
          cache: true
        }
      }).on('select2:select',function(e){
          $('.productName').attr('price',prd.Price);
          $('.productName').attr('productCode',prd.productCode);
      });


$(document).on('change keyup blur','#tax',function(){
	calculateTotal();
});	  
//total price calculation 
function calculateTotal(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#subTotal').val( subTotal.toFixed(2) );
	tax = $('#tax').val();
	if(tax != '' && typeof(tax) != "undefined" ){
		taxAmount = subTotal * ( parseFloat(tax) /100 );
		$('#taxAmount').val(taxAmount.toFixed(2));
		total = subTotal + taxAmount;
	}else{
		$('#taxAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );
	calculatettlbill();
}