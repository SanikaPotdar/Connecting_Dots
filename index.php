<?php include('connection.php');
  
  $message = "";

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  session_start();

  if(isset($_POST['login'])){
    $email = $_POST["email"];
    $pass = $_POST["pwd"];

    $sql = "SELECT * FROM service_professional WHERE email='$email' AND password='$pass'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
    	$row2 = $result->fetch_assoc();
		$_SESSION[id] = $row2["professional_id"];
      header("Location: services.php");
      exit();
    }     
    else {
      $message = "Login Failed";
    }
  }
  

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connecting Dots | Welcome</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
    .login-div{
      background-color: rgba(240, 240, 240, 0.8);
      padding: 0;
      width: 30%;
      margin: auto;
      margin-top: 20vh;
      margin-bottom: 25vh;
    }
    .login-btn {
      width: 180px;
      padding: 0.5em;
      margin: auto;
      display: block;
      align-self: center;
      margin-top: 4em;
      background-color: orangered;
      color:white;
    }
    .container{
      padding-left: 54px;
      padding-top: 9px;
      padding-bottom: 30px;
      min-height: 75px;
    }
    body{
      background: URL(images/studio_bg.jpg);
    }
    a {
      text-decoration: none !important;
    }
    </style>
  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Connecting</span> Dots</h1>
        </div>
        <nav>
          <ul>
            <li class="current"><a href="index.php">Sign In</a></li>
            <li><a href="register.php">Sign Up</a></li>
            <li><a href="index.php">Status</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="row login-div">
        <form action="" style="border-right:2px solid #DDDDDD; padding: 2em;" method="POST">
          <h1 class="text-center"><span style="color:tomato;">Sign In</span> Here</h1>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Email...">
          </div>
          <div class="form-group">
            <label for="pwd">Password</label>
            <input class="form-control" type="password" name="pwd" id="pwd" placeholder="Password...">
          </div>
          <div class="form-group text-center">
            <label for="message">
              <h3 style="color: #35424a">
                <?php echo $message; ?>
              </h3>
            </label>
          </div>
          <button type="submit" class="btn login-btn" name="login">Sign In</button><br>
          <a style="color:tomato; text-decoration:none;" href="register.php"><p align="center"> Haven't registered? Sign Up here.</p></a>
        </form>       
    </section>

    <footer>
      <p>&copy; 2018 Connecting Dots</p>
    </footer>
  </body>
</html>
