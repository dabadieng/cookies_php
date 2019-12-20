<?php
//var_dump($_POST);
$message="";
$nbjour=[];
$tab=[]; 
$data=[
	"Développeur Web" => 300.0,
	"Designer" => 300.0,
	"Architecte SI" => 620.0,
	"Administrateur data" => 705.0,
	"Ingénieur sécurité" => 1120.0,
	"Référenceur" => 250.0,
	"Chef de projet" => 530.0];

if (isset($_POST["btsubmit"])) {
	extract($_POST);
	$devis=0;
	foreach($data as $cle=>$taux) {
		$devis += $taux*$nbjour[$cle];
	}
	
	$valDevis = serialize($_POST["nbjour"]); 
	setcookie("devis", $valDevis, time()+365*24*3600); 
	
	$message= "Le devis est de $devis €HT";
}else{
	if(isset($_COOKIE["devis"])) {
		$tab = unserialize($_COOKIE["devis"]); 
		var_dump($tab); 
		/*echo "Lors de votre dernière connexion vous avez obtenu les tarifs suivants </br>"; 
		foreach($tab as $cle => $valeur) {
				echo "$cle  $valeur"; 
		}*/
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DEVIS</title>
</head>

<body>
	<h1><?=$message?></h1>	
	<p>Saisir le nombre de jours pour chaque intervenants</p>
	<form method="post">		
		<?php
		foreach($data as $cle=>$valeur) {
		?>
		<p>
			<label for="<?=$cle?>"><?=$cle?></label>
			<input type="number" id="<?=$cle?>" name="nbjour[<?=$cle?>]" value="<?=isset($_COOKIE["devis"]) ? $tab[$cle] : 0?>" >
		</p>
		<?php
		}
		?>
		<input type="submit" name="btsubmit" value="Ok" />
	</form>
</body>

</html>