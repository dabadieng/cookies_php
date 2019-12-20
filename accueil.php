<?php
$data = array(
	"Albanie" => "Mirë se vini në faqen tonë të internetit",
	"Allemagne" => "Herzlich willkommen auf unserer Website",
	"Angleterre" => "Welcome to our website",
	"Danemark" => "Velkommen til vores hjemmeside",
	"Espagne" => "Bienvenido a nuestro sitio web",
	"Estonie" => "Tere tulemast meie kodulehel",
	"France" => "Bienvenue sur notre site",
	"Italie" => "Benvenuti nel nostro sito",
	"Pays-Bas" => "welkom op onze website",
	"Pologne" => "Witamy na naszej stronie internetowej",
	"Portugal" => "Bem-vindo ao nosso site",
	"Roumanie" => "Bine ati venit la site-ul nostru",
	"Suède" => "Välkommen till vår hemsida",
	"Hongrie"=>"üdvözöljük oldalunkon"
);

if (isset($_POST["btsubmit"])) {
	extract($_POST);
	$message=$data[$pays];
	setcookie("pays",$pays,time()+365*24*3600);
} else {
	if (isset($_COOKIE["pays"]))
		$pays=$_COOKIE["pays"];
	else
		$pays="France";
	$message=$data[$pays];
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Welcome</title>
</head>

<body>
	<h1><?=$message?></h1>	
	<form method="post">
		<label for="pays">Sélectionner un pays</label>
		<select name="pays" id="pays">
			<?php
			foreach($data as $cle=>$valeur) {
				if ($cle==$pays)
					echo "<option selected>$cle</option>";
				else 
					echo "<option>$cle</option>";
			}			
			?>			
		</select>
		<input type="submit" name="btsubmit" value="Ok" />
	</form>
</body>

</html>