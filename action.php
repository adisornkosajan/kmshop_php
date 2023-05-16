<?php
	session_start();
	require 'config/config.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $pqtyad = $_POST['pqtyad'];
	  $total_price = $pprice * $pqty;
	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';

	  $query1 = $conn->prepare("UPDATE product SET product_qty_add = product_qty_add - $pqty WHERE `product_name` = '$pname' ");
	  $query1->execute();

		


	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code,product_qty_cart) VALUES (?,?,?,?,?,?,?)');
	    $query->bind_param('sssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode,$pqtyad);
	    $query->execute();
	  } else {

	  }
	  header('location.reload()');
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	    $stmt = $conn->prepare('SELECT * FROM cart WHERE id=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$ra= $result->fetch_assoc();
		$product_name = $ra['product_name'];
		$qty = $ra['qty'];

	  $query1 = $conn->prepare("UPDATE product SET product_qty_add = product_qty_add + $qty WHERE `product_name` = '$product_name' ");
	  $query1->execute();

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
		$id = $_GET['clear'];
		
		$stmt = $conn->prepare('SELECT * FROM cart WHERE id=?');
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$ra= $result->fetch_assoc();
		$product_name = $ra['product_name'];
		$qty = $ra['qty'];

	  $query1 = $conn->prepare("UPDATE product SET product_qty_add = product_qty_add + $qty WHERE `product_name` = '$product_name' ");
	  $query1->execute();

	
	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}
	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $pmode = $_POST['pmode'];
	  $filename = $_FILES["uploadfile"];
	  $folder = "/checkout" . $filename;
	  $data = '';

  		
	  $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid,uploadfile)VALUES(?,?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total,$filename);

	  $stmt->execute();
	  $stmt2 = $conn->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
	  echo $data;
	}
