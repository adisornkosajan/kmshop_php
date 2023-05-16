<?php
require 'config/db.php';

$grand_total = 0;
$allItems = '';
$items = [];
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price,qty,product_name FROM cart");
$stmt->execute();
$result1 = $stmt->fetchAll();
if (!$result1) {

} else {
  foreach ($result1 as $result) {
	$grand_total += $result['total_price'];
	$items[] = $result['ItemQty'];

	$product_qty_cart=$result['product_name'];
	$product_qty=$result['qty'];
  }
	
  }
 
$allItems = implode(', ', $items);

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

<body class="goto-here " style="background-color:#F1FCED;">
	<?php include 'index_nva.php';
	?>
	<div class="container">
	<div class="row justify-content-center">
					<div class="col-xl-7 ftco-animate">
						<form action="insert.php" method="post" enctype=multipart/form-data class="billing-form">
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
					<input type="hidden" name="order_date" value="<?= $today; ?>">
					<input type="hidden" name="product_qty_cart" value="<?= $product_qty_cart; ?>">
					<input type="hidden" name="qty" value="<?= $product_qty; ?>">

							<div class="row align-items-end">
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstname">ชื่อ</label>
										<input type="text" readonly value="<?php echo $row['firstname']; ?>" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastname">สกุล</label>
										<input type="text" readonly value="<?php echo $row['lastname']; ?>" class="form-control" placeholder="">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="streetaddress">อีเมล</label>
										<input type="text" readonly value="<?php echo $row['email']; ?>" class="form-control" placeholder="" name="email">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="streetaddress">เบอร์</label>
										<input type="text" readonly value="<?php echo $row['phone']; ?>" class="form-control" placeholder="" name="phone">
									</div>
								</div>
								
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="streetaddress">ที่อยู่</label>
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
									<h3 class="billing-heading mb-4">ตระกร้า</h3>
									<p class="d-flex">
										<span>สินค้า</span>
										<span><?= $allItems; ?></span>
									</p>
									

									<p class="d-flex">
										<span>ค่าส่ง</span>
										<?php
									if ($grand_total>=300){
										echo "<span>ฟรี</span>";
									}else{
										echo "<span>300</span>";
									}
									?>

									</p>
									<hr>
									<p class="d-flex total-price">
										<span>รวมราคาทั้งหมด</span>
										<?php
									if ($grand_total>=300){
										echo  number_format($grand_total, 2);
									}else{
										echo  number_format($grand_total+200, 2);
									}
									?>
									</p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select name="pmode" class="form-control">
										<option value="" selected disabled>-เลือกการชำระเงิน</option>
										<option value="เก็บเงินปลายทาง">เก็บเงินปลายทาง</option>
										<option value="netbanking">Net Banking </option>
									</select>
									<div class="radio">
                                            <label>
                                                <input type="radio" name="radAccountID" value="3356" style="margin-top: 10px;" checked="checked" />
                                                <span class="fl_l" style="margin-right: 5px; margin-top: 2px;">
                                                <img alt=""  src="img/ธนาคารกรุงไทย1.jpg" />
                                                </span>
                                                <span class="fl_l r0">
                                                    <span style="display: block;">
                                                        <span class="SpanBankName">ธนาคารกรุงไทย สาขาถนนเอื้ออารี                                                      </span>
                                                        <span class="mar5_t">
                                                            ประเภทบัญชี<span class="SpanAccountType"> ออมทรัพย์</span>
                                                        </span>
                                                    </span>
                                                    <span class="mar5_t" style="display: block;">
                                                        <span>
                                                            ชื่อบัญชี <span class="SpanAccountName">อดิศร โกษาจันทร์</span>
                                                        </span>
                                                        <span>
                                                            เลขที่บัญชี <span class="SpanAccountNo">881-0-49873-9</span>
                                                        </span>
														
                                                    </span>
                                                </span>
												<span style="color:red">
                                						** <span class="SpanAccountNo">สินค้าถึงลูกค้าแล้วต้องอัดวิดีโอก่อนเปิดสินค้าเท่านั้นเพื่อรักษาสิทธิ์ ลูกค้าหากไม่มีวิดีโอยืนยันทางร้านขอไม่รับผิดชอบทุกกรณี</span>
                            							</span>
                                            </label>
                                        </div>
										
							
							<div class="mb-3">
								<label for="img" class="col-form-label">รูป:</label>
								<input type="file" class="form-control" id="imgInput" name="orders_img">
							</div>
								</div>
							</div>
							

						

							
							<div class="form-group">
								<input type="submit" name="submit" value="ยืนยันการสั่งซื้อสินค้า" class="btn btn-outline-success py-3 px-4">
							</div>

	</form><!-- END -->
	</div>
	</div>
	</div>
	</div>

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
		let imgInput = document.getElementById('imgInput');
		let previewImg = document.getElementById('previewImg');

		imgInput.onchange = evt => {
			const [file] = imgInput.files;
			if (file) {
				previewImg.src = URL.createObjectURL(file)
			}
		}
	</script>
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