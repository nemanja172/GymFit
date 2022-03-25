/**
 * Pridobi podatke iz obrazca in jih vrne v obliki JSON objekta.
 * @param  {HTMLFormControlsCollection} elements  Elementi obrazca
 * @return {Object}                               Object literal
 */
const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});
 
function dodajUporabnika()
{
	var zeton = window.localStorage.getItem('access_token');
	const data = formToJSON(document.getElementById("register").elements);	
	var JSONdata = JSON.stringify(data, null, "  ");						
	if(zeton != null && zeton != ""){
	
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("POST", "/gymfitAPI/uporabniki", true);
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 201)						
			{
				document.getElementById("odgovor").innerHTML="Dodajanje uspelo!";
			}
			if(this.readyState == 4 && this.status != 201)						
			{
				document.getElementById("odgovor").innerHTML="Dodajanje ni uspelo: "+this.status;
			}
		};						
		xmlhttp.send(JSONdata);		
	}
	else
	{
		window.location.href ="../gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}		
}
