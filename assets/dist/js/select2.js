$(document).ready(function () {

  var price_selector = 'radio_sale_price'; //global price selector for use. sale price as default
  //radio_sale_price
  //radio_wholesale_price


  $('#radio_sale_price').click(function () {
    price_selector = $(this).val();
    $('#sale_price').removeAttr('placeholder');
    $('#sale_price').attr('placeholder', 'Sale Price');
    $('#sale_price').val('');
    console.log(price_selector);
  });

  $('#radio_wholesale_price').click(function () {
    price_selector = $(this).val();
    $('#sale_price').removeAttr('placeholder');
    $('#sale_price').attr('placeholder', 'Wholesale Price');
    $('#sale_price').val('');
    console.log(price_selector);
  });

  $('.select2_dropdown').on('change', function () {
    var pid = $(".select2_dropdown option:selected").val();

    $.ajax({
      url: "functions.php",
      method: 'post',
      data: {
        page: 'addinvoice',
        target: 'getsingleproductdetails',
        action: 'singleproductdetails',
        pid: pid
      },
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        /// $('#size_h').val(data.size_h);
        /// $('#size_w').val(data.size_w);
        $('#unit_price').val(data.unit_price);

        if (price_selector === 'radio_sale_price') {
          $('#sale_price').val(data.sale_price);

        } else if (price_selector === 'radio_wholesale_price') {
          $('#sale_price').val(data.wholesale_price);
        }


        $('#purchase_price').val(data.purchase_price);
        $('#product_id').val(data.product_id);
      },
      error: function (e) {
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