<?php
session_start();

ob_start();
  // Initialiser la session
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["email"])){
  header("Location: login.php");
  exit(); 
}
if(!isset($_GET["id_salle"]) || !isset($_GET["numero"])){
  header("Location: index.php");
  exit(); 
}

$id_salle = $_GET["id_salle"];
$numero = $_GET["numero"];
$dateValue = $_GET['date'];
$debutValue = $_GET['heure_debut']; 
$finValue = $_GET['heure_fin']; 


$arrContextOptions=array(
  "ssl"=>array(
    "verify_peer"=>false,
    "verify_peer_name"=>false,
  ),
);

$response = file_get_contents("https://api:10000/salles/".$id_salle."", false, stream_context_create($arrContextOptions));
$json = json_decode($response);

foreach($json as $item)
{
  $capacite = $item->capacite;
}

$today = date('Y-m-d');

if (isset($_REQUEST['Date'], $_REQUEST['nombresPersonnes'], $_REQUEST['debut'], $_REQUEST['fin'], $_REQUEST['intitule'])){

  $date = $_REQUEST['Date'];
  $nbPersonnes = $_REQUEST['nombresPersonnes'];
  $debut = $_REQUEST['debut'];
  $fin = $_REQUEST['fin'];
  $intitule = $_REQUEST['intitule'];
  $id_salle = $_REQUEST['id_salle'];
  $numero = $_REQUEST['numero'];

  $response = array('id_user' => $_SESSION['id_user'], 'date' => $date, "heure_debut" => $debut, "heure_fin" => $fin, "intitule" => $intitule, "nb_personnes" => $nbPersonnes, "id_salle" => $id_salle, "id_prof" => NULL);
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
  $result = file_get_contents('https://api:10000/reservations', false, $context);
  if($result){
    header("Location: index.php");
    exit(); 
  }
  ob_end_flush();
}
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
          <h3 style="text-align: center; margin: 2vh 0 5vh 0">Salle : <?php echo $numero ?> </h3>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label>Date: </label>
            <input type="Date" name="Date" value="<?php echo $dateValue ?>" min="<?php echo $dateValue ?>" class="form-control" readonly> 
          </div>
          <div class="form-group col-6">
            <label>Nombre de Personnes: </label>
            <input type="number" name="nombresPersonnes" class="form-control" min="1" max="<?php echo $capacite ?>"> 
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label>Heure de début : </label>
            <input type="time" name="debut" class="form-control" value="<?php echo $debutValue ?>" readonly> 
          </div> 
          <div class="form-group col-6">
            <label>Heure de fin : </label>
            <input type="time" name="fin" class="form-control" value="<?php echo $finValue ?>" readonly> 
          </div>
        </div>
        <div class="row">
          <div class="form-group col-6">
            <label>Intitulé</label>
            <input type="text" name="intitule" class="form-control"> 
            <input type="text" name="numero" class="form-control" value="<?php echo $numero ?>" hidden> 
            <input type="text" name="id_salle" class="form-control" value="<?php echo $id_salle ?>" hidden> 
          </div>
        </div>         
      </div>
      <div class="buttonCentre">
        <button style="color: white; text-align: center;">
          Réserver
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