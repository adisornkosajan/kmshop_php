<?php

session_start();
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}
require_once "config/db.php";


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM product WHERE id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('ลบต้นไม้เสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบต้นไม้เสร็จสิ้น";
        header("refresh:1; url=product.php");
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

    <title>สินค้า</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body id="page-top">

    <?php
    include 'admin_head.php';
    include 'admin_nva.php';


    ?>

<div id="layoutSidenav_content">
        <main>
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel">เพิ่ม</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="product_insert.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="firstname" class="col-form-label">ชื่อต้นไม้:</label>
                                    <input type="text" required class="form-control" name="product_name">
                                </div>
                                <label for="category" class="col-sm-1 control-label">Category</label>

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
                        <div class="mb-3">
                            <label for="price" class="col-form-label">ราคา:</label>
                            <input type="int" required class="form-control" id="price" name="product_price">
                        </div>
                        <div class="mb-3">
                            <label for="img" class="col-form-label">Image:</label>
                            <input type="file" required class="form-control" id="imgInput" name="product_image">
                            <img loading="lazy" width="100%" id="previewImg" alt="">
                        </div>
                        <p><b>Description</b></p>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea id="editor1" name="description" rows="10" cols="60" required></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">รายการสินค้า</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-header py-3">
            <a href="product_insert.php"  class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="userModal" data-bs-whatever="@mdo">เพิ่มต้นไม้</a>
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
                                <th scope="col">ชื่อต้นไม้</th>
                                <th scope="col">สายพันธ์ุ</th>
                                <th scope="col">คงเหลือ</th>
                                <th scope="col">รูปภาพสินค้า</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">คำอธิบาย</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->query("SELECT * FROM product JOIN category WHERE product.category = category.id");
                            $stmt->execute();
                            $users = $stmt->fetchAll();

                            if (!$users) {
                                echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                            } else {
                                foreach ($users as $user) {
                            ?>
                                    <tr>
                                        <td><?php echo $user['product_name']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['product_qty_add']; ?>  ต้น</td>
                                        <td width="100px"><img class="rounded" width="100%" src="uploads/<?php echo $user['product_image']; ?>" alt=""></td>
                                        <td><?php echo $user['product_price']; ?>    บาท</td>
                                        <td><?php echo $user['description']; ?></td>
                                        <td>
                                        <div class="btn-group m-b-10">
                                        <a href="product.php?id=<?php echo $user['id']; ?>#divOne" class="btn btn-outline-info btn-sm btn-modal">เพิ่มจำนวน</a>
                                        <a href="product_edit.php?id=<?php echo $user['Pro_id']; ?>" class="btn btn-outline-warning btn-sm btn-modal">แก้ไข</a>
                                        <a onclick="return confirm('คุณต้องการลบสินค้าใช่หรือไม่');" href="?delete=<?php echo $user['Pro_id']; ?>" class="btn btn-outline-danger btn-sm btn-delete">ลบข้อมูล</a>
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
    <div class="overlay" id="divOne">
    <?php 
    $id = $_GET['id'];
    ?>
        <div class="wrapper">
        <center> <h2>เพิ่มจำนวนสินค้า</h2><a class="close" href="#">&times;</a>  </center>   </body> 
                <div class="container">
                    <form action="action1.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                    <input type="hidden" readonly value="<?= $id = $_GET['id'];  ?>" class="form-control" placeholder="">

                            
                    <label for="price" class="col-form-label ">จำนวนต้น:</label><td><input type="int" required class="form-control " id="qty" name="product_qty_add" style="text-align: center;"></td>

                        <div class="form-group text-center">
                            <div class="col-md-12 mt-3">
                            <center><input type="submit" name="btn_insert" class="btn btn-success" value="เพิ่มสินค้า"></center>
                                </div>
                        </div>
                    </form>
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