function prevPrijavo() 
{
	var zeton = window.localStorage.getItem('access_token');
	var level = window.localStorage.getItem('user_level');
	if(zeton != null && zeton != "" && level == "0" ){
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "http://192.168.64.109/gymfitAPI/podatki.php");	// vpisemo URL nekega vira v API-ju zaledja

		xhr.setRequestHeader("Accept", "application/json");
			
		// Iz lokalne shrambe pridobimo shranjen zeton in ga vstavimo v zaglavje (header) HTTP sporocila v polje Authorization
		// Vrsta avtentikacije - 'Bearer' - je primerna za prenasanje zetonov
		xhr.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));

		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				document.getElementById("prikaz").innerHTML = "Zdravo " + xhr.responseText;
			}};

		xhr.send();					
	}
	else{
		window.location.href ="http://localhost/gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}
}