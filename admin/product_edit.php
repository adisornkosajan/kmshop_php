<?php 

    session_start();
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ..signin.php');
    }
    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $product_price = $_POST['product_price'];
        $img = $_FILES['product_image'];
        $description = $_POST['description'];

        $img2 = $_POST['img2'];
        $upload = $_FILES['product_image']['name'];

        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode('.', $img['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'uploads/'.$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($img['size'] > 0 && $img['error'] == 0) {
                   move_uploaded_file($img['tmp_name'], $filePath);
                }
            }

        } else {
            $fileNew = $img2;
        }

        $sql = $conn->prepare("UPDATE product SET product_name = :product_name, category = :category, product_price = :product_price, product_image = :product_image,description = :description WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":product_name", $product_name);
        $sql->bindParam(":category", $category);
        $sql->bindParam(":product_price", $product_price);
        $sql->bindParam(":product_image", $fileNew);
        $sql->bindParam(":description", $description);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: product.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: product.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลต้นไม้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>แก้ไขข้อมูลต้นไม้</h1>
        <hr>
        <form action="product_edit.php" method="post" enctype="multipart/form-data">
            <?php
                if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM product WHERE Pro_id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                }
            ?>
                <div class="mb-3">
                    <label for="id" class="col-form-label">รหัสต้นไม้:</label>
                    <input type="text" readonly value="<?php echo $data['Pro_id']; ?>" required class="form-control" name="id" >
                    <label for="firstname" class="col-form-label">ชื่อต้นไม้:</label>
                    <input type="text" value="<?php echo $data['product_name']; ?>" required class="form-control" name="product_name" >
                    <input type="hidden" value="<?php echo $data['product_image']; ?>" required class="form-control" name="img2" >
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">สายพันธ์</label>
                    <input type="text" value="<?php echo $data['category']; ?>" required class="form-control" name="category">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ราคา:</label>
                    <input type="text" value="<?php echo $data['product_price']; ?>" required class="form-control" name="product_price">
                </div>
                <div class="mb-3">
                    <label for="img" class="col-form-label">รูปภาพ:</label>
                    <input type="file" class="form-control" id="imgInput" name="product_image">
                    <img width="100%" src="uploads/<?php echo $data['product_image']; ?>" id="previewImg" alt="">
                </div>
                <p><b>คำอธิบาย</b></p>
                        <div class="form-group" >
                            <div class="col-sm-12" value="<?php echo $data['description']; ?>">
                                <textarea  id="editor1" name="description" rows="10" cols="60" required=""><?php echo $data['description']; ?></textarea>
                            </div>
                        </div>
                <hr>
                <a href="product.php" class="btn btn-secondary">ย้อนกลับ</a>
                <button type="submit" name="update" class="btn btn-primary">อัพเดต</button>
            </form>
    </div>

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