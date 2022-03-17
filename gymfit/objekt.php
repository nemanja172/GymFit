<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Podatki uporabnika</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>
		<script src="js/fitnes.js"></script>
		<script src="js/prevPrijavoA.js"></script>
		<style>
		#posodobitev {
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
			<p>Na tej strani preveri podatke fitnesa z vnosom ID fitnesa</p>
			<form onsubmit="podatkiFitnesa(); return false;" id="obrazec">
				<label for="ID_fitnesa">ID fitnesa:</label>
				<input type="text" name="ID_fitnesa" required />
				<input type="submit" value="Prikaži" />
			</form>
			<br/>
			<form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				<label for="ime">Ime:</label>
				<input type="text" name="ime" required /><br/>
				
				<label for="lokacija">Lokacija:</label>
				<input type="text" name="lokacija" required /><br/>		

				<label for="naslov">Naslov:</label>
				<input type="text" name="naslov" required /><br/>	

				<label for="tip">Tip:</label>
				<input type="text" name="tip" required /><br/>	
				
				<input type="submit" value="Posodobi" />
			</form>
			
			<div id="odgovor"></div>
		</div>
	</body>
</html>