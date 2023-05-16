<?php

session_start();

require_once "config/db.php";
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM product WHERE id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=product.php");
    }
}

$where = '';
if (isset($_GET['category'])) {
    $catid = $_GET['category'];
    $where = 'WHERE category_id =' . $catid;
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

    <title>ผู้ใช้งาน</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">เพิ่มสินค้า</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ตารางเพิ่มสินค้า</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form action="product_insert_db.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="firstname" class="col-form-label">ชื่อต้นไม้:</label>
                                    <input type="text" required class="form-control" name="product_name">
                                </div>
                                <label for="category" class="col-sm-1 control-label">สายพันธ์</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="category" name="category" required>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();

                                        foreach ($stmt as $crow) {
                                            $selected = ($crow['id'] == $catid) ? 'selected' : '';
                                            echo "<option value='" . $crow['id'] . "' " . $selected . ">" . $crow['name'] . "</option>";
                                        }
                                        ?>

                                        <option value="" selected>- Select -</option>

                                    </select>
                                </div>
                        </div>
                        <div class="col-sm-9">
                            <label for="price" class="col-form-label">ราคา:</label>
                            <input type="int" required class="form-control" id="price" name="product_price">
                        </div>
                        <div class="col-sm-9">
                            <label for="price" class="col-form-label">จำนวนต้น:</label>
                            <input type="int" required class="form-control" id="qty" name="product_qty_add">
                        </div>
                        <br>
                        <div class="col-sm-9">
                            <label for="img" class="col-form-label">รูปภาพ:</label>
                            <input type="file"  id="imgInput" name="product_image">
                            <img loading="lazy" width="100%" id="previewImg" alt="">
                        </div>
                        <p><b>คำอธิบาย</b></p>
                        <div class="form-group">
                            
                            <div class="col-sm-12">
                                <textarea id="editor1" name="description" rows="10" cols="60" required></textarea>
                            </div>

                        </div>
                        

                        <div class="modal-footer">
                        <a href="product.php" class="btn btn-secondary">ย้อนกลับ</a>
                            <button type="submit" name="submit" class="btn btn-success">ยืนยัน</button>
                        </div>
                        </form>
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