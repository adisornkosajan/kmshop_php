<?php
	$conn = new mysqli("localhost","root","","KMshop_db");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}

	mysqli_query( $conn, "SET NAMES UTF8" );
?>