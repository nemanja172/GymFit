<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Vpis uporabnika</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>	
		<script src="js/dodajUporabnika.js"></script>
		<script src="js/prevPrijavoA.js"></script>
		<style>
		#obrazec {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}
		</style>
	</head>
	<body onload="prevPrijavo();">
		<div class="center">
			<?php include "adminMeni.html"?>
			<div id="prikaz"></div>
			<p>Na tej strani lahko upišete novega uporabnika. ID uporabnika se avtomatski dodeli. Vsa polja označena z zvezdico (*) so obvezna</p>
			<form id="register" onsubmit="dodajUporabnika(); return false;">
				
				<label for="ID_uporabnika">ID uporabnika:</label><br>
				<input type="number_format" name="ID_uporabnika" disabled/> <br>
				
				<label for="ime">Ime*:</label><br>
				<input type="text" name="ime" oninvalid="this.setCustomValidity('Unesite ime')" required/> <br>

				<label for="priimek">Priimek*:</label><br>
				<input type="text" name="priimek" oninvalid="this.setCustomValidity('Unesite priimek')" required/> <br>
				
				<label for="geslo">Geslo*:</label><br>
				<input type="password" name="geslo" oninvalid="this.setCustomValidity('Unesite geslo')" required/> <br>
				
				<label for="Datum_rojstva">Datum rojstva*:</label><br>
				<input type="date" name="Datum_rojstva" required/> <br>
				
				<label for="Spol">Spol (M - moški, Z - ženski)*:</label><br>
				<select id="Spol" name="Spol">
					<option value="M">Moški (M)</option>
					<option value="Z">Ženski (Z)</option>
				<select/> <br>
				
				<label for="Tel_stevilka">Telefonska številka*:</label><br>
				<input type="tel" name="Tel_stevilka" placeholder="060-456789" oninvalid="this.setCustomValidity('Unesite telefonsko številko')" required/> 
				<small>Format: 060-456789</small><br>
				
				<label for="email">Email*:</label><br>
				<input type="email" name="email" oninvalid="this.setCustomValidity('Unesite telefonsko elektronski naslov')" required/> <br>
								
				<label for="Paket">Paket*:</label><br>
				<select id="Paket" name="Paket">
					<option value="S">Paket S (10 termina)</option>
					<option value="M">Paket M (16 termina)</option>
					<option value="L">Paket L (20 termina)</option>
					<option value="X">Paket X (30 termina)</option>
				<select/> <br>
				
				<input type="submit" value="Vpiši" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
</html>