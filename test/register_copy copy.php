<?php

session_start();
require_once 'config/db.php';

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">สมัครสมาชิก</h3>
						<form action="signup_db.php" method="post" class="signin-form">
							<?php if (isset($_SESSION['error'])) { ?>
								<div class="alert alert-danger" role="alert">
									<?php
									echo $_SESSION['error'];
									unset($_SESSION['error']);
									?>
								</div>
							<?php } ?>
							<?php if (isset($_SESSION['success'])) { ?>
								<div class="alert alert-success" role="alert">
									<?php
									echo $_SESSION['success'];
									unset($_SESSION['success']);
									?>
								</div>
							<?php } ?>
							<?php if (isset($_SESSION['warning'])) { ?>
								<div class="alert alert-warning" role="alert">
									<?php
									echo $_SESSION['warning'];
									unset($_SESSION['warning']);
									?>
								</div>
							<?php } ?>
							<div class="form-group">
								<input type="text" class="form-control" name="firstname" aria-describedby="firstname" placeholder="firstname">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="lastname" aria-describedby="lastname" placeholder="lastname">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Email" required input type="email" name="email" aria-describedby="email">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="phone" required input type="phone" name="phone">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="ที่อยู่"  name="address">
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="text" class="form-control form-control-user"  placeholder="ตำบล" name="amphures">
								</div>
								<div class="col-sm-6">
									<input type="text" class="form-control form-control-user"  placeholder="อำเภอ" name="district">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="text" class="form-control form-control-user"  placeholder="จังหวัด" name="province">
								</div>
								<div class="col-sm-6">
									<input type="text" class="form-control form-control-user"  placeholder="รหัสไปรษณีย์" name="zip_code">
								</div>
							</div>
							<div class="form-group">
								<input id="password-field" name="password" type="password" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-group">
								<input id="password-field" name="c_password" type="password" class="form-control" placeholder="Confirm Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3" name="signup">Sign Up</button>
							</div>
							<p>เป็นสมาชิกแล้วใช่ไหม คลิ๊กที่นี่เพื่อ <a href="signin.php">เข้าสู่ระบบ</a></p>
							<div class="form-group d-md-flex">

								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div>
							</div>
						</form>


					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>