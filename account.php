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
				<hr>
			</div>
			<div class="form-group" >
				<div class="row" style="margin: 5vh 0 5vh 0">
					<label style="padding: 0 27.25vw 0 2vw">Nom</label>
					<input type="title" name="Nom" value="<?php echo $nom ?>" style="color:#A12F6F" readonly/>
				</div>
				<hr/>
				<div class="row" style="margin: 5vh 0 5vh 0">
					<label style="padding: 0 26vw 0 2vw">Prénom</label>
					<input type="title" name="Prenom" value="<?php echo $prenom ?>" style="color:#A12F6F" readonly/>
				</div>
				<hr/>
				<div class="row" style="margin: 5vh 0 5vh 0">
					<label style="padding: 0 26vw 0 2vw">Classe</label>
					<input type="title" name="Classe" value="<?php echo $nom_classe ?>" style="color:#A12F6F" readonly/>
				</div>
				<hr/>
			</div>
		</div>
		<div class="two">
			<div class="form-group">
				<h3 style="text-align: center; margin: 2vh 0 5vh 0">Historique</h3>
				<hr>
			</div>
			<?php 
			$arrContextOptions=array(
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);  

			$response = file_get_contents("https://apollonian.fr:10000/validations/user/".$id_user."", false, stream_context_create($arrContextOptions));
			$json = json_decode($response);

			foreach($json as $item) {
				$numero_salle = $item->numero_salle;
				$date = $item->date;
				$intitule = $item->intitule;
				$date= DateTime::createFromFormat('Y-m-d\TH:i:s+',$date)->format('Y-m-d');
				echo '<div class="form-group" style="margin-left: 5vw">';
				echo '<div class="row" >';
				echo "Salle <input type='title' name='Nom' value=' {$numero_salle}' readonly/>";
				echo "<input type='title' name='Prenom' value='{$date}' style='padding-left: 15vw; color: grey; opacity: 75%' readonly/>";
				echo '</div>';
				echo '<div class="row" style="margin: 0 0 5vh 2vw;">';
				echo "<input type='title' name='Classe' value='$intitule' style='color: grey;' readonly/>";
				echo '</div>';
				echo '</div>';
				echo "<hr/>";
			}
			?>
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