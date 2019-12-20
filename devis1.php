<?php
//var_dump($_POST);
$devis = [];
$metier = [];
// initialisation des variables

$Développeur_Web = "";
$Designer = "";
$Architecte_SI = "";
$Administrateur_data = "";
$Ingénieur_sécurité = "";
$Référenceur = "";
$Chef_de_projet = "";

// tableau des tarifs 
$data = [
    "Développeur_Web" => 300.0,
    "Designer" => 300.0,
    "Architecte_SI" => 620.0,
    "Administrateur_data" => 705.0,
    "Ingénieur_sécurité" => 1120.0,
    "Référenceur" => 250.0,
    "Chef_de_projet" => 530.0
];
const tva = 20;
$tarif_ht = 0;
foreach ($data as $cle => $value) {
    $devis["Specialité"][] = $cle;
    $devis["Tarif journalier"][] = $value;
}

if (isset($_POST["btSubmit"])) {
    foreach ($_POST as $cle => $value) {
        if ($cle != "btSubmit") {
            $devis["Nombre de jours"][] = $value;
            $devis["Tarif HT"][] = $value * $data[$cle];
            $tarif_ht += $value * $data[$cle];
        }
    }

    var_dump($devis);

    setcookie("tarif", $tarif_ht, time() + 356 * 24 * 3600);
} else {
    if (isset($_COOKIE)) {
        extract($_COOKIE);
        $message = "Lors de votre dernière connexion vous avez obtenu un tarif de $tarif";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Formulaire</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <?php if (isset($_POST["btSubmit"])) { ?>
        <table>
            <tbody>
                <?php foreach ($devis as $cle => $value) { ?>
                    <tr>
                        <th><?= $cle ?></th>
                        <?php foreach ($value as $indice => $v) { ?>
                            <td><?= $v ?></td>
                        <?php } ?>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
        <h4>Merci d'avoir choisi notre site</h4>
        <p>Vous souhaitez recalculer un devis <a href="devis.php">Cliquer ici</a> </p>
    <?php    } else { ?>
        <?php if (isset($_COOKIE)) { ?>
            <h1> <?php echo " $message €uros"; ?> </h1>
        <?php     } ?>

        <form method="POST">
            <fieldset>
                <legend>Veuillez indiquer le nombre de jours souhaitez par spécialités </legend>
                <?php
                    foreach ($data as $cle => $value) { ?>
                    <p>
                        <label for="<?= $cle ?>"><?= $cle ?></label>
                        <input type="text" name="<?= $cle ?>" id=" <?= $cle ?>" value="" />
                    </p>
                <?php    } ?>
                <input type="submit" name="btSubmit" value="Envoyer" />
        </form>
        </fieldset>

    <?php    } ?>
    <h4>Votre facture HT : <?= $tarif_ht ?></h4>
    <h3>Votre facture TTC : <?= $tarif_ht * (1 + tva / 100) ?></h3>
    <table>
        <thead>
            <caption>Votre facture</caption>
        </thead>
        <tbody>
            <tr>
                <th></th>
            </tr>
        </tbody>
    </table>

</body>

</html>