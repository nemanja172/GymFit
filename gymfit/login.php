<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['email']) && isset($_POST['geslo'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("uporabnik", $_POST['email'], $_POST['geslo'])) {
            echo "Uspesna prijava";
        } else echo "Email ali Geslo so napacni";
    } else echo "Napaka: Ni konekcije z bazo";
} else echo "Vsa polja so obvezna";
?>
