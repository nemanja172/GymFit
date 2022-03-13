<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Moj Profil</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
	<script src="js/prevPrijavoU.js"></script>
	<script src="js/uporabnik.js"></script>
	<script type="text/javascript">
		function start(){
			prevPrijavo();
			profilUporabnika();
		}
	</script>
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
		#button {
			background-color: #ffe5b4;
			border: none;
			color: black;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 17px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 10px;
		}
		p {
			font-size: 120%;
		}
		h1 {
			font-size: 200%;
			text-align:center;
		}
		input {
			border: 3px solid;
			border-radius: 10px;
		}
	</style>
	</head>
	<body onload="prevPrijavo();">
		<div class="center">
			<?php include "Meni.html"?>
			<div id="prikaz"></div>
			<p>Na tej strani lahko preverite in spremenite vaše podatke</p>
			<form onsubmit="podatkiUporabnika(); return false;" id="obrazec">
				<label for="ID_uporabnika">Vaš ID uporabnika:
				<input type="text" name="ID_uporabnika" id="ID_u" disabled/></label>
				<script>
					document.getElementById("ID_u").value = window.localStorage.getItem('ID_uporabnika');
				</script>
				<input type="submit" value="Prikaži" />
			</form>
			<br/>
			<form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				<label for="geslo">Geslo:
				<input type="password" name="geslo" disabled/></label><br/>

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
				<input type="number" name="user_level" min="0" max="1" disabled/></label>
				<small>Admin (1), User (0)</small><br><br/>				
				
				<input type="submit" value="Posodobi" />
			</form>
			<br/>
			<div id="odgovor"></div>
			<br/>
			
		</div>
	</body>
</html>
