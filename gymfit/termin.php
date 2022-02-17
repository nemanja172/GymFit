<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Termini uporabnika</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
	<?php include('../gymfitAPI/authenticationu.php'); 
	$ID_uporabnika = $_SESSION['auth_user']['ID_uporabnika'];?>
	<script src="js/termin.js"></script>
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
	<body onload="terminUporabnika();">
		<?php include "Meni.html"?>
		<center>
			<p>Na tej strani lahko preverite uporabljene termine. </p>
		<div class="container">
			<input type="hidden" id="hidden" name="hidden" value="<?php echo $ID_uporabnika;?>">
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