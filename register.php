<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="css/style.css" />
  <!--===============================================================================================-->
</head>
<body>
  <?php
  require('db/config.php');
  if (isset($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['passwordConfirmation'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $nom = stripslashes($_REQUEST['nom']);
    $username = mysqli_real_escape_string($conn, $nom); 

    $prenom = stripslashes($_REQUEST['prenom']);
    $prenom = mysqli_real_escape_string($conn, $prenom); 
  // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $password = stripslashes($_REQUEST['password']);
    $confirmePassword = stripslashes($_REQUEST['passwordConfirmation']);
    if($password == $confirmePassword)
    {
      $password = mysqli_real_escape_string($conn, $password);
  //requéte SQL + mot de passe crypté
      $query = "INSERT into `users` (nom, prenom, email, password, id_puce, id_type, id_classe)
      VALUES ('$nom', '$prenom', '$email', '".hash('sha256', $password)."', 1, 1, 1);";
  // Exécuter la requête sur la base de données
      $res = mysqli_query($conn, $query);
      if($res){
        header("Location: login.php");
        exit(); 
      }
    }else{
      $message = "Les mots de passe ne correspondent pas entre eux";
      include 'register2.php';
    }
  }else{
    include 'register2.php'; 
  } 
  ?>
</body>
</html>