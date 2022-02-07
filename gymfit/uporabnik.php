<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Podatki uporabnika</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<script src="js/uporabnik.js"></script>
		<style>
		input[type=text], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=email], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=tel], select {
			width: 80%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=password], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=number], select {
			width: 80%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=submit] {
			width: 100%;
			background-color: #ffe5b4;
			color: black;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type=date] {
			width: 20%;
			background-color: white;
			color: black;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #ffcc99;
		}
		#posodobitev {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}
		h1 {
			font-size: 200%;
			text-align:center;
		}
		</style>
	</head>
	<body>
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

				<label for="Spol">Spol:
				<input type="text" name="Spol" required /></label><br/>

				<label for="Tel_stevilka">Telefonska stevilka:
				<input type="tel" name="Tel_stevilka" required /></label><br/>

				<label for="email">E-mail:
				<input type="text" name="email" required /></label><br/>	

				<label for="Paket">Paket:
				<input type="text" name="Paket" required /></label><br/>

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