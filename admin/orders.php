<?php

session_start();
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}
require_once "config/db.php";


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM orders WHERE id = $delete_id");
    $deletestmt->execute();

    $deletestmt = $conn->query("DELETE FROM can_claim WHERE order_id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=orders.php");
    }
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

    <title>สินค้าทั้งหมด</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php
    include 'admin_head.php';
    include 'admin_nva.php';


    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">สินค้าที่สั่งซื้อทั้งหมด</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <thead>
                            <tr>
                                <th scope="col">รหัสรายการสั่งซื้อ</th>
                                <th scope="col">ชื่อ-สกุล</th>
                                <th scope="col">อีเมล</th>
                                <th scope="col">ที่อยู่</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">สินค้า</th>
                                <th scope="col">การชำระเงิน</th>
                                <th scope="col">ใบเสร็จรับเงิน</th>
                                <th scope="col">สถานะการจัดส่ง</th>
                                <th scope="col">วัน</th>
                                <th scope="col">เลขพัสดุ</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->query("SELECT * FROM orders  ");
                            $stmt->execute();
                            $users = $stmt->fetchAll();

                            if (!$users) {
                                echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                            } else {
                                foreach ($users as $user) {
                            ?>
                                    <tr>
                                    <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['address']; ?></td>
                                        <td><?php echo $user['amount_paid']; ?></td>
                                        <td><?php echo $user['products']; ?></td>
                                        <td><?php echo $user['pmode']; ?></td>
                                        <td width="100px"><img class="rounded" width="100%" src="checkout/<?php echo $user['orders_img'];?>" alt=""></td>
                                        <td><?php if($user['status']== 1 ){
                                            echo "ยืนยันการสั่งซื้อสินค้า";
                                        } elseif($user['status']== 2){
                                            echo "รอการจัดส่ง";
                                        } elseif($user['status']== 3){
                                            echo "กำลังดำเนินการจัดส่ง";
                                        } elseif($user['status']== 4){
                                            echo "พัสดุถูกจัดส่งเสร็จสินแล้ว";
                                        } elseif($user['status']== 5){
                                            echo "ยกเลิกสินค้า";
                                        } elseif($user['status']== 6){
                                            echo "ตรวจสอบข้อมูล";
                                        } elseif($user['status']== 7){
                                            echo "เคลมสินค้า";
                                        } elseif($user['status']== 8){
                                            echo "ยืนยันหลังจากเคลม";
                                        } elseif($user['status']== 9){
                                            echo "ไม่สามารถเคลมสินค้าได้";
                                        } elseif($user['status']== 10){
                                            echo "รอชำระเงิน";
                                        } 
                                        ?></td>
                                        <td><?php echo $user['order_date']; ?></td>
                                        <td><?php echo $user['parcel_number']; ?></td>
                                        <td>
                                        <div class="btn-group m-b-10">
                                        <?php if($user['status']== 4 ){
                                            ?>
                                            <a href="tablespdf.php?id=<?php echo $user['id']; ?>" class="btn btn-outline-info btn-sm btn-modal" target="_black">พิมพ์ใบเสร็จ</a>
                                            <?php
                                        }  elseif($user['status']== 8){
                                            ?>
                                            <a href="tablespdf.php?id=<?php echo $user['id']; ?>" class="btn btn-outline-info btn-sm btn-modal" target="_black">พิมพ์ใบเสร็จ</a>
                                            <?php

                                        } elseif($user['status']== 9){
                                           ?>
                                           <a href="tablespdf.php?id=<?php echo $user['id']; ?>" class="btn btn-outline-info btn-sm btn-modal" target="_black">พิมพ์ใบเสร็จ</a>
                                           <?php
                                        }  
                                        ?>
                                           
                                            <a href="orders_edit.php?id=<?php echo $user['id']; ?>" class="btn btn-outline-warning btn-sm btn-modal">แก้ไข</a>
                                            <a onclick="return confirm('คุณต้องการลบคำสั่งซื้อนี้ใช่หรือไม่');" href="?delete=<?php echo $user['id']; ?>" class="btn btn-outline-danger btn-sm btn-delete">ลบ</a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
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


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>

</body>

</html>