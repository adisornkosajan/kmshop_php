<!DOCTYPE html>
<html lang="en">

<head>
	<title>รายละเอียด</title>
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
	<section class="ftco-section">
		<div class="container">
			<div id="message"></div>
			<div class="row mt-2 pb-3">
			<form action="" class="form-submit">
					<?php
					include 'config/config.php';
					$id = $_GET['id'];
					$stmt = $conn->prepare("SELECT * FROM product WHERE id = $id");
					$stmt->execute();
					$result = $stmt->get_result();
					while ($row = $result->fetch_assoc()) :
					?>

						<input type="hidden" class="form-control pqty" value="<?= $row['product_qty'] ?>">
						<input type="hidden" class="pid" value="<?= $row['id'] ?>">
						<input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
						<input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
						<input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
						<input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
						<input type="hidden" class="pqtyad" value="<?= $row['product_qty_cart'] ?>">
						<div class="col-lg-6 mb-5 ftco-animate">
							<a href="" width="100%" class="image-popup" img src="admin/uploads/<?= $row['product_image'] ?>" ><img src="admin/uploads/<?= $row['product_image'] ?>" width="100%"  ></a>
							<!--< รูปเล็กลง a href="" class="image-popup"><img src="" class="img-fluid" alt="Colorlib Template"></>-->
						</div>
						<div class="col-lg-6 product-details pl-md-5 ftco-animate">
							<h3><?= $row['product_name'] ?></h3>
							
							<p class="price"><span><?= number_format($row['product_price'], 2) ?>/บาท</span></p>
							<p><?= $row['description'] ?></p>
							<a href="shop.php?page=1" class="btn"><i class="buy-now d-flex justify-content-center align-items-center mx-1"></i>&nbsp;&nbsp;กลับหน้าร้านค้า</a>
							<?php if ($row['product_qty_add'] == "0") {
                                echo "<td><span >สินค้าหมด</span></td>";
                            } else {
                              ?>
                                <button class="btn  addItemBtn"><i class="buy-now d-flex justify-content-center align-items-center mx-1"></i>&nbsp;&nbsp;เพิ่มสินค้า</button>
                            <?php }
                            ?>
							
						</div>
						 
				</form>
			</div>
		</div>
		</div>

	<?php endwhile; ?>
	</div>
	</div>
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
	<script>
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