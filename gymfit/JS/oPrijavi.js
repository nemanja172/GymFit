function oPrijavi() 
{
	var zeton = window.localStorage.getItem('access_token');
	var level = window.localStorage.getItem('user_level');
	if(zeton != null && zeton != "")
	{
		if (level == '1')
		{
			window.location.href ="http://localhost/gymfit/domacaAdmin.php";
		}
		else
		{
			window.location.href ="http://localhost/gymfit/domaca.php";
		}
	}
	else
	{
	//window.location.href ="http://localhost/gymfit/index.php";
	}
}