<?php 

session_start();
require_once "config/db.php";
        


if (isset($_POST['submit'])) {
    $orders_user_id= $_POST['orders_user_id'];
    $today = date('Y-m-d');
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $products = $_POST['products'];
  $grand_total = $_POST['grand_total'];
  $address = $_POST['address'];
  $pmode = $_POST['pmode'];
  $img = $_FILES['orders_img'];
  $status = '6';
  $productqty = $_POST['qty'];
  $product_name =$_POST['product_qty_cart'];
  $grand_totalall =0;

  if ($grand_total>=300){
    $grand_totalall =$grand_total;
  }else{
    $grand_totalall=$grand_total+200;
  }
  


  

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'admin/checkout/'.$fileNew;
        move_uploaded_file($img['tmp_name'], $filePath);
                  $sql = $conn->prepare('INSERT INTO orders(name, email, phone, address, pmode, products, amount_paid,orders_img,orders_user_id,status,order_date )VALUES (:name,:email,:phone,:address,:pmode,:products,:grand_total,:orders_img,:orders_user_id,:status,:order_date )');
                  $sql->bindParam(":name", $name);
                  $sql->bindParam(":email", $email);
                  $sql->bindParam(":phone", $phone);
                  $sql->bindParam(":products", $products);
                  $sql->bindParam(":grand_total", $grand_totalall);
                  $sql->bindParam(":address", $address);
                  $sql->bindParam(":pmode", $pmode);
                  $sql->bindParam(":orders_img", $fileNew);
                  $sql->bindParam(":orders_user_id", $orders_user_id);
                  $sql->bindParam(":status", $status);
                  $sql->bindParam(":order_date", $today);
                  $sql->execute();
                  $stmt2 = $conn->prepare('DELETE FROM cart');
                  $stmt2->execute();

                 

                  if ($sql) {
                    $_SESSION['success'] = "Data has been inserted successfully";
                    header("location: cart.php");
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("location: cart.php");
                }

                $sql = $conn->prepare("UPDATE product SET  product_qty_add =:product_qty_add  WHERE product_name = :product_name");
                $sql->bindParam(":product_name", $product_name);
                $sql->bindParam(":product_qty_add", $product_qty_add);

                
            
        
}


?>
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