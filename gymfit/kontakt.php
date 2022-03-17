<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit | Kontakt</title>
		<link rel="stylesheet" type="text/css" href="stil.css" />
		<link href="css/zunanji.css" rel="stylesheet"/>
		<script src="js/prevPrijavoU.js"></script>
		<style>
		#button {
			background-color: #ffcc99;
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
		
		</style>	
	</head>
	<body onload="prevPrijavo();">
		<div class="center">
			<?php include "Meni.html"?>	
			<div id="prikaz"></div>
		</div>
		<section class="contact">
			<div class="tekst">
				<h2>Kontaktirajte nas</h2>
				<p>Za več informacij, lahko nas kontaktirate preko spletnega obrazca</p>
				<img src="logo.png" id="slika">
			</div>
			<div class="containter">
				<div class="contactInfo">
					<div class="box">
						<div class="icon"></div>
						<div class="text">
						<h3>Naslov</h3>
						<p>Lubljanska cesta 52<br>1000, Ljubljana<br>Slovenija</p>
						</div>
					</div>
					<div class="box">
						<div class="icon"></i></div>
						<div class="text">
						<h3>Kontakt</h3>
						<p>Telefon: +386 69 695 602</p>
						</div>
					</div>
					<div class="box">
						<div class="icon"></i></div>
						<div class="text">
							<h3>E-mail</h3>
							<p>gymfit@gym24</p>
						</div>
					</div>
				</div>
				<div class="contactForm">
					<form>
						<h2>Posljite sporocilo<h2>
						<div class="inputBox">
							<input type="text" name="" required="required">
							<span>Puno ime</span>
						</div>
						<div class="inputBox">
							<input type="text" name="" required="required">
							<span>Email</span>
						</div>
						<div class="inputBox">
							<textarea required="required"></textarea>
							<span>Sporocilo...</span>
						</div>
						<div class="inputBox">
							<input type="submit" id="button" value="Poslji">
						</div>
				</div>
			</div>
		</section>	
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
