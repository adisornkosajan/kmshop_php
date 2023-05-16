<?php
require 'config/config.php';

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $grand_total += $row['total_price'];
  $items[] = $row['ItemQty'];
}
$allItems = implode(', ', $items);

if (isset($_REQUEST['delete_id'])) {
  $id = $_REQUEST['delete_id'];

  $select_stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
  $select_stmt->bindParam(':id', $id);
  $select_stmt->execute();
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

  // Delete an original record from db
  $delete_stmt = $db->prepare('DELETE FROM users WHERE id = :id');
  $delete_stmt->bindParam(':id', $id);
  $delete_stmt->execute();

  header('Location:user.php');
}

?>

<head>
  <title>KMshop</title>
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
  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row d-flex mb-10 contact-info">
        <div class="w-1000"></div>
        <div class="col-md-3000 d-flex">
          <div class="info bg-white p-4">
            <tbody>
              <div class="row">
                <div class="col-md-1000 order-md-10">
                  <td width="150px"><img class="rounded" width="40%" src="uploads/<?php echo $row['img']; ?>" alt="">
                    <form class="needs-validation" novalidate="">
                      <div class="row">
                        <div class="col-md-4 mb-1">
                          <label for="firstName">ชื่อ</label>
                          <h4 class="mb-3"><?php echo $row['firstname']; ?></h4>
                        </div>
                        <div class="col-md-4 mb-1">
                          <label for="lastName">สกุล</label>
                          <h4 class="mb-3"><?php echo $row['lastname']; ?></h4>
                          <div class="invalid-feedback">
                          </div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="email">เบอร์โทรศัพท์ <span class="text-muted"></span></label>
                        <h4 class="mb-3"><?php echo $row['phone'] ?></h4>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="email">อีเมล </label>
                        <h4 class="mb-3"><?php echo $row['email'] ?></h4>
                        <div class="invalid-feedback">
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="address">ที่อยู่</label>
                        <h4 class="mb-3"><?php echo $row['address'] ?></h4>

                        <div class="invalid-feedback">
                          Please enter your shipping address.
                        </div>
                      </div>
                      <?php

                      ?>
                  <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning">แก้ไขข้อมูล</a>
                    
                  </td>
                  </tr>
                  </form>
                </div>
              </div>
            </tbody>
          </div>
        </div>
      </div>
  </section>























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
  <script type="text/javascript">
    $(document).ready(function() {

      // Sending Form data to the server
      $("#placeOrder").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: 'action.php',
          method: 'post',
          data: $('form').serialize() + "&action=order",
          success: function(response) {
            $("#order").html(response);
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