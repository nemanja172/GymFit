/**
 * Pridobi podatke iz obrazca in jih vrne v obliki JSON objekta.
 * @param  {HTMLFormControlsCollection} elements  Elementi obrazca
 * @return {Object}                               Object literal
 */
function fitnesi()
{
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", "/gymfitAPI/fitnesi", true);		
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 200)						
			{
				try
				{
					var odgovorJSON = JSON.parse(this.responseText);
				}
				catch(e)
				{
					console.log("Napaka pri razčlenjevanju podatkov");
					return;
				}
				prikazi(odgovorJSON);
			}
		};						
		xmlhttp.send();
	}
	else
	{
		window.location.href ="../gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}														
}


function prikazi(odgovorJSON)
{
	var fragment = document.createDocumentFragment (); 		
	
	for(var i=0; i<odgovorJSON.length; i++) 
	{ 				
		var tr = document.createElement("tr");
	
		for (var stolpec in odgovorJSON[i])
		{
			var td = document.createElement("td"); 
			td.innerHTML = odgovorJSON[i][stolpec]; 
			tr.appendChild(td);
		}
		fragment.appendChild(tr);
	}
	document.getElementById("tabela").appendChild(fragment);
}

function podatkiFitnesa()
{
	var zeton = window.localStorage.getItem('access_token');
	var ID_fitnesa = document.getElementById("obrazec")["ID_fitnesa"].value;
	document.getElementById("odgovor").innerHTML = "";
	if(zeton != null && zeton != ""){
		
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", "/gymfitAPI/fitnesi/"+ID_fitnesa, true);
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 200)						
			{
				try
				{
					var odgovorJSON = JSON.parse(this.responseText);
				}
				catch(e)
				{
					console.log("Napaka pri razclenjevanju podatkov");
					return;
				}
				//prikazi(odgovorJSON);
				prikaziZaUrejanje(odgovorJSON);
			}
			if (this.readyState == 4 && this.status != 200)
			{
				document.getElementById("odgovor").innerHTML="Ni uspelo! " +this.status;
			}
		};						
		xmlhttp.send();
	}
	else{
		window.location.href ="../gymfit/domacaAdmin.php";
		alert('Nimas pravice za dostop!');
	}
}	

function posodobiPodatke()
{
	const data = formToJSON(document.getElementById("posodobitev").elements);	
	var JSONdata = JSON.stringify(data, null, "  ");	
	var ID_fitnesa = document.getElementById("obrazec")["ID_fitnesa"].value;	
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
	
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("PUT", "/gymfitAPI/fitnesi/"+ID_fitnesa, true); 
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 204)						
			{
				document.getElementById("odgovor").innerHTML="Posodobitev uspela!";
			}
			if(this.readyState == 4 && this.status != 204)						
			{
				document.getElementById("odgovor").innerHTML="Posodobitev ni uspela: "+this.status;
			}
		};						
		xmlhttp.send(JSONdata);	
	}
	else{
		window.location.href ="../gymfit/domacaAdmin.php";
		alert('Nimas pravice za dostop!');
	}
}

function prikaziZaUrejanje(odgovorJSON)
{
	var obrazec = document.getElementById("posodobitev"); 
	
	obrazec.style.display = "block";
	
	obrazec.ime.value = odgovorJSON["ime"];
	obrazec.lokacija.value = odgovorJSON["lokacija"];
	obrazec.naslov.value = odgovorJSON["naslov"];
	obrazec.tip.value = odgovorJSON["tip"];
}

function izbrisiFitnes()
{
	var zeton = window.localStorage.getItem('access_token');
	var ID_fitnesa = document.getElementById("obrazec")["ID_fitnesa"].value;
	document.getElementById("odgovor").innerHTML = "";
	if(zeton != null && zeton != ""){
		
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("DELETE", "/gymfitAPI/fitnesi/"+ID_fitnesa, true);	
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		
		{
			if (this.readyState == 4 && this.status == 204)						
			{
				document.getElementById("odgovor").innerHTML="Brisanje uspelo!";
			}
			if (this.readyState == 4 && this.status != 204)
			{
				document.getElementById("odgovor").innerHTML="Ni uspelo! " +this.status;
			}
		};		
		xmlhttp.send();	
	}
	else{
		window.location.href ="../gymfit/domacaAdmin.php";
		alert('Nimas pravice za dostop!');
	}		
}

const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});
