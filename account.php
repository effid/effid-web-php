<?php
  // Initialiser la session
session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["email"])){
	header("Location: login.php");
	exit(); 
}

$id_user = $_SESSION['id_user'];


$arrContextOptions=array(
	"ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
	),
);  

$response = file_get_contents("https://apollonian.fr:10000/users/".$id_user."", false, stream_context_create($arrContextOptions));
$json = json_decode($response);

foreach($json as $item) {
	$id_users = $item->id_user;
	$nom = $item->nom;
	$prenom = $item->prenom;
	$nom_classe = $item->nom_classe;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'css/style.php' ?>
</head>
<body>
	<?php include 'header.php' ?>
	<div class="box">
		<div class="one">
			<div class="form-group">
				<h3 style="text-align: center; margin: 2vh 0 5vh 0">GENERAL</h3>
			</div>
			<div class="form-group" >
				<div class="row" style="margin-bottom: 10vh">
					<label style="padding: 0 27vw 0 2vw">Nom</label>
					<input type="title" name="Nom" value="<?php echo $nom ?>"/>
				</div>
				<div class="row" style="margin-bottom: 10vh">
					<label style="padding: 0 26vw 0 2vw">Prénom</label>
					<input type="title" name="Prenom" value="<?php echo $prenom ?>"/>
				</div>
				<div class="row" style="margin-bottom: 10vh">
					<label style="padding: 0 26vw 0 2vw">Classe</label>
					<input type="title" name="Classe" value="<?php echo $nom_classe ?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="form-group">
					<h6>Privacy</h6>
				</div>
				<div class="row">
					<label style="padding: 0 26vw 0 2vw">Push Notifications</label>
					<input type="checkbox" name="Nom" value="<?php {} ?>"/>
				</div>
			</div>
		</div>
		<div class="two">
			<div class="form-group">
				<h3 style="text-align: center; margin: 2vh 0 5vh 0">Historique</h3>
			</div>
		</div>
	</div>
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