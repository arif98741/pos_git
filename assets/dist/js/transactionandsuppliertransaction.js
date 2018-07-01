  $(document).ready(function(){
    $('#transcategory').change(function(){
        var catid = $(this).val();
        $.ajax({
          url: 'functions.php',
          type: 'POST',
          data: {
              gettranscattype : 'gettranscattype',
              catid : catid
          },
          dataType: 'json',
          success: function (response) {
              if (response.category_type == 'Debit') {

                $('#credit').attr({
                  readonly: ''
                });

                $('#debit').attr({
                  required: ''
                });
                

                $('#debit').removeAttr('readonly');
                $('#credit').removeAttr('required');


              }else if(response.category_type == 'Credit'){
                $('#debit').attr({
                  readonly: ''
                });

                $('#credit').attr({
                  required: ''
                });

                $('#credit').removeAttr('readonly');
                $('#debit').removeAttr('required');
              }
          }, error: function (error_data) {
             // console.log(error_data);
          }
      });

    });
  });