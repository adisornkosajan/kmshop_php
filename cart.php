<!DOCTYPE html>
<html lang="en">

<head>
	<title>cart</title>
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

<body class="goto-here" style="background-color:#F1FCED;">
	<?php include 'index_nva.php';

	?>

	<div class="hero-wrap hero-bread" style="background-image: url('images/tt81-1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-0 bread">My Cart</h1>
				</div>
			</div>
		</div>
	</div>
	
	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead>
								<tr>
									<th></th>
									<th>รูป</th>
									<th>สินค้า</th>
									<th>ราคา</th>
									<th>จำนวนต้น</th>
									<th>ราคาทั้งหมด</th>
									<th>
										
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								require 'config/config.php';
								$stmt = $conn->prepare('SELECT * FROM cart');
								$stmt->execute();
								$result = $stmt->get_result();
								$grand_total = 0;
								while ($row = $result->fetch_assoc()) :
								?>
									<tr>
										<td></td>
										<input type="hidden" class="pid" value="<?= $row['id'] ?>">
										<input type="hidden" class="pid" value="<?= $row['qty'] ?>">
										<td><img src="admin/uploads/<?= $row['product_image'] ?>" width="50"></td>
										<td><?= $row['product_name'] ?></td>
										<td>
											</i>&nbsp;&nbsp;<?= number_format($row['product_price'], 2); ?> บาท
										</td>
										<input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
										<td>
											</i>&nbsp;&nbsp;<?= number_format($row['qty']); ?>&nbsp;&nbsp;&nbsp;&nbsp;ต้น
										</td>
										
										<td></i>&nbsp;&nbsp;<?= number_format($row['total_price'], 2); ?> บาท</td>
										<td>
											<a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('คุณต้องการถอนสินค้าในตะกร้าใช่หรือไม่');"><i class="icon-shopping_cart"></i></a>
										</td>
										
									</tr>
									<?php $grand_total += $row['total_price']; ?>
								<?php endwhile; ?>
								<tr>
									<td colspan="3">
									
									</td>
									<td colspan="2"><b>รวมทั้งสิ้น</b></td>
									<td><b></i>&nbsp;&nbsp;<?= number_format($grand_total, 2); ?> บาท</b></td>
									
									<td>
										<a href="checkout.php" class="btn btn-outline-info"><i class="far fa-credit-card"></i>&nbsp;&nbsp;จ่ายเงิน</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</section>


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