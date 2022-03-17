<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Objekti</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>	
		<script src="js/fitnes.js"></script>
		<script src="js/prevPrijavoU.js"></script>
		<script type="text/javascript">
			function start(){
				prevPrijavo();
				fitnesi();
			}
		</script>
		<style>
		p {
			font-size: 120%;
		}
		</style>
	</head>
	<body onload="start();">
		<div class="center">
			<?php include "Meni.html"?>
			<div id="prikaz"></div>
			<p>Izberite enega izmed ponujenih objektov, kjer je možno rezervirati termin.</p> 
			<p>Za rezervacijo kliknite gumb Rezerviraj, potrebovali boste ID fitnesa.</p>
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