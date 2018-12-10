<?php	
	$req_id = $_GET['req_id'];

	include('connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $update_status_sql = "UPDATE request SET status = 'COMPLETED' WHERE req_id=$req_id AND status='ONGOING'";
    $result=$conn->query($update_status_sql); 
    $conn->commit($result);  

    header("Location: status.php");
?>

