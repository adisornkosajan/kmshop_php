<?php 

session_start();
require_once "config/db.php";
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $product_price = $_POST['product_price'];
    $img = $_FILES['product_image'];
    $product_qty_add = $_POST['product_qty_add'];
    
    $description = $_POST['description'];

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {
                    $sql = $conn->prepare("INSERT INTO product(product_name, category, product_price, product_image,description,product_qty_add) VALUES(:product_name, :category, :product_price, :product_image, :description,:product_qty_add)");
                    $sql->bindParam(":product_name", $product_name);
                    $sql->bindParam(":category", $category);
                    $sql->bindParam(":product_price", $product_price);
                    $sql->bindParam(":product_qty_add", $product_qty_add);
                    $sql->bindParam(":product_image", $fileNew);
                    $sql->bindParam(":description", $description);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: product.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: product.php");
                    }
                }
            }
        }
}


?>