<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>GymFit | Prva stran</title>
		<link rel="stylesheet" type="text/css" href="stil.css"/>
		<?php include('../gymfitAPI/authenticationu.php'); ?>
		<style>
		#slika {
			width: 50%;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		h1 {
			font-size: 200%;
			text-align:center;
		}
		p {
			font-size: 120%;
		}
		</style>
	</head>
	<body>
		<div class="center">
			<?php include("Meni.html");?>
			<!-- <h1>Dobrodošli na spletno stran GymFit </h1> --> 
			<?php include('../gymfitAPI/message.php'); ?>
			<p>Zdravo, <?php echo $_SESSION['auth_user']['ime']; ?>, aplikacija GymFit vam omogoča trening v različnih objektih v celi državi. Sistem omogoča najlažji dostop do vaših najljubših športnih centrov. </p>
			<p> Vadite v različnih objektih po celotni Sloveniji.</p>
			<p>	Ena članarina zadostuje za vse vaše fitnes potrebe!</p>
			<img src="images/training.jpg" id="slika"/>
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