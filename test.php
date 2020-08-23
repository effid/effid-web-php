<?php 
function load()
{

	$arrContextOptions=array(
		"ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);  
	$response = file_get_contents("", false, stream_context_create($arrContextOptions));
	$json = json_decode($response);
	foreach($json as $item) {
		$heure_debut = $item->heure_debut;
		$heure_fin = $item->heure_fin;
		$date = $item->date;
		$intitule = $item->intitule;
	}
	return $json;

};

load();

?>