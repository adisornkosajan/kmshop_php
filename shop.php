<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="goto-here">
  <?php include 'index_nva.php';

  ?>



  <div class="hero-wrap hero-bread" style="background-image: url('images/tt80-1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-0 bread" style="color:gray">สินค้าทั้งหมด</h1>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  
 
  <section class="ftco-section" style="padding: 0em ;">
    
  
    
    <div class="container">
      
      <div id="message"></div>
      <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">

   <a class="alert alert-success" style="border-radius:45px;"   href="shop.php?page=1"><font size="4">ทั้งหมด</font></a>&nbsp;&nbsp;
            <?php
            $stmt = $conn->prepare("SELECT * FROM category");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $result1 = $stmt->fetchAll();

            if (!$result1) {

            } else {
                foreach ($result1 as $result) {
                    $name = $result['name']; 


            ?> 
            
            <a style="border-radius:45px;" class="alert alert-success" href="shop_category.php?category=<?php echo $result['id']; ?>"><font size="4"><td><?php echo $name?></font>  </a>&nbsp;&nbsp;
            

            <?php }
            }
            ?>

        
      
      </ul>
    </nav>
      <div class="row mt-2 pb-3">
        
        
        <?php
        $count = $conn->prepare('SELECT COUNT(Pro_id) as cpt from product');
        $count->setFetchMode(PDO::FETCH_ASSOC);
        $count->execute();
        $tcount = $count->fetchAll();

        if(isset($_GET["page"])){
          $page = $_GET["page"];
        }else{
          $page = 1;
        }
        $limit = 12;
        $strat = ($page - 1) * $limit;

        $next = $page+1;

        $previous = $page-1;

        $stmt = $conn->prepare("SELECT * FROM product WHERE  category  limit $strat,$limit");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result1 = $stmt->fetchAll();

        $stmt22 = $conn->prepare("SELECT * FROM product WHERE  category  ");
        $stmt22->setFetchMode(PDO::FETCH_ASSOC);
        $stmt22->execute();
        $result22 = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_data =  $stmt22->rowCount();

        $total_p = ceil($total_data / $limit);



        if (!$result1) {
          echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
        } else {
          foreach ($result1 as $result) {
        ?>


            <div class="col-md-6 col-lg-3 ftco-animate">
              <div class="card-deck">
                <div class="card p-2 border-secondary mb-2">
                  <img src="admin/uploads/<?= $result['product_image'] ?>" class="card-img-top" height="150">
                  <div class="card-body p-1">
                    <h4 class="card-title text-center text-info"><?= $result['product_name'] ?></h4>
                    <h5 class="card-text text-center text-danger"></i>&nbsp;&nbsp;<?= number_format($result['product_price'], 2) ?>/บาท</h5>
                    <h5 class="card-text text-center "><font size="3"> มีอยู่</i>&nbsp;&nbsp;<?=($result['product_qty_add']) ?>  ต้น</h5></font>

                  </div>
                  <div class="card-footer p-1">
                    <form action="" class="form-submit">
                      <div class="row p-2">
                        <div class="col-md-6 py-1 pl-4">
                          <b>จำนวน : </b>

                        </div>
                        <div class="col-md-6">
                        <?php $am = $result['product_qty_add'] ;?>
                            <input type="number" class="pqty"  onkeyup="checkNumber(this,'<?php echo $am;?>')" value="1" placeholder="" min="1" max="<?= $result['product_qty_add'] ?>">
                            <script type='text/javascript'>
                              function checkNumber(elm,$am) {
                                i=parseInt($am);
                                if (elm.value > i) {
                                  alert('กรอกต้นไม้ได้ไม่เกินจำนวนที่มี');
                                  elm.value = '';

                                }
                              }
                            </script>


                         
                          
                        </div>
                      </div>
                      <input type="hidden" class="pid" value="<?= $result['id'] ?>">
                      <input type="hidden" class="pname" value="<?= $result['product_name'] ?>">
                      <input type="hidden" class="pprice" value="<?= $result['product_price'] ?>">
                      <input type="hidden" class="pimage" value="<?= $result['product_image'] ?>">
                      <input type="hidden" class="pcode" value="<?= $result['product_code'] ?>">
                      <input type="hidden" class="pqtyad" value="<?= $result['product_qty_cart'] ?>">
                      
                      <a href="product-single.php?id=<?php echo $result['id']; ?>" class="btn btn-outline-success ">ดูข้อมูล</a>
                      <?php if ($result['product_qty_add'] == "0") {
                                echo "<td><span >สินค้าหมด</span></td>";
                            } else {
                              ?>
                                <button class="btn btn-outline-success addItemBtn" onclick='javascript:location.reload()' ><i class="buy-now d-flex justify-content-center align-items-center mx-1"  ></i>&nbsp;&nbsp;เพิ่มสินค้า</button>
                            <?php }
                            ?>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php }
        }
        ?>
      </div>
    </div>
    
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item ">
          <a class="page-link" href="?page=<?php echo $previous ==0 ? 1 : $previous?>" >Previous</a>
        </li>
        <?php 
        for($i=1;$i<=$total_p;$i++){
          ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $next == $total_p ?$total_p : $next ?>">Next</a>
        </li>
      </ul>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row">
          <div class="mouse">
            <a href="#" class="mouse-icon">
              <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
            </a>
          </div>
        </div>
    </footer>
   
    <section class="ftco-section contact-section bg-light">
      
    </section>
</body>
</html>




    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
      </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript"></script>
    <style> 

.div1 {
    width: 300px;
    height: 70px;    
    padding: 60px;
    border: 1px solid red;
}
</style>
  
    <script>
        $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'shop.php?category='+val;
    }
  });
      $(document).ready(function() {

        // Send product details in the server
        $(".addItemBtn").click(function(e) {
          e.preventDefault();
          var $form = $(this).closest(".form-submit");
          var pid = $form.find(".pid").val();
          var pname = $form.find(".pname").val();
          var pprice = $form.find(".pprice").val();
          var pimage = $form.find(".pimage").val();
          var pcode = $form.find(".pcode").val();

          var pqty = $form.find(".pqty").val();
          var pqtyad = $form.find(".pqtyad").val();

          $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
              pid: pid,
              pname: pname,
              pprice: pprice,
              pqty: pqty,
              pimage: pimage,
              pqtyad: pqtyad,
              pcode: pcode

            },
            success: function(response) {
              $("#message").html(response);
              window.scrollTo(0, 0);
              load_cart_item_number();
            }
          });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
          $.ajax({
            url: 'action.php',
            method: 'get',
            data: {
              cartItem: "cart_item"
            },
            success: function(response) {
              $("#cart-item").html(response);
            }
          });
        }
      });
    </script>

</body>

</html>