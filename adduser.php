<?php include 'lib/header.php'; ?>
    <!-- Add User Means App User
        Default Status is Admin. An Admin can add other user as stuff.
     -->
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>
    <!-- //header-ends -->
    <div class="container">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Add User</h3>
        </div>
        <div class="bs-example4">

            <div class="row">
                <div class="col-md-12">
                    <form action="users.php" method="post">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="name" class="form-control" type="text" placeholder="Name" required="">
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="username" class="form-control" type="text" placeholder="Username"
                                       required="">

                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="password" class="form-control" type="password" placeholder="Password"
                                       required="">

                            </div>

                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="email" class="form-control" type="email" placeholder="Email" required="">

                            </div>

                        </div>


                        <div class="col-md-6 submit-buttom">
                            <input type="submit" value="Save User" name="adduser" class="btn btn-success">
                            <input type="reset" value="Reset" class="btn btn-warning">

                        </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>

<?php include 'lib/footer.php'; ?>