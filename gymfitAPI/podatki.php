<?php 
	session_start();
	$DEBUG = true;							// Priprava podrobnejših opisov napak (med testiranjem)

	include("orodja.php"); 					// Vključitev 'orodij'

	header('Content-Type: application/json');	

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT');
	
	//$zbirka = dbConnect();					// Pridobitev povezave s podatkovno zbirko
	if($_SERVER["REQUEST_METHOD"]=='GET')
	{	
		$email = $_SESSION['auth_user']['email'];
		$geslo = $_SESSION['auth_user']['geslo'];

		// uporabimo funkcijo apache_request_headers(), ker spremenljivka $_SERVER ne vsebuje vseh polj zaglavja (headerja)
		$headers = apache_request_headers();	

		// preverimo, ce je prisotno polje Authorization
		if(isset($headers['Authorization'])) {
			$headers = trim($headers["Authorization"]);
			
			// preverimo, ce je vrsta avtentikacije 'Bearers', in shranimo zeton
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				
				// preverimo, ce je zeton veljaven
				if($matches[1] == hash("md5", $email.$geslo)){
					echo $_SESSION['auth_user']['ime'];	
					//echo json_encode(array('ID_uporabnika'=>$_SESSION['auth_user']['ID_uporabnika'],'ime'=>$_SESSION['auth_user']['ime']));

				}
				else{
					echo "Ni pravega žetona, ni pravih podatkov!";
					http_response_code(401);
				}
			}
			else{
				echo "Ni žetona, ni podatkov!";
				http_response_code(401);
			}
		}
		else{
			echo "Ni žetona, ni podatkov!";
			http_response_code(401);
		}
	}
?>