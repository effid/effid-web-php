<?php
  // Initialiser la session
session_start();
ob_start();

  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["email"])){
  if(!isset($_SESSION["id"])){
    header("Location: index.php");
    exit(); 
  }
  header("Location: login.php");
  exit(); 
}

if (isset($_REQUEST['Nom'], $_REQUEST['Effectifs'])){

  $nom = $_REQUEST['Nom']; 
  $effectifs = $_REQUEST['Effectifs'];

  //TODO: Voir comment récuperer id_user
  $response = array('nom' => $nom, 'effectif' => $effectifs);

  $postString = http_build_query($response, '', '&');

  $opts = array(
    "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
    ),
    'http' =>
    array(
      'method'  => 'POST',
      'header'  => 'Content-type: application/x-www-form-urlencoded',
      'content' =>  $postString
    )
  );

# Create the context
  $context = stream_context_create($opts);
# Get the response (you can use this for GET)
  $result = file_get_contents('https://api:10000/classes', false, $context);
  if($result){
    header("Location: admin.php");
    exit(); 
  }
}
ob_end_flush();

?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'css/style.php'; ?>
</head>
<body>
  <?php include 'header.php'; ?>
  <form>
    <div class="sucess">
      <div class="centre">
        <div class="form-group">
          <h3 style="text-align: center; margin: 2vh 0 5vh 0">Création des classes</h3>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label>Nom: </label>
            <input type="text" name="Nom" class="form-control"> 
          </div>
          <div class="form-group col-6">
            <label>Effectifs: </label>
            <input type="number" name="Effectifs" class="form-control"> 
          </div>
        </div>
        
      </div>
      <div class="buttonCentre">
        <button style="color: white; text-align: center;">
          Register
        </button>
      </div>
    </div>
  </form>

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