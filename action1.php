<?php
	session_start();
	require 'config/db.php';

	  if (isset($_POST['btn_insert'])) {
		$id = $_POST['id'];
		$status ='5';
		  $petition = $_POST['petition'];

			  $stmt = $conn->prepare("UPDATE orders SET status ='5' WHERE id=$id");
	  			$stmt->execute();

				  $stmt = $conn->prepare("INSERT INTO can_claim(status,petition,order_id) VALUES (:status,:petition,:order_id)");
				  $stmt->bindParam(":petition", $petition);
				  $stmt->bindParam(":status", $status);
				  $stmt->bindParam(":order_id", $id);
					$stmt->execute();

					
					if ($stmt) {
						$_SESSION['success'] = "Data has been inserted successfully";
						header("location: product_ status.php");
					} else {
						$_SESSION['error'] = "Data has not been inserted successfully";
						header("location: product_ status.php");
					}
	  
			 

		
	  }

	  
	
?>

