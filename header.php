<?php

if(!isset($_SESSION['id_user'])){

}else {
	$arrContextOptions=array(
		"ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);  
	$response = file_get_contents("https://api:10000/users/".$_SESSION['id_user']."", false, stream_context_create($arrContextOptions));
	$json = json_decode($response);
	foreach($json as $item) {
		$id_user = $item->id_user;
		$type = $item->id_type;
	}
	if($type == 1)
	{
		$_SESSION['type'] = $type;
	}
};
?>

<div class="header">
	<a href="index.php">Accueil</a>
	<div class="header-right">
		<span style="margin-right: 2vw"><a href="admin.php"><?php if($type == 1) { echo "Admin"; } ?></a></span>
		<span style="margin-right: 2vw"><a href="account.php"><?php echo $_SESSION["email"];?></a></span>
		<span style="margin-right: 2vw"><a href="logout.php">Déconnexion</a></span>
		<a href="index.php"><img width="30vw" style="background-color: #f5f3f2" src="pictures/Logo_blanc.png"/></a>
	</div>
</div>