<?php

session_start();
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}
require_once "config/db.php";
require_once('PHPMailer/PHPMailerAutoload.php');
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $email = $_POST['email'];

    $stmt = $conn->query("SELECT * FROM orders WHERE id = $id");
    $stmt->execute();
    $data = $stmt->fetch();

    $parcel_number = $_POST['parcel_number'];

    $sql = $conn->prepare("UPDATE orders SET status  = :status ,parcel_number = :parcel_number WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":status", $status);
    $sql->bindParam(":parcel_number", $parcel_number);
    $sql->execute();

    if ($status == '3') {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;  //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->isHTML();
        $mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
        $mail->Username = "sb6240259114@lru.ac.th"; //ให้ใส่ Gmail ของคุณเต็มๆเลย
        $mail->Password = "molmon0707"; // ใส่รหัสผ่าน
        $mail->SetFrom = ('kmshop@domaintest.com'); //ตั้ง email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง ใส่หรือไม่ใส่ก็ได้ เพราะผมก็ไม่รู้ว่ามันแาดงให้เห็นตรงไหน
        $mail->FromName = "kmshop"; //ชื่อที่ใช้ในการส่ง
        $mail->Subject = "กำลังส่งต้นไม้ให้คุณ";  //หัวเรื่อง emal ที่ส่ง
        $mail->Body = "<html>
            <head>
            <title></title>
            </head>
            <body>                
            <div style='width:800px;background:#fff;border-style:groove;'>
            <div style='width:50%;height:20px; text-align:right;margin-
            top:-32px;padding-left:390px;'><a href='http://localhost/projact3/index.php' style='color:#00BDD3;text-
            decoration:none;'> 
            KMshop</a> | <a href='http://localhost/projact3/index.php' style='color:#00BDD3;text-
            decoration:none;'>Dashboard </a> </div>
            <h2 style='width:50%;height:40px; text-align:right;margin:0px;padding-
            left:390px;color:#B24909;'>KMshop</h2>
            <h4 style='color:#ea6512;margin-top:-20px;'> สวัสดีครับ, " . $data['name'] . "
            </h4>
            <p>ขอบคุณสำหรับการซื้อของ เลขพัสดุของคุณคือ".  "      ". $data['parcel_number']." </p>
            <hr/>
            <div style='height:210px;'>
            <table cellspacing='0' width='100%' >
            <thead>
            <col width='80px' />
            <col width='40px' />
            <col width='40px' />
            <tr>                                    
            <th style='color:#0A903B;text-align:left;'>ที่อยู่ของคุณ</th>
            <th style='color:#0A903B;text-align:left;'>สินค้าทีั่คุณซื้อ: </th>                                                                            
            </tr>
            </thead>
            <tbody>   
            <tr>
            <td style='text-align:left;'>" . $data['name'] . " <br> " . $email . " 
            <br> " . $data['phone'] . " <br>" . $data['address'] . " </td>
            <td style='text-align:left;'>" . $data['products']  . " <br> เวลาที่ซื้อ:" . $data['order_date'] . " 
            </tr>   
            <tr>
            </tbody> 
            </table>                        
            <hr width='100%' size='1' color='black' style='margin-top:10px;'>                          
            <table cellspacing='0' width='100%' style='padding-left:300px;'>
            <thead>                                                                                                              
            <th style='color:#0A903B;text-align:right;'>รวมทั้งสิ้น:</th>
            <th style='color:black;text-align:left;padding-bottom:5px;padding-
            left:10px;'>" . $data['amount_paid'] . "</th>                                        
            </thead>   
            </table>             
            </div> 
            </div>              
            </body>
            </html>"; //รายละเอียดที่ส่ง

        $mail->AddAddress("$email", "ลูกค้า"); //อีเมล์และชื่อผู้รับ

        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
        //ตรวจสอบว่าส่งผ่านหรือไม่
        if ($mail->Send()) {
            echo "ข้อความของคุณได้ส่งพร้อมไฟล์แนบแล้วจ้า";
        } else {
            echo "การส่งไม่สำเร็จ";
        }
    } elseif ($status == '4') {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;  //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->isHTML();
        $mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
        $mail->Username = "sb6240259114@lru.ac.th"; //ให้ใส่ Gmail ของคุณเต็มๆเลย
        $mail->Password = "molmon0707"; // ใส่รหัสผ่าน
        $mail->SetFrom = ('kmshop@domaintest.com'); //ตั้ง email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง ใส่หรือไม่ใส่ก็ได้ เพราะผมก็ไม่รู้ว่ามันแาดงให้เห็นตรงไหน
        $mail->FromName = "kmshop"; //ชื่อที่ใช้ในการส่ง
        $mail->Subject = "จัดส่งสำเร็จแล้ว";  //หัวเรื่อง emal ที่ส่ง
        $mail->Body = "<html>
        <head>
        <title></title>
        </head>
        <body>                
        <div style='width:800px;background:#fff;border-style:groove;'>
        <div style='width:50%;height:20px; text-align:right;margin-
        top:-32px;padding-left:390px;'><a href='http://localhost/projact3/index.php' style='color:#00BDD3;text-
        decoration:none;'> 
        KMshop</a> | <a href='http://localhost/projact3/index.php' style='color:#00BDD3;text-
        decoration:none;'>Dashboard </a> </div>
        <h2 style='width:50%;height:40px; text-align:right;margin:0px;padding-
        left:390px;color:#B24909;'>KMshop</h2>
        <h4 style='color:#ea6512;margin-top:-20px;'> สวัสดีครับ, " . $data['name'] . "
        </h4>
        <p>พัสดุของคุณจัดส่งสำเร็จแล้ว เลขพัสดุของคุณคือ".  "      ". $data['parcel_number']." </p>
        <hr/>
        <div style='height:210px;'>
        <table cellspacing='0' width='100%' >
        <thead>
        <col width='80px' />
        <col width='40px' />
        <col width='40px' />
        <tr>                                    
        <th style='color:#0A903B;text-align:left;'>ที่อยู่ของคุณ</th>
        <th style='color:#0A903B;text-align:left;'>สินค้าทีั่คุณซื้อ: </th>                                                                            
        </tr>
        </thead>
        <tbody>   
        <tr>
        <td style='text-align:left;'>" . $data['name'] . " <br> " . $email . " 
        <br> " . $data['phone'] . " <br>" . $data['address'] . " </td>
        <td style='text-align:left;'>" . $data['products']  . " <br> เวลาที่ซื้อ:" . $data['order_date'] . " 
        </tr>   
        
        <tr>
        </tbody> 
        </table>                        
        <hr width='100%' size='1' color='black' style='margin-top:10px;'>                          
        <table cellspacing='0' width='100%' style='padding-left:300px;'>
        <thead>                                                                                                              
        <th style='color:#0A903B;text-align:right;'>รวมทั้งสิ้น:</th>
        <th style='color:black;text-align:left;padding-bottom:5px;padding-
        left:10px;'>" . $data['amount_paid'] . "</th>                                        
        </thead>   
        </table>             
        </div> 
        </div>              
        </body>
        </html>"; //รายละเอียดที่ส่ง
        $mail->AddAddress("$email", "ลูกค้า"); //อีเมล์และชื่อผู้รับ

        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
        //ตรวจสอบว่าส่งผ่านหรือไม่
        if ($mail->Send()) {
            echo "ข้อความของคุณได้ส่งพร้อมไฟล์แนบแล้วจ้า";
        } else {
            echo "การส่งไม่สำเร็จ";
        }
    }elseif ($status == '1') {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls"; //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;  //ตรงส่วนนี้ผมไม่แน่ใจ ลองเปลี่ยนไปมาใช้งานได้
        $mail->isHTML();
        $mail->CharSet = "utf-8"; //ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
        $mail->Username = "sb6240259114@lru.ac.th"; //ให้ใส่ Gmail ของคุณเต็มๆเลย
        $mail->Password = "molmon0707"; // ใส่รหัสผ่าน
        $mail->SetFrom = ('kmshop@domaintest.com'); //ตั้ง email เพื่อใช้เป็นเมล์อ้างอิงในการส่ง ใส่หรือไม่ใส่ก็ได้ เพราะผมก็ไม่รู้ว่ามันแาดงให้เห็นตรงไหน
        $mail->FromName = "kmshop"; //ชื่อที่ใช้ในการส่ง
        $mail->Subject = "ยืนยันการสั่งซื้อสินค้าของคุณแล้ว";  //หัวเรื่อง emal ที่ส่ง
        $mail->Body = "<html>
        <head>
        <title></title>
        </head>
        <body>                
        <div style='width:800px;background:#fff;border-style:groove;'>
        <div style='width:50%;height:20px; text-align:right;margin-
        top:-32px;padding-left:390px;'><a href='http://localhost/projact3/index.php' style='color:#00BDD3;text-
        decoration:none;'> 
        KMshop</a> | <a href='http://localhost/projact3/index.php' style='color:#00BDD3;text-
        decoration:none;'>Dashboard </a> </div>
        <h2 style='width:50%;height:40px; text-align:right;margin:0px;padding-
        left:390px;color:#B24909;'>KMshop</h2>
        <h4 style='color:#ea6512;margin-top:-20px;'> สวัสดีครับ, " . $data['name'] . "
        </h4>
        <p>ทางเราได้ยืนยันการจัดส่งของคุณเรียบร้อยแล้ว  </p>
        <hr/>
        <div style='height:210px;'>
        <table cellspacing='0' width='100%' >
        <thead>
        <col width='80px' />
        <col width='40px' />
        <col width='40px' />
        <tr>                                    
        <th style='color:#0A903B;text-align:left;'>ที่อยู่ของคุณ</th>
        <th style='color:#0A903B;text-align:left;'>สินค้าทีั่คุณซื้อ: </th>                                                                            
        </tr>
        </thead>
        <tbody>   
        <tr>
        <td style='text-align:left;'>" . $data['name'] . " <br> " . $email . " 
        <br> " . $data['phone'] . " <br>" . $data['address'] . " </td>
        <td style='text-align:left;'>" . $data['products']  . " <br> เวลาที่ซื้อ:" . $data['order_date'] . " 
        </tr>   
        
        <tr>
        </tbody> 
        </table>                        
        <hr width='100%' size='1' color='black' style='margin-top:10px;'>                          
        <table cellspacing='0' width='100%' style='padding-left:300px;'>
        <thead>                                                                                                              
        <th style='color:#0A903B;text-align:right;'>รวมทั้งสิ้น:</th>
        <th style='color:black;text-align:left;padding-bottom:5px;padding-
        left:10px;'>" . $data['amount_paid'] . "</th>                                        
        </thead>   
        </table>             
        </div> 
        </div>              
        </body>
        </html>"; //รายละเอียดที่ส่ง
        $mail->AddAddress("$email", "ลูกค้า"); //อีเมล์และชื่อผู้รับ

        //ส่วนของการแนบไฟล์ ซึ่งทดสอบแล้วแนบได้จริงทั้งไฟล์ .rar , .jpg , png ซึ่งคงมีหลายนามสกุลที่แนบได้
        //ตรวจสอบว่าส่งผ่านหรือไม่
        if ($mail->Send()) {
            echo "ข้อความของคุณได้ส่งพร้อมไฟล์แนบแล้วจ้า";
        } else {
            echo "การส่งไม่สำเร็จ";
        }
    }


    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        header("location: orders.php");
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

    <title>สถานะการจัดส่ง</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<body id="page-top">

    <?php
    include 'admin_head.php';
    include 'admin_nva.php';


    ?>

    <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">ชื่อผู้ใช้งาน</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="container mt-5">
                        <h1>Edit Data</h1>
                        <hr>
                        <form action="orders_edit.php" method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $stmt = $conn->query("SELECT * FROM orders WHERE id = $id");
                                $stmt->execute();
                                $data = $stmt->fetch();
                            }
                            ?>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">ID:</label>
                                <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id">
                            </div>
                            <select name="status" class="form-control">
                                <option value="" selected disabled>สถานะการจัดส่ง</option>
                                <option value="1">ยืนยันการสั่งซื้อสินค้า</option>
                                <option value="2">รอการจัดส่ง</option>
                                <option value="3">กำลังจัดส่ง</option>
                                <option value="4">ส่งสำเร็จแล้ว</option>
                                <option value="5">ยกเลิกสินค้า</option>
                                <option value="8">ยืนยันหลังจากเคลม</option>
                                <option value="6">ตรวจสอบข้อมูล</option>
                            </select>
                            <input type="hidden" class="email" name="email" value="<?= $data['email'] ?>">

                            <div class="mb-3">
                                <label for="parcel_number" class="col-form-label">เลขพัสดุ</label>
                                <input type="text" value="<?php echo $data['parcel_number']; ?>" required class="form-control" name="parcel_number">
                            </div>
                            <hr>
                            <a href="orders.php" class="btn btn-secondary">Go Back</a>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
    </table>
    </div>
    <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</body>

</html>