<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Termini uporabnika</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
	<link href="css/zunanji.css" rel="stylesheet"/>
	<script src="js/termin.js"></script>
	<script src="js/prevPrijavoU.js"></script>
		<script>
			function start(){
				terminUporabnika();
				prevPrijavo();
			}
		</script>
	<style>
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
		input {
			border: 3px solid;
			border-radius: 10px;
		}
	</style>
	</head>
	<body onload="start()">
		<?php include "Meni.html"?>
		<div id="prikaz"></div>
		<p>Na tej strani lahko preverite uporabljene termine. </p>
		<center>
		<div class="container">
			<table id="tabela">
				<tr >
					<th>Ime fitnesa</th>
					<th>Datum</th>
				</tr><br>		
			</table>
			<div id="odgovor"></div>
		</center>
	</body>
</html>