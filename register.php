<?php include('connection.php');
  
  $message = "";

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  if(isset($_POST['register'])){
    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $pass = $_POST["pwd"];
    $sql = "SELECT * FROM user WHERE name='$name'";

    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      $message = "User already Exists";    
    }     
    else {
      $sql = "SELECT professional_id FROM service_professional  
              ORDER BY professional_id DESC  
              LIMIT 1; ";
      
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {    
        $row = $result->fetch_assoc();
        $professional_id = $row['professional_id'] + 1;
        $sql = "INSERT INTO service_professional VALUES($professional_id,'$name','$address','$contact','$email','$pass')";
        if($conn->query($sql) == True) {
          $message = "Registered Successfully";
        }
        else {
          $message = "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      header("Location: index.php");
      exit();
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
            <li><a href="index.php">Sign In</a></li>
            <li class="current"><a href="register.php">Sign Up</a></li>
            <li><a href="index.php">Status</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="row login-div">
        <form action="" style="border-right:2px solid #DDDDDD; padding: 2em;" method="POST">
          <h1 class="text-center"><span style="color:tomato;">Sign Up</span> Here</h1>
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" id="name" placeholder="Your name...">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input class="form-control" name="address" id="address" placeholder="Address...">
          </div>
          <div class="form-group">
            <label for="contact">Contact number</label>
            <input class="form-control" name="contact" id="contact" placeholder="Contact number...">
          </div>
          <div class="form-group">
            <label for="email">Email id</label>
            <input class="form-control" name="email" id="email" placeholder="Email id...">
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
          <button type="submit" class="btn login-btn" name="register">Sign Up</button><br>
          <a style="color:orangered; text-decoration:none;" href="index.php"><p align="center"> Already registered? Sign in here.</p></a>
        </form>
    </section>

    <footer>
      <p>&copy; 2018 Connecting Dots</p>
    </footer>
  </body>
</html>
