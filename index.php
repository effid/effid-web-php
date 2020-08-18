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
  <?php include 'css/style.php'; ?>
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="sucess">
    <div class="centre">
      <h3 style="text-align: center;"><?php setlocale(LC_TIME, 'fra_fra'); $date = strftime('%A %d %B %Y'); $test = utf8_encode($date); echo $test?></h3>
      <br>
      <?php
      $arrContextOptions=array(
        "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
        ),
      );  
      
      $response = file_get_contents("http://api/salles", false, stream_context_create($arrContextOptions));
      $json = json_decode($response);
      ?>
      <table width="100%">
        <theads>
          <tr><div style="text-align:center">Disponible actuellement</div></tr>
        </thead>
        <tbody>
          <?php       
          foreach($json as $item) {
            $id_salle = $item->id_salle;
            $id_salle = trim($id_salle);
            $numero = $item->numero_salle;
            $type = $item->type;
            $capacite = $item->capacite;
            echo "<tr>";
            echo "<th>Salle: {$numero}</th>";
            echo "<th>Type : {$type}</th>";
            echo "<th><a value='Réservez' class='btn btn-primary' href='reserved.php?numero={$numero}&id_salle={$id_salle}'>Réserver</button></th>";
            echo "</tr>";
            echo "<tr>";
            echo "<td style='font-size: 0.75em'>Capacité : {$capacite} </td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="buttonCentre">
      <a style="color: white" href="schedule.php">Voir le calendrier</a>
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