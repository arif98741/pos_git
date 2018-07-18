$(document).ready(function(){

	//addinvoice.php
	//search product by onchage event
  /*$('.select2_dropdown').on('change', function() {
      var data = $(".select2_dropdown option:selected").val();
      console.log(data);
    })*/


	$('.select2_dropdown').on('change', function() {
      var pid =  $(".select2_dropdown option:selected").val();
      //console.log(pid);
      //console.log($("select2-search__field").val());
      
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
            console.log(data);
            /// $('#size_h').val(data.size_h);
            /// $('#size_w').val(data.size_w);
             $('#unit_price').val(data.unit_price);
             $('#sale_price').val(data.sale_price);
             $('#purchase_price').val(data.purchase_price);
             $('#product_id').val(data.product_id);
          }, error: function (e) {
              //console.log(e);
          }
       });
    });

  /*$('.select2 input').on('keyup', function() {
    var d =  $(".select2 input").val();
    console.log(d);
  })*/



	 
	 $('#cus_dropdown_addinvoice').select2(); //customer live search in addinvoice.php
   $('.select2_dropdown').select2(); //product live search in addinvoice.php
   //$('.select2_product').select2();
   $('.universal_select2_dropdown').select2(); //live search for using in report or other place during live search


  // $('.selectpicker').selectpicker('show');

});