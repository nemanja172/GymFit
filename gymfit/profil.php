<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Moj Profil</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
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
			<p> Preverite svoje podatke z vnosom e-maila: </p>
		<div class="container">
			<form action="" method="POST">
				<input type="text" name="email" placeholder="Vnesite Vas e-mail" />
				<input type="submit" id='button' name="search" value="Iskanje"/>
			</form>
			<table id="tabela">
							<tr>
								<th>ID Uporabnika</th>
								<th>Ime</th>
								<th>Priimek</th>
								<th>Datum rojstva</th>
								<th>Telefonska stevilka</th>
								<th>Paket</th>
							</tr><br>
						<?php
						$connection = mysqli_connect("localhost","root","");
						$db = mysqli_select_db($connection,'gymfit');
						
						if(isset($_POST['search']))
						{
							$email = $_POST['email'];
							
							$query = "SELECT ID_uporabnika, ime, priimek, Datum_rojstva, Tel_stevilka, Paket FROM uporabnik WHERE email='$email' ";
							$query_run = mysqli_query($connection,$query);
							if (!$query_run) {
								printf("Error: %s\n", mysqli_error($connection));
							exit();
}
							
							while($row = mysqli_fetch_array($query_run))
							{
								?>
								<tr>
									<td><?php echo $row['ID_uporabnika']; ?> </td>
									<td><?php echo $row['ime']; ?> </td>
									<td><?php echo $row['priimek']; ?> </td>
									<td><?php echo $row['Datum_rojstva']; ?> </td>
									<td><?php echo $row['Tel_stevilka']; ?> </td>
									<td><?php echo $row['Paket']; ?> </td>
								</tr>
								<?php
							}
						}
						?>
			</table>
		</center>
	</body>
</html>
