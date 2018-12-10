<?php
	session_start();	
	$req_id = $_GET['req_id'];
	$professional_id=$_SESSION[id];

	include('connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
    $insert_query = "INSERT IGNORE INTO professional_request_records (professional_id, Req_id) VALUES ($professional_id, $req_id)";
    $conn->query($insert_query);
    
    $update_status_sql = "UPDATE request SET status = 'ONGOING' WHERE req_id=$req_id";
	$conn->query($update_status_sql);

   header("Location: status.php");
?>