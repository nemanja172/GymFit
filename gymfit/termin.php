<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Termini uporabnika</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
	<script src="js/prevPrijavoU.js"></script>
	<script src="js/termin.js"></script>
	<script type="text/javascript">
		function start(){
			prevPrijavo();
			terminUporabnika();
		}
	</script>
	<style>
		#tabela {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 50%;
		}

		#tabela td, #tabela th {
			border: 3px solid #ddd;
			border-collapse: collapse;
			padding: 8px;
			margin-left:1dp;
		}

		#tabela tr:nth-child {background-color: #f2f2f2;}

		#tabela tr:hover {background-color: #ddd;}

		#tabela th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #ffe5b4;
			color: black;
			border-collapse: collapse;
			width: 20%;
		}
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
		h1 {
			font-size: 200%;
			text-align:center;
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
	<body onload="start();">
		<?php include "Meni.html"?>
		<div id="prikaz"></div>
		<p>Na tej strani lahko preverite uporabljene termine. </p>
		<center>
		<div class="container">
			<input type="hidden" id="hidden" name="hidden">
			<script type="text/javascript"> 
				  document.getElementById("hidden").value = window.localStorage.getItem('ID_uporabnika');
				</script>
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