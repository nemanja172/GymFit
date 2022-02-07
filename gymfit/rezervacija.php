<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit - Vpis uporabnika</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<script src="js/dodajTermin.js"></script>
		<style>
		#button {
			background-color: #ffe5b4;
			border: none;
			color: black;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 20px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 10px;
		}
		input[type=text], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input {
			width: 20%;
		}
		p {
			font-size: 120%;
		}
		</style>
		
	</head>
	<body>
		<div class="center">
			<?php include "Meni.html"?>
			<p>Izpolnite obrazec in rezervirajte svoj termin:</p>
			<form id="obrazec" action="rezervisi.php" method="POST">
				
				<label for="ID_uporabnika">ID uporabnika:</label><br>
				<input type="number_format" name="ID_uporabnika" required/> <br>
				
				<label for="ID_fitnesa">ID fitnesa:</label><br>
				<input type="number_format" name="ID_fitnesa" required/> <br>
				
				<label for="datum">Datum rezervacije:</label><br>
				<input type="date" name="datum" required/> <br>
				
				<input type="submit" id="button" value="Rezerviraj" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
</html>