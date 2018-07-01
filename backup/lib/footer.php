
</div>
<!--footer section start-->
<footer>
    <p>&copy Copyright: explore-it 2018. All Rights Reserved</p>
</footer>
<!--footer section end-->

<!-- main content end-->
</section>
<script src="<?php echo BASE_URL; ?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo BASE_URL; ?>https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/wow.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Datatable JavaScript -->
<script src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>

<!-- Custom JavaScript -->
<script src="assets/js/custom.js"></script>
<script>
	$(document).ready(function() {
		assigndataTable('invoice_product_data_table',10);
		assigndataTable('customer_table');
        assigndataTable('supplier_table');
		assigndataTable('stock_table',6);
        assigndataTable('product_table',10);
		assigndataTable('use_pro_invoice_table',3);
        assigndataTable('customer_statement_table',8);
        assigndataTable('customer_payment_table',8);

		//data table assign table
    	function assigndataTable(id,perpage = 5)
    	{
    		$('#'+id).DataTable({
    			 "pageLength": perpage,
                "order": [[ 1, "desc" ]]
    		});
    	}

    	
	});
</script>

</body>
</html>