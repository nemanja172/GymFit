<?php
	include('dbConnect.php');
	$conn = dbConnect();
	$stmt = $conn->prepare("SELECT ID_fitnesa, ime, lokacija, naslov, tip FROM fitnes");

	$stmt->execute();
	$stmt->bind_result($ID_fitnesa, $Ime, $Lokacija, $Naslov, $Tip);
	
	$fitnesi = array();
	
	while($stmt -> fetch()){
		
		$temp = array();
		
		$temp['ID_fitnesa'] = $ID_fitnesa;
		$temp['Ime'] = $Ime;
		$temp['Lokacija'] = $Lokacija;
		$temp['Naslov'] = $Naslov;
		$temp['Tip'] = $Tip;
		
		array_push($fitnesi,$temp);
		}
		
		echo json_encode($fitnesi)		
?>