<?php
	$ime= $_POST["ime"];
	$priimek=$_POST["priimek"];
	$geslo=$_POST["geslo"];
	$Datum_rojstva=$_POST["Datum_rojstva"];
	$Spol=$_POST["Spol"];
	$Tel_stevilka=$_POST["Tel_stevilka"];
	$email=$_POST["email"];
	$Paket=$_POST["Paket"];
		
	$zbirka = mysqli_connect('localhost','root','','gymfit');
	if(mysqli_connect_error()){
		die('Povezovanje s podatkovnim strežnikom ni uspelo: %s\n'.$conn->connect_error);
	}else{
		$stmt = $zbirka->prepare("insert into uporabnik(ime, priimek, geslo, Datum_rojstva, Spol, Tel_stevilka,email, Paket)
			values(?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssss",$ime, $priimek, $geslo, $Datum_rojstva, $Spol, $Tel_stevilka, $email, $Paket);
		$stmt->execute();
		header("location:uspesna.php");
		$stmt->close();
		$zbirka->close();
	}
?>