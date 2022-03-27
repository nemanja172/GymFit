<?php
function dbConnect()
{
	$servername = "localhost";
	$username = "seminar";
	$password = "seminar";
	$dbname = "gymfit";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");
	
	if (mysqli_connect_errno())
	{
		printf("Povezovanje s podatkovnim strežnikom ni uspelo: %s\n", mysqli_connect_error());
		exit();
	} 	
	return $conn;
}


function pripravi_odgovor_napaka($vsebina)
{
	$odgovor=array(
		'status' => 0,
		'error_message'=>$vsebina
	);
	echo json_encode($odgovor);
}


function uporabnik_obstaja($email)
{	
	global $zbirka;
	$email=mysqli_escape_string($zbirka, $email);
	
	$poizvedba="SELECT * FROM uporabnik WHERE email='$email'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function u_obstaja($ID_uporabnika)
{	
	global $zbirka;
	$ID_uporabnika=mysqli_escape_string($zbirka, $ID_uporabnika);
	
	$poizvedba="SELECT * FROM uporabnik WHERE ID_uporabnika='$ID_uporabnika'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function fitnes_obstaja($ime)
{	
	global $zbirka;
	$ime=mysqli_escape_string($zbirka, $ime);
	
	$poizvedba="SELECT * FROM fitnes WHERE ime='$ime'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function f_obstaja($ID_fitnesa)
{	
	global $zbirka;
	$ID_fitnesa=mysqli_escape_string($zbirka, $ID_fitnesa);
	
	$poizvedba="SELECT * FROM fitnes WHERE ID_fitnesa='$ID_fitnesa'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}


function termin_obstaja($ID_termina)
{	
	global $zbirka;
	$ID_termina=mysqli_escape_string($zbirka, $ID_termina);
	
	$poizvedba="SELECT * FROM termin WHERE ID_termina='$ID_termina'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

function URL_vira($vir)
{
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	{
		$url = "https"; 
	}
	else
	{
		$url = "http"; 
	}
	$url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $vir;
	
	return $url; 
}

function preveri_zeton($email, $geslo)
{
	global $zbirka, $DEBUG;	
	$email=mysqli_escape_string($zbirka, $email);
	$geslo=mysqli_escape_string($zbirka, $geslo);
	
	if(uporabnik_obstaja($email))
	{
		$headers = apache_request_headers();	

		// preverimo, ce je prisotno polje Authorization
		if(isset($headers['Authorization'])) {
			$headers = trim($headers["Authorization"]);
			
			// preverimo, ce je vrsta avtentikacije 'Bearers', in shranimo zeton
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				
				// preverimo, ce je zeton v bazi ujema z zetonom v brskalniku, potem preverimo 
				if($matches[1] == hash("md5", $email.$geslo)){
					//sql stavek
					$sql = "SELECT * from uporabnik where token = '$matches[1]'";
					echo "Uporabnik je authoriziran";	
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
	else
	{
		echo "Uporabnik ne obstaja!";
		http_response_code(404);
	}
}
?>