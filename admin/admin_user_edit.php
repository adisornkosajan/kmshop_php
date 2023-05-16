<?php

session_start();

require_once "config/connection.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $urole = $_POST['urole'];

    $sql = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname,email= :email,phone= :phone,address= :address,urole=:urole WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":firstname", $firstname);
    $sql->bindParam(":lastname", $lastname);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":phone", $phone);
    $sql->bindParam(":address", $address);
    $sql->bindParam(":urole", $urole);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        header("location: admin_user.php");
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
        header("location: Proflie.php");
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

    <title>ผู้ใช้งาน</title>

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
    <div class="container-fluid" style="background-color:#E4FED6;">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">ชื่อผู้ใช้งาน</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="background-color:#E4FED6;">
            <div class="card-body">
                <div class="container mt-5">
                    <h1>แก้ไขข้อมุล</h1>
                    <hr>
                    <form action="admin_user_edit.php" method="post" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $stmt1 = $conn->query("SELECT * FROM users WHERE id = $id");
                            $stmt1->execute();
                            $data = $stmt1->fetch();
                            
                        }
                        ?>
                        <div class="mb-3">
                            <label for="id" class="col-form-label">รหัสผู้ใช้งาน:</label>
                            <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id">
                            <label for="firstname" class="col-form-label">ชื่อ:</label>
                            <input type="text" value="<?php echo $data['firstname']; ?>" required class="form-control" name="firstname">
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">สกุล:</label>
                            <input type="text" value="<?php echo $data['lastname']; ?>" required class="form-control" name="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">อีเมล:</label>
                            <input type="text" value="<?php echo $data['email']; ?>" required class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">เบอร์โทรศัพท์:</label>
                            <input type="int" value="<?php echo $data['phone']; ?>" required class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">ที่อยู่:</label>
                            <input type="text" value="<?php echo $data['address']; ?>" required class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <select name="urole" class="form-control">
                                <option value="" selected disabled>-เลือกสถานะ</option>
                                <option value="admin">ผู้ดูแลระบบ</option>
                                <option value="user">ผู้ใช้งาน</option>
                            </select>
                        </div>

                        <hr>
                        <a href="admin_user.php" class="btn btn-secondary">ย้อนกลับ</a>
                        <button type="submit" name="update" class="btn btn-primary">อัพเดต</button>
                    </form>
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