function prevPrijavo() 
{
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "/gymfitAPI/podatki.php");	// vpisemo URL nekega vira v API-ju zaledja

		xhr.setRequestHeader("Accept", "application/json");
		xhr.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));

		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				var level = xhr.responseText;
				if(level == '0')
				{
					alert('Nimas administratorske pravice za dostop!');
					window.location.href ="http://localhost/gymfit/domaca.php";
				}
			}
		};
		xhr.send();					
	}
	else{
		window.location.href ="http://localhost/gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}
}