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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
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


	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
					<h1 class="mb-0 bread">Checkout</h1>
				</div>
			</div>
		</div>
	</div>
	<form>


		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-7 ftco-animate">
						<form action="insert.php" method="post" enctype=multipart/form-data class="billing-form">
							<h3 class="mb-4 billing-heading">Billing Details</h3>
							<?php
							$orders_user_id = $row['id'];
							$orders_user_id = $row['id'];
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
					$email = $row['email'];
					$phone = $row['phone'];
					$address = $row['address'];
							?>
							<input type="hidden" name="orders_user_id" value="<?= $orders_user_id; ?>">
					<input type="hidden" name="products" value="<?= $allItems; ?>">
					<input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
					<input type="hidden" name="name" value="<?= $firstname . ' ' . $lastname; ?>">
							<div class="row align-items-end">
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstname">Firt Name</label>
										<input type="text" readonly value="<?php echo $row['firstname']; ?>" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastname">Last Name</label>
										<input type="text" readonly value="<?php echo $row['lastname']; ?>" class="form-control" placeholder="">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="streetaddress">email</label>
										<input type="text" readonly value="<?php echo $row['email']; ?>" class="form-control" placeholder="" name="email">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" readonly value="<?php echo $row['phone']; ?>" class="form-control" placeholder="" name="phone">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="streetaddress">email</label>
										<input type="text" readonly value="<?php echo $row['address']; ?>" class="form-control" placeholder="" name="address">
									</div>
								</div>
								<div class="w-100"></div>
							</div>

					</div>
					<div class="col-xl-5">
						<div class="row mt-5 pt-3">
							<div class="col-md-12 d-flex mb-5">
								<div class="cart-detail cart-total p-3 p-md-4">
									<h3 class="billing-heading mb-4">Cart Total</h3>
									<p class="d-flex">
										<span>Product</span>
										<span><?= $allItems; ?></span>
									</p>

									<p class="d-flex">
										<span>Delivery</span>
										<span>Free</span>
									</p>
									<hr>
									<p class="d-flex total-price">
										<span>Total</span>
										<span><?= number_format($grand_total, 2) ?></span>
									</p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select name="pmode" class="form-control">
										<option value="" selected disabled>-เลือกการชำระเงิน</option>
										<option value="cod">เก็บเงินปลายทาง</option>
										<option value="netbanking">Net Banking</option>
									</select>
								</div>
							</div>
							<div class="mb-3">
								<label for="img" class="col-form-label">Image:</label>
								<input type="file" class="form-control" id="imgInput" name="orders_img">
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="submit" class="btn btn-primary py-3 px-4">
							</div>

	</form><!-- END -->
	</div>
	</div>
	</div>
	</div> <!-- .col-md-8 -->
	</div>
	</div>
	</section> <!-- .section -->
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

	<script>
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

</body>

</html>