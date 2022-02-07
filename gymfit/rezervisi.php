<?php
	$ID_uporabnika= $_POST["ID_uporabnika"];
	$ID_fitnesa=$_POST["ID_fitnesa"];
	$datum=$_POST["datum"];

	$zbirka = mysqli_connect('localhost','root','','gymfit');
	if(mysqli_connect_error()){
		die('Povezovanje s podatkovnim strežnikom ni uspelo: %s\n'.$conn->connect_error);
	}else{
		$stmt = $zbirka->prepare("insert into termin(ID_uporabnika, ID_fitnesa, datum)
			values(?, ?, ?)");
		$stmt->bind_param("iis",$ID_uporabnika, $ID_fitnesa, $datum);
		$stmt->execute();
		header("location:uspesnarezervacija.php");
		$stmt->close();
		$zbirka->close();
	}
?>