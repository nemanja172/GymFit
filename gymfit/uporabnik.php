<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Podatki uporabnika</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<script src="js/uporabnik.js"></script>
		<link href="css/zunanji.css" rel="stylesheet"/>
		<script src="js/prevPrijavoA.js"></script>
	</head>
	<body onload="prevPrijavo();">
		<div class="center">
			<?php include "adminMeni.html"?>
			<p>Na tej strani lahko posodobite obstoječega uporabnika. Vnesite ID uporabnika i pridobite informacije. Za brisanje uporabnika izberite ID in natisnite gumb Izbriši</p>
			<form onsubmit="podatkiUporabnika(); return false;" id="obrazec">
				<label for="ID_uporabnika">ID uporabnika:
				<input type="text" name="ID_uporabnika" required /></label>
				<input type="submit" value="Prikaži" />
			</form>
			<br/>
			<form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				<label for="geslo">Geslo:
				<input type="password" name="geslo" required /></label><br/>

				<label for="ime">Ime:
				<input type="text" name="ime" required /></label><br/>
				
				<label for="priimek">Priimek:
				<input type="text" name="priimek" required /></label><br/>	

				<label for="Datum_rojstva">Datum rojstva:
				<input type="date" name="Datum_rojstva" required /></label><br/>					

				<label for="Spol">Spol (M - moški, Z - ženski)*:</label><br>
				<select id="Spol" name="Spol">
					<option value="M">Moški (M)</option>
					<option value="Z">Ženski (Z)</option>
				<select/> <br>
				
				<label for="Tel_stevilka">Telefonska stevilka:
				<input type="tel" name="Tel_stevilka" required /></label><br/>

				<label for="email">E-mail:
				<input type="text" name="email" required /></label><br/>	

				<label for="Paket">Paket:</label><br>
				<select id="Paket" name="Paket">
					<option value="S">Paket S (10 termina)</option>
					<option value="M">Paket M (16 termina)</option>
					<option value="L">Paket L (20 termina)</option>
					<option value="X">Paket X (30 termina)</option>
				<select/> <br>

				<label for="user_level">Nivo:
				<input type="number" name="user_level" min="0" max="1" required /></label>
				<small>Admin (1), User (0)</small><br><br/>				
				
				<input type="submit" value="Posodobi" />
			</form>
			<br/>
			<div id="odgovor"></div>
			<br/>
			<form onsubmit="izbrisiUporabnika(); return false;">
				<input type="submit" value="Izbriši" />
			</form>
			
		</div>
	</body>
</html>