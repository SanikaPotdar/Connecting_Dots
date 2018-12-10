<?php 
  include('connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $req_id = $_GET['id'];
    $req_sql = "SELECT * FROM request WHERE req_id = $req_id";
    $req_result = $conn->query($req_sql);
    $client_sql = "SELECT client.first_name AS first_name,client.last_name AS last_name, client.address AS address, client.phone_num AS phone_num, request.req_id AS req_id FROM request INNER JOIN client ON request.client_id=client.client_id WHERE request.req_id=$req_id";
    $client_result = $conn->query($client_sql) or die($conn->error);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connecting Dots | Welcome</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/description.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Connecting</span> Dots</h1>
        </div>
        <nav>
          <ul>
            <li><a href="services.php">Services</a></li>
            <li><a href="status.php">Status</a></li>
            <li><a href="index.php">Sign Out</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="card">
      <?php
        $req_row = $req_result->fetch_assoc();
        $client_row = $client_result->fetch_assoc();
        echo '
        <span><h2>'.$req_row["job"].'</h2></span>
        <p class="price">Dates: '.$req_row["dates"].'</p>
        <hr>
        <p class="description">Client: '.$client_row["first_name"].' '.$client_row["last_name"].'</p>
        <p class="Cast">Address: '.$client_row["address"].'</p>
        <p class="Cast">Mobile: '.$client_row["phone_num"].'</p>
        <p><button><a style="color:#ffff;" href="apply.php?req_id='.$req_row["req_id"].'">Apply: <span class="rating">₹'.$req_row["budget"].'</span></a></button</p>'; 
      ?>
    <br>
    </div>
    <footer>
      <p>&copy; 2018 Connecting Dots</p>
    </footer>
  </body>
</html>
