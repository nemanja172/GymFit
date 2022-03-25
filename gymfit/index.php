<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Gymfit - Prijava</title>
		<link rel="stylesheet" type="text/css" href="css/stilprijava.css">
		<script src="js/regUporabnika.js"></script>
		<script src="js/prijava.js"></script>
		<script src="js/oPrijavi.js"></script>
		<style>
		.slika {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
		}
		#register{height:400px;overflow-y:auto}
		</style>
	</head>
	<body onload="oPrijavi()">
		<div class="hero">
			<div class="form-box">
				<div class="button-box">
					<div id="btn"></div>
						<button type="button" class="toggle-btn" onclick="login()">Prijava</button>
						<button type="button" class="toggle-btn" onclick="register()">Registracija</button>		
				</div>
				<form id="login" class="input-group" onsubmit="prijava(); return false">
					<input type="text" class="input-field" name="email" id="email" placeholder="Email" required>
					<input type="password" class="input-field" name="geslo" id="geslo" placeholder="Geslo" required>
					<button type="submit" class="submit-btn">Prijava</button>
				</form>
				
				<form id="register" class="input-group" onsubmit="regUporabnika(); return false">
					<label for="ID_uporabnika">ID uporabnika:</label><br>
					<input type="number_format" class="input-field" placeholder="---" name="ID_uporabnika" disabled/> <br>
					
					<label for="ime">Ime*:</label><br>
					<input type="text" class="input-field" name="ime" oninvalid="this.setCustomValidity('Unesite ime')" required/> <br>

					<label for="priimek">Priimek*:</label><br>
					<input type="text" class="input-field" name="priimek" oninvalid="this.setCustomValidity('Unesite priimek')" required/> <br>
					
					<label for="geslo">Geslo*:</label><br>
					<input type="password" class="input-field" name="geslo" oninvalid="this.setCustomValidity('Unesite geslo')" required/> <br>
					
					<label for="Datum_rojstva">Datum rojstva*:</label><br>
					<input type="date" class="input-field" name="Datum_rojstva" required/> <br>
					
					<label for="Spol">Spol (M - moški, Z - ženski)*:</label><br>
					<select id="Spol" class="input-field" name="Spol">
						<option value="M">Moški (M)</option>
						<option value="Z">Ženski (Z)</option>
					<select/> <br>
					
					<label for="Tel_stevilka">Telefonska številka*:</label><br>
					<input type="tel" class="input-field" name="Tel_stevilka" placeholder="060-456789" oninvalid="this.setCustomValidity('Unesite telefonsko številko')" required/> 
					<small>Format: 060-456789</small><br>
					
					<label for="email">Email*:</label><br>
					<input type="email" class="input-field" name="email" oninvalid="this.setCustomValidity('Unesite telefonsko elektronski naslov')" required/> <br>
									
					<label for="Paket">Paket*:</label><br>
					<select id="Paket" class="input-field" name="Paket">
						<option value="S">Paket S (10 termina)</option>
						<option value="M">Paket M (16 termina)</option>
						<option value="L">Paket L (20 termina)</option>
						<option value="X">Paket X (30 termina)</option>
					<select/> <br>
					<button type="submit" class="submit-btn">Registracija</button>
				<div id="odgovor"></div>
				</form>
				
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
