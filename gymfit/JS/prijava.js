
function prijava() 
{
	var params = "email=" + document.getElementById("email").value + "&geslo=" + document.getElementById("geslo").value;

	var xhr= new XMLHttpRequest();
	xhr.open("POST", "/gymfitAPI/prijava.php", true); // vpisemo URL mesta za avtentikacijo v API-ju zaledja
	xhr.setRequestHeader("Accept", "application/json");
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function () {
	   if (xhr.readyState === 4) 
	   {
			if(xhr.status === 200) 
			{
				var response = JSON.parse(xhr.responseText);
				console.log(response);
				window.localStorage.setItem("access_token", response["token"]);	//zeton shranimo v lokalno shrambo
				window.localStorage.setItem("ID_uporabnika", response["ID_uporabnika"]);
				oPrijavi();	// posodobimo spletno stran
			}
			else{
				alert("Prijava ni uspela! Napacen email ali geslo");
			}
	   }};
	   
	xhr.send(params);
}
