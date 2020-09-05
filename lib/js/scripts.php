<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/bower_components/select2/dist/js/select2.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> -->

<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script src="assets/dist/js/custom.js"></script>
<script src="assets/dist/js/transactionandsuppliertransaction.js"></script>
<script src="assets/dist/js/select2.js"></script>

<!-- page script -->
<script>
    $(function () {
        $('#example1').DataTable();

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            "order": [[1, "desc"]]
        });

        $('#purchaselist').DataTable();


    });


</script>