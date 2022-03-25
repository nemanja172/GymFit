<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit | Prva stran</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>	
		<script src="js/prevPrijavoA.js"></script>
		<style>
		.slika {
			bottom: 0;
			right: 0;
			width: 300px;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		</style>
	</head>
	<body onload="prevPrijavo()">
		<div id="oPrijavi"></div>
		<div class="center">
			<?php include"adminMeni.html"?>
			<p>Uredite podatke obstoječih uporabnikov, dodajte nove uporabnike, nove objekte, ali spremenite pomembne informacije</p>
			<img alt="drawing" src="images/admin.png" class="slika" width="300">
		</div>
	</body>
</html>