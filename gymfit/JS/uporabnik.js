function podatkiUporabnika()
{
	var ID_uporabnika = document.getElementById("obrazec")["ID_uporabnika"].value;
	document.getElementById("odgovor").innerHTML = "";
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", "/gymfitAPI/uporabniki/"+ID_uporabnika, true);
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
		window.location.href ="../gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}												
}
function podatkiVsihUporabnika()
{
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){	
		
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("GET", "/gymfitAPI/uporabniki", true);	
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

function prikaziZaUrejanje(odgovorJSON)
{
	var obrazec = document.getElementById("posodobitev"); 
	
	obrazec.style.display = "block";
	
	obrazec.ime.value = odgovorJSON["ime"];
	obrazec.priimek.value = odgovorJSON["priimek"];
	obrazec.geslo.value = odgovorJSON["geslo"];
	obrazec.Datum_rojstva.value = odgovorJSON["Datum_rojstva"];
	obrazec.Spol.value = odgovorJSON["Spol"];
	obrazec.Tel_stevilka.value = odgovorJSON["Tel_stevilka"];
	obrazec.email.value = odgovorJSON["email"];
	obrazec.Paket.value = odgovorJSON["paket"];
	obrazec.user_level.value = odgovorJSON["user_level"];
}

const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});

function posodobiPodatke()
{
	const data = formToJSON(document.getElementById("posodobitev").elements);
	var JSONdata = JSON.stringify(data, null, "  ");
	var ID_uporabnika = document.getElementById("obrazec")["ID_uporabnika"].value;
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
	
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("PUT", "/gymfitAPI/uporabniki/"+ID_uporabnika, true);
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
	else
	{
		window.location.href ="../gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}	
}


function prikazi(odgovorJSON)
{
	var fragment = document.createDocumentFragment(); 		
	
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

function izbrisiUporabnika()
{
	var zeton = window.localStorage.getItem('access_token');
	var ID_uporabnika = document.getElementById("obrazec")["ID_uporabnika"].value;
	document.getElementById("odgovor").innerHTML = "";
	if(zeton != null && zeton != ""){
		
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("DELETE", "/gymfitAPI/uporabniki/"+ID_uporabnika, true);	
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
		window.location.href ="../gymfit/index.php";
		alert('Nimas pravice za dostop!');
	}		
}

