<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Objekti</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<script src="js/fitnes.js"></script>
		<?php include('../gymfitAPI/authenticationu.php'); ?>
		<style>
		#tabela {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#tabela td, #tabela th {
			border: 3px solid #ddd;
			padding: 8px;
		}

		#tabela tr:nth-child {background-color: #f2f2f2;}

		#tabela tr:hover {background-color: #ddd;}

		#tabela th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #ffe5b4;
			color: black;
		}
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
		h1 {
			font-size: 200%;
			text-align:center;
		}
		p {
			font-size: 120%;
		}
		</style>
	</head>
	<body onload="fitnesi();">
		<div class="center">
			<?php include "Meni.html"?>
			<p>Izberite enega izmed ponujenih objektov, kjer je možno rezervirati termin.</p> 
			<p>Za rezervacijo kliknite gumb Rezerviraj, potrebovali boste svoj ID in ID fitnesa.</p>
			<table id="tabela">
				<tr>
					<th style='width:150px'>ID objekta</th>
					<th>Ime</th>
					<th>Mesto</th>
					<th>Naslov</th>
					<th>Tip</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
		<div class="center">
		<a href="rezervacija.php">
			<button id="button" type="button">Rezervacija termina</button>
		</a>
		</div>
	</body>
</html>