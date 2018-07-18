$(document).ready(function () {
    /*
    * Purchase Page JavaScript Code
    * */
    //Add New Row To Table for Purchase(Invoice)
    // addpurchase.php
    //Purchase Management System
     //invoice management

     //edit invoice calcaluation function in editsales.php


    $(function () { //invoice management

        //for calculating data of addinvoice.php (sale page)
     

        //Add Purchase Page
        $("#supplier_dropdown").change(function () {
            var x = $(this).val();

            $.ajax({
                url: 'functions.php',
                type: 'POST',
                data: {
                    action: 'getsuppliers',
                    page: 'supplier',
                    supplier_id: x
                },
                dataType: 'json',
                success: function (response) {
                    $("#supplier_id").val(response[0]);
                    $("#address").val(response[2]);
                    $("#contact").val(response[3]);
                }, error: function (error_data) {
                   // console.log(error_data);
                }
            });
        });

        //showing invoice Products by specific invoice id
        function showInvoiceInAddRowPage() {
            var invoice_no = $('#invoice_number').val();
            var date = $("#date_input").val();
            var supplier = $("#supplier").val();

            if (invoice_no != '' && date != '' && supplier != 'select')
            {
                $.ajax({
                    url: 'functions.php',
                    method: 'GET',
                    data: {
                        page: 'page',
                        action: 'showInvoiceList',
                    },
                    success: function (data) {
                        $('#invoice_product_data_table').append(data);
                    }, error: function (er) {

                    }
                });
            }
        }

        function addnewrow(addnewrowkey) {
            
            /*
            var groups = '';
            $.ajax({
                url: "functions.php",
                method: 'get',
                data: {
                    page: 'addinvoice',
                    action: 'getgroups'
                }, success: function (d) {
                    groups = d;
                    //console.log(groups);
                }, error: function (e) {
                    alert(e);
                }, async: false
            });*/
            var products = "";
            $.ajax({
                url: "functions.php",
                method: 'get',
                data: {
                    page: 'addpurchase',
                    action: 'getproducts'
                }, success: function (d) {
                    products = d;
                    
                }, error: function (e) {
                    alert(e);
                }, async: false
            });


            var row = '<tr style="text-align:center;">'
                //+ '<td width="10%">' '' + '</td>'
                //+ '<td width="10%">' + '<select class="form-control selectpicker"><option>Abc</option</select><option>Def</option</select>' + '</td>'
                + '<td width="10%">' + products  + '</td>'
                // + '<td width="10%">' + '<b class="product_name"></b>' + '</td>'
                + '<td width="10%">' + '<b class="product_type product_type'+addnewrowkey+'"></b>' + '</td>'
                + '<td width="8%">' + '<input type="number" name="quantity[]" class="form-control quantity quantity'+addnewrowkey+'" required >' + '</td>'
                + '<td width="8%">' + '<input type="text" name="purchase[]" class="form-control purchase  purchase'+addnewrowkey+'" required >' + '</td>'
                + '<td width="6%">' + '<input type="hidden" name="subtotalforsave[]" class="form-control subtotalforsave"><b class="subtotal">0</b> ' + '</td>'
                + '<td width="4%"><i class="fa fa-trash purchase_delete_btn" style="cursor:pointer;"><i></td>'
                + '</tr>';

            $('#inv_detail').append(row);

            $('#invoice_form_table tr td i').click(function() {
                $(this).parent().parent().remove();
                wholetotal();

            });

        }

        


        //remove apprend rows
        

        //addition of new row in addinvoice table by click
        var addnewrowkey = 1; //for giving unique class
        $('.add_new_invoice_table_row').click(function () {
            addnewrow(addnewrowkey);
            $('#inv_detail').find(".select2_product").select2();
            addnewrowkey++;
        });

        $('#inv_detail').delegate('.product_id, .product_name', 'keyup', function (e) {
            var tr = $(this).parent().parent();
            var product_id = $(this).val();
            var data = foo(product_id); //asyncronus function calling from foo
            tr.find('.product_name').html(data['product_name']);
            tr.find('.product_type').html(data['product_type']);
            tr.find('.product_type').html(data['typename']);
            tr.find('.purchase').val(data['purchase_price']);

            //$('.product_group').children('option').find


            //tr.find('.size_h').html(data['size_h']);
            //tr.find('.size_w').html(data['size_w']);

            //tr.find('.product_group').html(data['product_group']);

        });

        //select group in dropdown for finding product
        $('#inv_detail').delegate('.product_group', 'change', function (e) {
            var tr = $(this).parent().parent();
            var group_id = $(this).val();
            var namelist = '';
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    action: 'productnamelist',
                    group_id: group_id
                }, success: function (data) {
                    namelist = data;
                }, error: function (e) {
                    //console.log(e);
                }, async: false
            });

            tr.find('.product_name').html(namelist);
        });

        //select single product in product list dropdown for finding product details and assign in form fields
        var uniqueclassname = 1; //for giving unique class name and match with row
        $('#inv_detail').delegate('.product_list', 'change', function (e) {
            var tr = $(this).parent().parent();
            var pro_id = $(this).val();
            //console.log(pro_id);


            var d = getSingleProDetails();
            console.log()
           
            var t = $(this).parent().parent().parent();
            t.find('.product_id'+uniqueclassname).val(d['product_id']);
            t.find('.product_type'+uniqueclassname).html(d['typename']);
            t.find('.purchase'+uniqueclassname).val(d['purchase_price']);
            t.find('.sale_price'+uniqueclassname).val(d['sale_price']);


            function getSingleProDetails() {
                var details = [];
                $.ajax({
                    url: "functions.php",
                    method: 'post',
                    data: {
                        page: 'addinvoice',
                        action: 'getprodetails',
                        pro_id: pro_id
                    }, dataType: 'json',
                    success: function (d) {
                        details = d;
                    }, error: function (e) {
                       // console.log(e);
                    }, async: false
                });
                return details;
            }

            uniqueclassname++; //increase for key value for giving unique class name every time
        });


        //counting management
        $('#inv_detail').delegate('.quantity,.carton,.piece,.purchase,.subtotal,.wholetotal', 'keyup', function () {
            var tr = $(this).parent().parent();
            var quantity = tr.find('.quantity').val() - 0;
            var purchase = tr.find('.purchase').val() - 0;
            var subtotal = quantity * purchase;
            
            tr.find('.subtotal').html(subtotal.toFixed(2));
            tr.find('.subtotalforsave').val(subtotal); //for saving data to the server
            //tr.find('.total').html(subtotal);
            tr.find('.totalforsave').val(subtotal); //for saving data to server
            wholetotal();
            //calculation(); //declared at top in custom.js

        });

        //delete appended row from the addinvoice table
        $('#inv_detail').delegate('.deleterow', 'click', function () {
            $(this).parent().parent().fadeOut(300);

        });


        //getting product details by specific product id
        function foo(product_id) {
            var result;
            $.ajax({
                url: "functions.php",
                method: 'get',
                data: {
                    page: 'page',
                    action: 'showproductbyid',
                    product_id: product_id
                },
                dataType: 'json',
                success: function (data) {
                    result = data;
                }, error: function (err) {
                }, async: false
            });

            return result;
        }

        //total function for calculating the value of different fields
        function wholetotal() {
            var total = 0;
            $('.subtotal').each(function (i, e) {
                var amt = parseFloat($(this).html());
                total += amt;
            });

            $('.wholetotal').html(total);
            $('#subtotal').val(total.toFixed(2)); // in editsales.php
            $('#grandtotal').val(total.toFixed(2)); // in editsales.php
            
            
        }
    });
    

    ///function for sale(invoice) management system in addinvoice.php
    $(function(){
		
		//getting single customer data for addinvoice.php(sale)
		$('#cus_dropdown_addinvoice').change(function(){
            
			var cid = $(this).val();
			$.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    target:'sale',
                    action: 'getCustomerInformation',
                    cid: cid
                },
                dataType:'json',
                success: function (data) {
                    //(data);
                    console.log(data);
                    $('#customer_id').val(data.customer_id);
                    $('#address').val(data.address);
                    $('#contact').val(data.contact_no);
                    $('#customer_name').val(data.customer_name);
                    $('#totalbalance').val(data.customer_due);

                }, error: function (e) {
                    //console.log(e);
                }
            });
			
			
		});

		/*//get products for a single group by selecting product group
        $('#product_group_dropdown_add_sale').change(function(){
            var gid = $(this).val();
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    target:'getgroupproducts',
                    action: 'getallproductsbygroup',
                    gid: gid
                },
                success: function (data) {
                    $('#product_group_list_dropdown_add_sale').html(data);
                }, error: function (e) {
                   // console.log(e);
                }
            });


        });

        //get single product details for a specific product selected from products dropdown
        $('#product_group_list_dropdown_add_sale').change(function(){
            var pid = $(this).val();
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    target: 'getsingleproductdetails',
                    action: 'singleproductdetails',
                    pid: pid
                },dataType:'json',
                success: function (data) {
                   $('#size_h').val(data.size_h);
                   $('#size_w').val(data.size_w);
                   $('#unit_price').val(data.unit_price);
                   $('#sale_price').val(data.sale_price);
                   $('#purchase_price').val(data.purchase_price);
                   $('#product_id').val(data.product_id);
                }, error: function (e) {
                    //console.log(e);
                }


            });
        }); */

        var x = 0;
        //search product details by id in addinvoice.php
        $('#product_id').keyup(function(event) {
            let  product_id = $(this).val();
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    aim: 'getsingleprodetails',
                    action: 'singleprodetails',
                    product_id: product_id
                },dataType:'json',
                success: function (data) {
                  //console.log(data);
                  $('#product_group_list_dropdown_add_sale').html("<option>"+data.product_name+"</option>");
                  $('#sale_price').val(data.sale_price);
                  $('#purchase_price').val(data.purchase_price);
                }, error: function (e) {
                    console.log(e);
                }
            });
        });


        //add product to temp sales list
        $('#add_invo_pro_btn').click(function(){
            var cus_id = $('#cus_dropdown_addinvoice').val();
            var sell_id = $('#sell_id').val();
            var pro_id = $('#product_id').val();
            var quantity = $('#product_quantity').val();
            var sale_price = $('#sale_price').val();
            var purchase_price = $('#purchase_price').val();
            var purchase_price = $('#purchase_price').val();

			if(cus_id == "" || pro_id == ""){
				alert("Please Select Both Customer and Product");
			}else if(quantity == ''){
                alert("Please Fillup Quantity");
            }else{
                showSaleProducts();
				$.ajax({
					url: "functions2.php",
                    method: "post",
					data:{
					        sell_id: sell_id,
							cus_id: cus_id,
							pro_id: pro_id,
                            quantity: quantity,
                            sale_price: sale_price,
	                        purchase_price: purchase_price,
	                        action: "savesaleproduct",
	                        target: "singleproductsavebeforesale"
					},
					success:function(data){

                        if($.trim(data) == "select product first"){
					        alert('Please Select Product First');
                        }else if($.trim(data) == "already added"){
                            alert('Product Already Added');
                        }else{
                            showSaleProducts();
                            showSaleSubTotal();
                            calculation();

                            $('#reset_inv_product_group').attr("selected","");
                            var r = '<option selected="">Select Product</option>';
                            $('#product_group_list_dropdown_add_sale').html(r);
                            $('#sale_price').val('');
                            $('#product_quantity').val('');
                        }

					},error:function(e)
					{
						alert(e);
					}
				});
			}
        });

        //show sale products before complete sale
        //for showing sold products before payment
        function showSaleProducts() {
            var cus_id = $('#cus_dropdown_addinvoice').val();
            var sell_id = $('#sell_id').val();
            $.ajax({
                url: "functions2.php",
                method: "post",
                data: {
                    sell_id: sell_id,
                    cus_id: cus_id,
                    action: "showSaleProducts",
                    target: "showallsaleproductsbeforesave"
                },
                success: function (data) {
                    $("#inv_product_table").html(data);
                    showSaleSubTotal();
                    calculation();
                }, error: function (e) {

                }
            });
        }
        
        function showSaleSubTotal() {
            var sell_id = $('#sell_id').val();
            var cus_id = $('#cus_dropdown_addinvoice').val();

            $.ajax({
                url: "functions2.php",
                method: "post",
                data: {
                    sell_id : sell_id,
                    cus_id : cus_id,
                    action: "showSaleSubTotal",
                    target: "showsalesubtotal"
                },
                success: function (data) {
                    $('#subtotal').val(data);
                }, error: function (e) {

                }
            });
        }

        //update individual data for addited product
       $("#inv_product_table").delegate(".delete_sale_product","click",function () {
            var invoice_id = $(this).attr('invoice_id');
            var cus_id = $(this).attr('cus_id');
            var pro_id = $(this).attr('product_id');
           $.ajax({
               url: "functions2.php",
               method: "post",
               data: {
                   invoice_id: invoice_id,
                   cus_id: cus_id,
                   pro_id: pro_id,
                   action: "deleltesinglesaleproduct",
                   target: "deletesaleproduct"
               },
               success: function (data) {
                   showSaleProducts();
                   showSaleSubTotal();
               }, error: function (e) {

               }
           });
       });

        //$('#calculation_table').delegate("#discount, #vat, #dlcharge, #paid","keyup",function () {

          //calculation();
      // });


        $("#discount, #vat, #dlcharge, #paid").keyup(function() {
           calculation();
        });



        //for calculating data of addinvoice.php (sale page)
        function calculation(){

            var subtotal = parseFloat($('#subtotal').val());
            var balance = parseFloat($('#totalbalance').val());
            var discount = parseFloat($('#discount').val());
            var formvat = parseFloat($('#vat').val());
            var paid = parseFloat($('#paid').val());
            var payable = 0;

            var vat = (formvat/100)*subtotal;
            $('#realvat').val(vat.toFixed(2));

            var withvat = vat + subtotal;
            var grandtotal = withvat - discount;
            var dlcharge = parseInt($('#dlcharge').val());
            $('#dlchargeresult').html(grandtotal);

            grandtotal  = grandtotal + dlcharge;
            
            var payable = grandtotal;
            var due = $('#payable').val() -  paid;

            if (isNaN(payable)) {
                $('#payable').val(0)
            }else{
                $('#payable').val(payable.toFixed(2));
            }

            if (isNaN(grandtotal)) {
                $('#grandtotal').val(0);
            }else{
                $('#grandtotal').val(grandtotal.toFixed(2));
            }

            if (isNaN(due)) {
                $('#due').val("");
            }else{
                 $('#due').val(due.toFixed(2));
            }

           
        }

    });


    $(function(){
        let pre_due = parseInt($('#previous_due_amount').val());
       

        if(pre_due == 0 || pre_due == ""){
             $('#paid_action_btn').attr({
                 disabled: ''
             });
         }else{
            $('#paid_action_btn').click(function(event) {
                let paid_amount = parseInt($('#paid_amount').val());
                let cus_id = $('#cus_account_id').val();
                if(paid_amount == 0 || paid_amount == ""){
                    alert('Please fill up amount field');
                }else{
                    $.ajax({
                        url: 'functions2.php',
                        method: 'post',
                        data : {
                            action : 'paycustomerdue',
                            cus_id : cus_id,
                            paid_amount : paid_amount
                        },dataType:'json',
                        success: function(d)
                        {
                            alert('Payment Updated Successfully');
                            $('#exampleModal').modal('toggle');
                            $('#paid_amount').val('');
                            $('#current_due').html(d.update_amount+" TK");

                        },error:function(e)
                        {
                            console.log(e);
                        }
                    });
                }
            });

         }
    });



});