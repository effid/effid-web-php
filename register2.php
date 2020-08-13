    <div class="limiter">
      <div class="container-login100" style="background-image: url('pictures/background.jpeg');">
        <div class="wrap-login100">  
          <form class="login100-form validate-form" action="" method="post" name="login">
            <div class="container-login100-form-btn p-b-34 p-t-27">
              <img class="logo" src="pictures/Logo_blanc.png"/>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter a first name">
              <input class="input100" type="text" name="prenom" placeholder="First Name">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter a last name">
              <input class="input100" type="text" name="nom" placeholder="First name">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter an email">
              <input class="input100" type="email" name="email" placeholder="Email">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <input class="input100" type="password" name="password" placeholder="Password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Confirm your password">
              <input class="input100" type="password" name="passwordConfirmation" placeholder="Confirm  Password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn">
                Register
              </button>
            </div>

            <div class="text-center p-t-30">              
              <?php if (! empty($message)) { ?>
                <p class="txt-danger"><?php echo $message; ?></p>
              <?php } ?>
            </div>
            <div class="text-center p-t-90">
              <p class="txt1">Déjà inscrit? <a class="txt1" href="login.php">Connectez-vous ici</a></p>
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