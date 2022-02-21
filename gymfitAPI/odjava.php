<?php
session_start();

if(isset($_POST['logout_btn']))
{
	unset($_SESSION['auth']);
	unset($_SESSION['user_level']);
	unset($_SESSION['auth_user']);
	//session_destroy();
	$_SESSION['message'] = "Uspesna odjava";
	header("location:http://localhost/gymfit/index.php");
	exit(0);
	
}




?>