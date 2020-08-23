<?php
  // Initialiser la session
session_start();
ob_start();

  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["email"])){
	header("Location: login.php");
	exit(); 
}

if(!empty($_GET['id_reservation'])) {

	$response = array('id_user' => $_SESSION['id_user'], 'etat' => 1);
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
	$result = file_get_contents("https://api:10000/reservations/validation/".$_GET['id_reservation']."", false, $context);
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
	<?php require('css/style.php'); ?>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="sucess">
		<div class="centre">
			<?php
			$arrContextOptions=array(
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);  

			$response = file_get_contents("https://api:10000/reservations/attente", false, stream_context_create($arrContextOptions));
			$json = json_decode($response);
			?>


			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<table width="100%">
					<theads>
						<tr><div style="text-align:center">Disponible actuellement</div></tr><br>
					</thead>
					<tbody>
						<?php       
						foreach($json as $item) {
							$id_reservation = $item->id_reservation;
							$id_reservation = trim($id_reservation);
							$nom = $item->nom;
							$prenom = $item->prenom;
							$heure_debut = $item->heure_debut;
							$heure_fin = $item->heure_fin;
							$intitule = $item->intitule;
							$nb_personnes = $item->nb_personnes;
							$numero_salle = $item->numero_salle;
							$nom_prof = $item->nom_prof;
							$etat_validation = $item->etat_validation;
							if($etat_validation == 0 || $etat_validation == null)
							{

								echo "<tr>";
								echo "<th>Salle: {$numero_salle}</th>";
								echo "<td>Réservé par : {$nom} {$prenom}</td>";

								echo "<th><a href='validation.php?id_reservation={$id_reservation}' class='btn btn-primary' name='envoyer' value=''>Valider</a></th>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Heure début : {$heure_debut}</td>";
								echo "<td>Heure fin : {$heure_fin}</td>";
								echo "</tr>";
							}
						}
						?>
					</tbody>
				</table>
			</form>
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
	<script src="../js/main.js"></script>  
</body>
</html>