<?php 
session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["type"]) || !isset($_SESSION["email"])){
	header("Location: index.php");
	exit(); 
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
	<div class="admin">
		<div>
			<h3 style="text-align: center; margin: 2vh auto;">Partie Administrative</h3>
		</div>
		<div class="adminDiv"><a href="createRoom.php" class="btn btn-primary">Création des salles</a></div>
		<div class="adminDiv"><a style="padding: 150vw auto;" href="createClasses.php" class="btn btn-primary">Création des classes</a></div>
		<div class="adminDiv"><a href="validation.php" class="btn btn-primary">Acceptation des réservations</a></div>
	</div>
</body>
</html>