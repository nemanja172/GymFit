<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Prijava</title>
		<link rel="stylesheet" type="text/css" href="css/stilprijava.css">
		<script src="js/dodajUporabnika.js"></script>
		<?php 
		session_start();
		
		if(isset($_SESSION['auth']))
		{
			if(!isset($_SESSION['message'])){
				$_SESSION['message']='Že ste registrirani';
				if($_SESSION['user_level'] !== "1")
				{
					header("location:http://localhost/gymfit/domaca.php");
					exit(0);
				}
				else
				{
					header("location:http://localhost/gymfit/domacaAdmin.php");
					exit(0);
				}
			}
		}
		?>
		<style>
		.slika {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
		}
		</style>
	</head>
	<body>
		<div class="hero">
			<div class="form-box">
				<?php include('../gymfitAPI/message.php'); ?>
				<div class="button-box">
					<div id="btn"></div>
						<button type="button" class="toggle-btn" onclick="login()">Prijava</button>
						<button type="button" class="toggle-btn" onclick="register()">Registracija</button>		
				</div>
				<form id="login" class="input-group" action="../gymfitAPI/prijava.php" method="POST">
					<input type="text" class="input-field" name="email" placeholder="Email" required>
					<input type="password" class="input-field" name="geslo" placeholder="Geslo" required>
					<button type="submit" class="submit-btn">Prijava</button>
				</form>
				
				<form id="register" class="input-group" action="../gymfitAPI/registracija.php" method="POST">
					<input type="text" class="input-field" name="ime" placeholder="Ime" required>
					<input type="text" class="input-field" name="priimek" placeholder="Priimek" required>
					<input type="password" class="input-field" name="geslo" placeholder="Geslo" required>
					<input type="date" class="input-field" name="Datum_rojstva" placeholder="Datum rojstva" required>
					<select id="Spol" class="input-field" name="Spol" name="Spol">
					<option value="M">Moški (M)</option>
					<option value="Z">Ženski (Z)</option>
					<select/> <br>
					<input type="tel" class="input-field" name="Tel_stevilka" placeholder="Telefonska stevilka - format 060-123456" oninvalid="this.setCustomValidity('Unesite telefonsko številko')" required>
					<input type="email" class="input-field" name="email" placeholder="E-mail" required>
					<select id="Paket" class="input-field" name="Paket">
					<option value="S">Paket S (10 termina)</option>
					<option value="M">Paket M (16 termina)</option>
					<option value="L">Paket L (20 termina)</option>
					<option value="X">Paket X (30 termina)</option>
					<select/>
					<button type="submit" class="submit-btn">Registracija</button>
				</form>
				<div id="odgovor"></div>
			</div>
		</div>
		<script>
		var x = document.getElementById("login");
		var y = document.getElementById("register");
		var z = document.getElementById("btn");

		function register(){
			x.style.left="-400px";
			y.style.left="50px";
			z.style.left="110px";
		}
		function login(){
			x.style.left="50px";
			y.style.left="450px";
			z.style.left="0px";
		}		
		
		</script>
	</body>
</html>
