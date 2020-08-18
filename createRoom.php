<?php
  // Initialiser la session
session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["email"])){
	if(!isset($_SESSION["id"])){
		header("Location: index.php");
		exit(); 
	}
	header("Location: login.php");
	exit(); 
}

if (isset($_REQUEST['Numero'], $_REQUEST['Etage'], $_REQUEST['Type'], $_REQUEST['Capacite'])){

	$Numero = $_REQUEST['Numero']; 
	$Etage = $_REQUEST['Etage'];
	$Type = $_REQUEST['Type'];
	$Capacite = $_REQUEST['Capacite'];


  //TODO: Voir comment récuperer id_user
	$response = array('numero_salle' => $Numero, 'etage' => $Etage, 'type' => $Type, 'occupee' => 0, 'capacite' => $Capacite);

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
	$result = file_get_contents('http://api/salles', false, $context);
	if($result){
		header("Location: admin.php");
		exit(); 
	}
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
					<h3 style="text-align: center; margin: 2vh 0 5vh 0">Création des salles</h3>
				</div>

				<div class="row">
					<div class="form-group col-6">
						<label>Numero Salle: </label>
						<input type="text" name="Numero" class="form-control"> 
					</div>
					<div class="form-group col-6">
						<label>Etage: </label>
						<input type="number" name="Etage" class="form-control" > 
					</div>
				</div>
				<div class="row">
					<div class="form-group col-6">
						<label>Type: </label>
						<select type="text" name="Type" class="form-control">
							<option value="Classique">Classique</option>
							<option value="Informatique">Informatique</option>
						</select>
					</div>
					<div class="form-group col-6">
						<label>Capacité: </label>
						<input type="number" name="Capacite" class="form-control"> 
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