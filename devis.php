<?php
var_dump($_POST);
$message="";
$nbjour=[];
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
	$message= "Le devis est de $devis €HT";
	setcookie("devis",serialize($nbjour),time()+365*24*3600);
} else if (isset($_COOKIE["devis"])) {
		$nbjour=unserialize($_COOKIE["devis"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DEVIS</title>
</head>
<style>
	label {
		width:200px;
		display:inline-block;
		text-align: right;
	}

	input:focus {
		border : 4px solid red;
	}

	input[type="submit"] {
		background-color: #789;
	}

	input[type="submit"]:hover {
		background-color: #F00;
	}

</style>
<body>
	<h1><?=$message?></h1>	
	<p>Saisir le nombre de jours pour chaque intervenants</p>
	<form method="post">		
		<?php
		foreach($data as $cle=>$valeur) {
		?>
		<p>
			<label for="<?=$cle?>"><?=$cle?></label>
			<input type="number" id="<?=$cle?>" name="nbjour[<?=$cle?>]" value="<?=isset($nbjour[$cle]) ? $nbjour[$cle] : 0?>" >
		</p>
		<?php
		}
		?>
		<input type="submit" name="btsubmit" value="Ok" />
	</form>
</body>

</html>