<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connecting Dots | Welcome</title>
    <link rel="stylesheet" href="./css/special_events.css">
    <link rel="stylesheet" href="./css/style.css">

  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Connecting</span> Dots</h1>
        </div>
        <nav>
          <ul>
            <li class="current"><a href="services.php">Services</a></li>
            <li><a href="status.php">Status</a></li>
            <li><a href="index.php">Sign Out</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section>
        <ul class="cards">
          <?php include('connection.php');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                session_start();

                $sql = "SELECT * FROM request WHERE status='NEW'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo'<li class="cards__item">
                          <div class="card">
                          <div class="card__content">
                              <div class="card__title"><a style="color:inherit; text-decoration:none;" href="description.php?id='.$row["req_id"].'">'.$row["job"].'</a></div>
                              <p class="card__text">'.$row["description"].'</p>
                          </div>
                          </div>
                      </li>';
                    }
                }
                else{
                  echo'<div class="card" style="display:block; margin:auto; margin-top:2em;">
                    <div class="card__image card__image--end"></div>
                    <div class="card__content">
                        <div class="card__title">No more requests</div>
                        <p class="card__text">There are no client requests right now, check in after a while.</p>
                        
                    </div>
                    </div>';
                } 
            ?>
        </ul>
    </section>

    <footer>
      <p>&copy; 2018 Connecting Dots</p>
    </footer>
  </body>
</html>