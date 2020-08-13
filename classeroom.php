<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit(); 
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
</body>
</html>