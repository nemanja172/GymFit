<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Moj Profil</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
	<?php include('../gymfitAPI/authenticationu.php'); ?>
	<style>
		#tabela {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#tabela td, #tabela th {
			border: 3px solid #ddd;
			padding: 8px;
		}

		#tabela tr:nth-child {background-color: #f2f2f2;}

		#tabela tr:hover {background-color: #ddd;}

		#tabela th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #ffe5b4;
			color: black;
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
		p {
			font-size: 120%;
		}
		h1 {
			font-size: 200%;
			text-align:center;
		}
		input {
			border: 3px solid;
			border-radius: 10px;
		}
	</style>
	</head>
	<body>
		<?php include "Meni.html"?>
		<center>
			<p> Preverite svoje osebne podatke. Za spremembo podatkov kontaktirajte odgovorno osebo. </p>
		<div class="container">
			<table id="tabela">
							<tr>
								<th>ID Uporabnika</th>
								<th>Ime</th>
								<th>Priimek</th>
								<th>Datum rojstva</th>
								<th>Telefonska stevilka</th>
								<th>Paket</th>
							</tr><br>
							<tr>
								<td style='width:150px'><?php echo $_SESSION['auth_user']['ID_uporabnika']; ?> </td>
								<td><?php echo $_SESSION['auth_user']['ime']; ?> </td>
								<td><?php echo $_SESSION['auth_user']['priimek']; ?> </td>
								<td><?php echo $_SESSION['auth_user']['Datum_rojstva']; ?> </td>
								<td><?php echo $_SESSION['auth_user']['Tel_stevilka']; ?> </td>
								<td><?php echo $_SESSION['auth_user']['Paket']; ?> </td>
							</tr>
			</table>
		</center>
	</body>
</html>
