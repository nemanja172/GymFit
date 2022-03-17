<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Vpis fitnesa</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>	
		<script src="js/prevPrijavoA.js"></script>
		<script src="js/dodajFitnes.js"></script>
		<style>
		#obrazec1 {
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
			<p>Na tej strani lahko upišeš novo lokacijo za fitnes. ID fitnesa se avtomatski dodeli. Vsa polja sa * so obvezna</p>
			<form id="obrazec1" onsubmit="dodajFitnes(); return false;">
				
				<label for="ID_fitnesa">ID fitnesa:</label><br>
				<input type="number_format" name="ID_fitnesa" disabled/> <br>
				
				<label for="ime">Ime*:</label><br>
				<input type="text" name="ime" oninvalid="this.setCustomValidity('Unesite ime')" required/> <br>

				<label for="lokacija">Lokacija*:</label><br>
				<input type="text" name="lokacija" oninvalid="this.setCustomValidity('Unesite lokacijo')" required/> <br>
				
				<label for="naslov">Naslov*:</label><br>
				<input type="text" name="naslov" oninvalid="this.setCustomValidity('Unesite naslov')" required/> <br>
				
				<label for="tip">Tip*:</label><br>
				<select id="tip" name="tip">
					<option value="Fitnes">Fitnes</option>
					<option value="Bazen">Bazen</option>
					<option value="Golf">Golf</option>
					<option value="Tenis">Tenis</option>
				<select/> <br>
				
				<input type="submit" value="Vpiši" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
</html>