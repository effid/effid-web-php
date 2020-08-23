<?php
  // Initialiser la session
session_start();
ob_start();

$today = date('Y-m-d');
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["email"])){
  header("Location: login.php");
  exit(); 
}

ob_end_flush();

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
      <div class="schedule">
        <h3 style="text-align: center;"><?php setlocale(LC_TIME, 'fra_fra'); $date = strftime('%A %d %B %Y'); $test = utf8_encode($date); echo $test?></h3>
        <br>
        <?php
        $arrContextOptions=array(
          "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
          ),
        );  

        $response = file_get_contents("https://apollonian.fr:10000/salles", false, stream_context_create($arrContextOptions));
        $json = json_decode($response);

        $arrContextOptions=array(
          "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
          ),
        );  
        if(isset($_REQUEST['DateResa']) && isset($_REQUEST['TimeResaFin']) && isset($_REQUEST['TimeResaDebut']))
        {
          $date = $_REQUEST['DateResa'];

          $result = file_get_contents("https://apollonian.fr:10000/salles/reservees/".$date."", false, stream_context_create($arrContextOptions));
          $jsonReserves = json_decode($result);
        }else{
        }
        ?>
        <table width="100%">
          <theads>
            <div class="row">
              <label style="margin: 0.4vw 2vw 0 5vw; ">Date : </label>
              <input type="Date" name="DateResa" class="form-control col-2" min="<?php echo $today ?>" required/>
              <label style="margin: 0.4vw 2vw 0 2vw">Heure début : </label>
              <input type="Time" name="TimeResaDebut" min="08:00:00" max="13:00:00" class="form-control col-2" required/>
              <label style="margin: 0.4vw 2vw 0 2vw">Heure fin: </label>
              <input type="Time" name="TimeResaFin" min="13:30:00" max="23:00:00" class="form-control col-2" required/>  
            </div>
          </thead>
          <tbody>
            <hr/>
            <?php 

            if(isset($_REQUEST['DateResa']) && isset($_REQUEST['TimeResaFin']) && isset($_REQUEST['TimeResaDebut']))
            {
              echo "<span style='font-weight: bolder'>A la date du : ", $date, " entre ", $_REQUEST['TimeResaDebut'], " et ", $_REQUEST['TimeResaFin'] , " : </span>" ; 
              echo '<a href="#" style="margin-left: 45vw; font-weight: bolder; color: red;" data-toggle="tooltip" title="Lors de votre réservation, la date ainsi que les heures seront les informations remplies préalablement">Informations importantes</i></a>';
              $debut = $_REQUEST['TimeResaDebut'];
              $fin = $_REQUEST['TimeResaFin'];
              foreach($jsonReserves as $reservees)
              {
                $dateResa = $reservees->date;
                $id_salle2 = $reservees->id_salle;
                $debutResa = $reservees->heure_debut;
                $finResa = $reservees->heure_fin;
              }

              if(isset($dateResa) && isset($debut) && isset($fin))
              {
                $old_date_timestamp = strtotime($dateResa);
                $new_date = date('Y-m-d', $old_date_timestamp);
                $strDebut = strtotime($debut);
                $strFin = strtotime($fin);
                $strDebutResa = strtotime($debutResa);
                $strFinResa = strtotime($finResa);
              }

              foreach($json as $item) {
                $id_salle = $item->id_salle;
                $id_salle = trim($id_salle);
                $numero = $item->numero_salle;
                $type = $item->type;
                $capacite = $item->capacite;

                if(isset($new_date) == $date && $id_salle2 == $id_salle && (($strFin >= $strDebutResa && $strFin <= $strFinResa) || ($strDebut >= $strDebutResa && $strDebut <= $strFinResa)))
                {

                }else{
                  echo "<tr>";
                  echo "<th>Salle: {$numero}</th>";
                  echo "<th>Type : {$type}</th>";
                  echo "<th><a value='Réservez' class='btn btn-primary' href='reservedSchedule.php?numero={$numero}&id_salle={$id_salle}&date={$date}&heure_debut={$debut}&heure_fin={$fin}'>Réserver</button></th>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td style='font-size: 0.75em'>Capacité : {$capacite} </td>";
                  echo "</tr>";
                }
              }
            }else{
              echo "<div style='text-align: center; margin-top: 30vh; font-weight: bolder'>";
              echo "Veuillez rentrer une heure et une date pour avoir la liste des réservations possibles";
              echo "</div>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="button">
        <button style="color: white">Valider</button>
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
  <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</body>
</html>