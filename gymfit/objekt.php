<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Podatki uporabnika</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<script src="js/fitnes.js"></script>
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