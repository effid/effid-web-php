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
  if (isset($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['passwordConfirmation'])){


    $nom = $_REQUEST['nom'];
    $prenom = $_REQUEST['prenom']; 
    $email = $_REQUEST['email'];
    $password = stripslashes($_REQUEST['password']);
    $confirmePassword = stripslashes($_REQUEST['passwordConfirmation']);

    if($password == $confirmePassword)
    {

      $response = array('nom' => $nom, "prenom" => $prenom, "email" => $email, "password" => $password, "id_puce" => 0, "id_type" => 2, "id_classe" => NULL);

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
      $result = file_get_contents('http://api/inscription', false, $context);

      if($result){
        echo "Erreur de connexion avec l'API";
      }else{
        header("Location: login.php");
        exit(); 
      }
    }else{
      $message = "Les mots de passe ne correspondent pas entre eux";
      include 'register2.php'; 
    }

  }
  include 'register2.php';
    /*if($password == $confirmePassword)
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
      }else{
        $message = "la connexion avec la bdd n'est pas possible";
        include 'register2.php';
      }
    }else{
      $message = "Les mots de passe ne correspondent pas entre eux";
      include 'register2.php';
    }
  }else{
    include 'register2.php'; 
  } */
  ?>
</body>
</html>