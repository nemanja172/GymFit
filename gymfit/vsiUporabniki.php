<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Objekti</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<script src="js/uporabnik.js"></script>
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
		h1 {
			font-size: 200%;
			text-align:center;
		}
		</style>
	</head>
	<body onload="podatkiVsihUporabnika();">
		<div class="center">
			<?php include "adminMeni.html"?>
			<table id="tabela">
				<tr>
					<th>ID</th>
					<th>Ime</th>
					<th>Priimek</th>
					<th>Geslo</th>
					<th>Datum rojstva</th>
					<th>Spol</th>
					<th>Telefonska številka</th>
					<th>Email</th>
					<th>Paket</th>
					<th>Nivo</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
	</body>
</html>