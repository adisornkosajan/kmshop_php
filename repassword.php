<?php 

    session_start();
    ;

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css1/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(images/tt87-1.jpg);">
	<section class="ftco-section" style="padding:21em ;">
		<div class="container">
						<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center" style="color:#44CB3C">ลืมรหัสผ่าน</h3>
				  <form action="repassword_db.php" method="post" class="signin-form">
				  <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
					</div>
            <?php } ?>
		      		<div class="form-group">
		      			<input type="text" class="form-control" placeholder="Email" required input type="email" name="email" aria-describedby="email" >
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" placeholder="Password"  name="password"required>
	              
	            </div>
				<div class="form-group">
								<input id="password-field" name="c_password" type="password" class="form-control" placeholder="Confirm Password" required>
							</div>
	            <div class="form-group">

	            	<button type="submit" class="form-control btn btn-dark submit px-3" name="signin" >ยืนยัน</button>
					<br>
					
	            </div>
	          </form>
		      </div>
			  <a  class="form-control btn btn-dark submit px-3" href="signin.php" >กลับ</a>
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

