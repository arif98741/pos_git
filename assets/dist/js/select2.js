$(document).ready(function(){
	//addinvoice.php
	//search product by onchage event
	$('.select2').on('change', function() {
      var pid =  $(".select2 option:selected").val();
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
    })

  /*$('.select2 input').on('keyup', function() {
    var d =  $(".select2 input").val();
    console.log(d);
  })*/



	 $('.select2_dropdown').select2();
});