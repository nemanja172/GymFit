<?php
session_start();
unset($_SESSION['message']);
if(!isset($_SESSION['auth']))
{
	$_SESSION['message']='Za dostop je potrebna prijava';
	header("location:http://localhost/gymfit/index.php");
	exit(0);
}
else
{
	$currentTime = time();
	if($currentTime > $_SESSION['expire'])
	{
		session_destroy;
		unset($_SESSION['auth']);
		unset($_SESSION['user_level']);
		unset($_SESSION['auth_user']);
		$_SESSION['message']="Seja je potekla, prosim za prijavo";
		header("location:http://localhost/gymfit/index.php");
	}
	elseif($_SESSION['user_level'] !== "0")
	{
		$_SESSION['message']="Nemate pravico za vstop";
		header("location:http://localhost/gymfit/domacaAdmin.php");
		
	}
}

?>