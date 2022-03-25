<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Objekti</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>
		<script src="js/fitnes.js"></script>
		<script src="js/prevPrijavoA.js"></script>
		<script>
			function start(){
				fitnesi();
				prevPrijavo();
			}
		</script>
	</head>
	<body onload="start();">
		<div class="center">
			<?php include "adminMeni.html"?>
			<div id="prikaz"></div>
			<p>Na tej strani so vsi fitnesi v GymFit sistemu</p>
			<table id="tabela">
				<tr>
					<th>ID</th>
					<th>Ime</th>
					<th>Mesto</th>
					<th>Naslov</th>
					<th>Tip</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
	</body>
</html>