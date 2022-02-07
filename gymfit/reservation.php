<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['ID_uporabnika']) && isset($_POST['ID_fitnesa']) && isset($_POST['datum'])) {
    if ($db->dbConnect()) {
        if ($db->reservation("termin", $_POST['ID_uporabnika'], $_POST['ID_fitnesa'], $_POST['datum'])) {
            echo "Uspesna rezervacija";
        } else echo "Rezervacija ni uspela";
    } else echo "Napaka: ni konekcije z bazo";
} else echo "Vsa polja so obvezna";
?>