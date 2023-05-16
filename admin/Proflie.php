<?php
session_start();
require_once('config/connection.php');
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proflie</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php
    include 'admin_head.php';
    include 'admin_nva.php';


    ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">ข้อมูลผู้ดูแลระบบ</h1>

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-8 col-lg-7">

                <!-- Area Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <div class="col-md-8 order-md-1">
                            <td width="150px"><img class="rounded" width="15%" src="uploads/<?php echo $row['img']; ?>" alt="">
                                <form class="needs-validation" novalidate="">
                                    <div class="row">
                                        <div class="col-md-4 mb-1">
                                            <label for="firstName">ชื่อ</label>
                                            <h4 class="mb-3"><?php echo $row['firstname']; ?></h4>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label for="lastName">สกุล</label>
                                            <h4 class="mb-3"><?php echo $row['lastname']; ?></h4>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">เบอร์ <span class="text-muted"></span></label>
                                        <h4 class="mb-3"><?php echo $row['phone'] ?></h4>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">อีเมล <span class="text-muted"></span></label>
                                        <h4 class="mb-3"><?php echo $row['email'] ?></h4>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address">ที่อยู่</label>
                                        <h4 class="mb-3"><?php echo $row['address'] ?></h4>

                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </div>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning">แก้ไข</a>
                                    <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $user['id']; ?>" class="btn btn-outline-danger">ลบ</a>

                        </div>
                    </div>

                 
                
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">ขอให้วันนี้เป็นวันที่ดี</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>