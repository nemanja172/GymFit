<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Gymfit | Termini uporabnika</title>
	<link rel="stylesheet" type="text/css" href="stil.css" />
	<style>
		#tabela {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#tabela td, #tabela th {
			border: 3px solid #ddd;
			border-collapse: collapse;
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
			border-collapse: collapse;
			width: 10%;
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
	<body>
		<?php include "Meni.html"?>
		<center>
			<p>Z vnosom e-maila lahko preverite uporabljene termine. </p>
		<div class="container">
			<form action="" method="POST">
				<input type="text" name="email" placeholder="Vnesite Vas e-mail" />
				<input type="submit" id='button' name="search" value="Iskanje"/>
			</form>
			<table id="tabela">
							<tr>
								<th>Številka termina</th>
								<th>Ime fitnesa</th>
								<th>Datum</th>
							</tr><br>
						<?php
						$connection = mysqli_connect("localhost","root","");
						$db = mysqli_select_db($connection,'gymfit');
						
						if(isset($_POST['search']))
						{
							$email = $_POST['email'];
							
							$query = "SELECT f.Ime as Ime_fitnesa, t.datum as Datum FROM termin t join fitnes f ON(t.ID_fitnesa = f.ID_fitnesa) join uporabnik u ON(u.ID_uporabnika = t.ID_uporabnika) WHERE u.email='$email' ORDER BY Datum";
							$query_run = mysqli_query($connection,$query);
							if (!$query_run) {
								printf("Error: %s\n", mysqli_error($connection));
							exit();
}
							$no = 0;
							while($row = mysqli_fetch_array($query_run))
							{
								$no++;
								?>
								<tr>
									<td><?php echo $no; ?> </td>
									<td><?php echo $row['Ime_fitnesa']; ?> </td>
									<td><?php echo $row['Datum']; ?> </td>
								</tr>
								<?php
							}
							$sql = "SELECT COUNT(*) as 'stevilo', ime, priimek, Paket, CASE WHEN Paket = 'S' THEN 10 WHEN Paket = 'M' THEN 16 WHEN Paket = 'L' THEN 20 WHEN Paket = 'X' THEN 30 END AS preostalo from uporabnik INNER JOIN termin on uporabnik.ID_uporabnika=termin.ID_uporabnika where email = '$email'";
							$sql2 = "";
							$result = mysqli_query($connection, $sql);

							if (mysqli_num_rows($result) > 0) {
								// output data of each row
								while($row = mysqli_fetch_assoc($result)) {
								echo "Število uporabljenih terminov je: " . $row["stevilo"]. " - Uporabil/a jih je: " . $row["ime"]. " " . $row["priimek"]. "<br> Število terminov v izbranem paketu: " . $row["preostalo"];
								}
							} else {
								echo "Ni uporabljenih terminov";
							}
						}
						?>
			</table>
		</center>
	</body>
</html>