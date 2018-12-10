<?php 
  include('connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    session_start();
    $req_sql = "SELECT * FROM request";
    $req_result = $conn->query($req_sql);
    $status_sql = "SELECT request.req_id, request.dates, request.job, client.address, request.description, request.budget, request.status FROM request INNER JOIN professional_request_records ON professional_request_records.Req_id = request.req_id INNER JOIN client ON request.client_id = client.client_id WHERE professional_request_records.professional_id=$_SESSION[id]";
    $status_result = $conn->query($status_sql) or die($conn->error);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connecting Dots | Welcome</title>
    <link rel="stylesheet" href="./css/style.css">
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
            <li class="current"><a href="status.php">Status</a></li>
            <li><a href="index.php">Sign Out</a></li>
          </ul>
        </nav>
      </div>
    </header>  
    <div class="container-fluid" id="content" style="padding-bottom: 305px; padding-top: 10px">      
    <div class="max-width-container">
        <div class="table-responsive" style="overflow: visible;">
            <table class="table table-striped" id="application-table">
                <thead>
                    <tr height="50px">
                        <th>Date</th>
                        <th>Job</th>
                        <th>Place</th>
                        <th>Job requirement</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                if ($req_result->num_rows > 0) {
                    while($req_row = $req_result->fetch_assoc() && $status_row = $status_result->fetch_assoc()) {
                        echo '
                        <tbody id="applications_tbody">
                            <tr height="50px">
                                <td class="hidden-xs">'.$status_row["dates"].'</td>
                                <td style="overflow: hidden"> '.$status_row["job"].' </td>
                                <td style="overflow: hidden;">'.$status_row["address"].'</td>
                                <td>
                                    <div class="tooltiptextcontainer" aria-hidden="true">'.$status_row["description"].'</div>
                                </td>
                                <td>'.$status_row["budget"].'</td>
                                <td>'.$status_row["status"].'</td>';

                                if($status_row["status"] == 'ONGOING')
                                    echo '<td><button><a href="complete.php?req_id='.$status_row["req_id"].'">Completed</a></button>';
                                else
                                    echo '<td> </td>';

                                echo '
                            </tr>
                        </tbody>
                        ';
                    }
                }
                ?>
            </table>
        </div>
    </div> </div>
    <footer>
      <p>&copy; 2018 Connecting Dots</p>
    </footer>
  </body>
</html>
