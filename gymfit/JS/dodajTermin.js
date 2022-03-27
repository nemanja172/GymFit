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
 
function dodajTermin()
{
	var zeton = window.localStorage.getItem('access_token');
	const data = formToJSON(document.getElementById("obrazec").elements);	
	var JSONdata = JSON.stringify(data, null, "  ");	
	if(zeton != null && zeton != ""){
	
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("POST", "/gymfitAPI/termini", true); 
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 201)						
			{
				document.getElementById("odgovor").innerHTML="Rezervacija uspela!";
			}
			if(this.readyState == 4 && this.status != 201)						
			{
				document.getElementById("odgovor").innerHTML="Rezervacija ni uspela: "+this.status;
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