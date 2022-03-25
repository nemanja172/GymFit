<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Objekti</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>
		<script src="js/uporabnik.js"></script>
		<script src="js/prevPrijavoA.js"></script>
		<script>
			function start(){
				podatkiVsihUporabnika();
				prevPrijavo();
			}
		</script>
	</head>
	<body onload="start();">
		<div class="center">
			<?php include "adminMeni.html"?>
			<div id="prikaz"></div>
			<p>Na tej strani so vsi uporabniki v GymFit sistemu</p>
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