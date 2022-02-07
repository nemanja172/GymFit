<?php

include 'dbConnect.php';
$zbirka = dbConnect();

$poizvedba = " INSERT INTO termin  (ID_termina, ID_uporabnika, ID_fitnesa, datum) VALUES ('', '2', '2', '2021-06-28')"; 

if (mysqli_query ($zbirka, $poizvedba)) {
	echo "Vnos termina uspešen!";
} else {
	echo "Napaka: ". mysqli_error ($zbirka);
}

mysqli_close($zbirka);

?>