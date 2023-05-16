<?php
	session_start();
	require 'config/db.php';

	  if (isset($_POST['btn_insert'])) {
		$id = $_POST['id'];
		$productqty = $_POST['product_qty_add'];



			  $stmt = $conn->prepare("UPDATE product SET product_qty_add = product_qty_add + $productqty WHERE `id` = '$id' ");
            	$stmt->execute();


					if ($stmt) {
						$_SESSION['success'] = "Data has been inserted successfully";
						header("location: product.php");
					} else {
						$_SESSION['error'] = "Data has not been inserted successfully";
						header("location: product.php");
					}
	  
			 

		
	  }

	  
	
?>

