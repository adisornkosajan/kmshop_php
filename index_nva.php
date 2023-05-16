<?php 
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}

?>
<?php 

if (isset($_SESSION['user_login'])) {
	$user_id = $_SESSION['user_login'];
	$stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
}
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">KMshop</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link" ><font size="2">หน้าแรก</font></a></li>
			  <li class="nav-item active"><a href="shop.php?page=1" class="nav-link"><font size="2">ร้านค้า</font></a></li>
	          <li class="nav-item"><a href="contact.php" class="nav-link"><font size="2">ดูรีวิวเกี่ยวกับร้านเรา</font></a></li>
			  <li class="nav-item"><a href="product_ status.php" class="nav-link"><font size="2">สถานะการจัดส่ง</font></a></li>
			  <li class="nav-item"><a href="user.php" class="nav-link"><font size="2">ข้อมูลส่วนตัว</font></a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><font size="3"><span id="cart-item" class="icon-shopping_cart" ></font></span></a></li>
			  <li class="nav-item"><a class="nav-link" href="logout.php"><font size="3"><i class="fas fa-sign-out-alt mr-2"></i></font></a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>

	  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	  <body class="goto-here" style="background-color:#F8FFF4;" >


	  