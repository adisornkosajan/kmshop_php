<?php
session_start();
require_once('config/connection.php');
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}
if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM category WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_REQUEST['btn_update'])) {
    $firstname_up = $_REQUEST['txt_name'];

    if (empty($firstname_up)) {
        $errorMsg = "Please Enter Fisrtname";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE category SET name = :fname_up WHERE id = :id");
                $update_stmt->bindParam(':fname_up', $firstname_up);
                $update_stmt->bindParam(':id', $id);

                if ($update_stmt->execute()) {
                    $updateMsg = "Record update successfully...";
                    header("refresh:2;category.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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
    <?php
    if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
    if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $stmt1 = $conn->query("SELECT * FROM category WHERE id = $id");
                            $stmt1->execute();
                            $data = $stmt1->fetch();
                            $name = $data['name'];; 
                        }
                        ?>


    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" class="form-horizontal mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div class="form-group text-center">
                            <div class="row">
                                <label for="firstname" class="col-sm-3 control-label">ชื่อสายพันธ์</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" value="<?php echo $name; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-md-12 mt-3">
                                <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                                <a href="category.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                </div>
        </div>
    </div>
    </form>
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


    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>