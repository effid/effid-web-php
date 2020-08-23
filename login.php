<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'css/style.php' ?>
</head>
<body>
  <?php 
  require('db/config.php');
  if (isset($_POST['email'])){
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE email='$email' and password='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    $query2 = "SELECT * FROM `users` WHERE email='$email'";    
    $reponse = $conn->query($query2);
    while ($donnees = $reponse->fetch_assoc())
    {
      $_SESSION['id_user'] = $donnees['id_user'];
    }
    if($rows==1){
      $_SESSION['email'] = $email;
      header("Location: index.php");
    }else{
      $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
  }
  ?>
  <div class="limiter">
    <div class="container-login100" style="background-image: url('pictures/background.jpeg');">
      <div class="wrap-login100">  
        <form class="login100-form validate-form" action="" method="post" name="login">
          <div class="container-login100-form-btn p-b-34 p-t-27">
            <img class="logo2" src="pictures/Logo_blanc.png"/>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Enter an email">
            <input class="input100" type="email" name="email" placeholder="Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
          </div>

          <?php if (! empty($message)) { ?>
            <p class="txt-danger"><?php echo $message; ?></p>
          <?php }  echo "<br/>"; ob_end_flush();?>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Connexion
            </button>
          </div>

          <div class="text-center p-t-90">
            <!--<a class="txt1" href="#">
              Forgot Password?
            </a>-->
            <p class="text-center txt1">Vous êtes nouveau ici ? <a class="txt1" href="register.php">S'inscrire</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="dropDownSelect1"></div>
  
  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>
</body>
</html>