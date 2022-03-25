<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit | Prva stran</title>
		<link rel="stylesheet" type="text/css" href="stil.css"/>
		<link href="css/zunanji.css" rel="stylesheet"/>	
		<script src="js/prevPrijavoU.js"></script>
		<style>
		#slika1 {
			width: 50%;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		p {
			font-size: 120%;
		}
		</style>
	</head>
	<body onload="prevPrijavo()">
		<div class="center">
			<?php include("Meni.html");?>
			<p>Aplikacija GymFit vam omogoča trening v različnih objektih v celi državi. Sistem omogoča najlažji dostop do vaših najljubših športnih centrov. </p>
			<p> Vadite v različnih objektih po celotni Sloveniji.</p>
			<p>	Ena članarina zadostuje za vse vaše fitnes potrebe!</p>
			<img alt="drawing" src="images/training.jpg" id="slika1"/>
		</div>
		<hr>
		<footer>
			<p>Socijalna omrežja</p>
			<ul>
				<li>
					<a href="https://youtube.com" target="_blank">	
						<img src="images/ytlogo.png" width="40">
					</a>
				</li>
				<li>
					<a href="https://facebook.com" target="_blank">
						<img src="images/fblogo.jpg" width="40">
					</a>
				</li>
				<li>				
					<a href="https://linkedin.com" target="_blank">
						<img src="images/linlogo.png" width="40">
					</a>
				</li>
			</ul>
		</footer>
	</body>
</html>