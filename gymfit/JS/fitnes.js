/**
 * Pridobi podatke iz obrazca in jih vrne v obliki JSON objekta.
 * @param  {HTMLFormControlsCollection} elements  Elementi obrazca
 * @return {Object}                               Object literal
 */
function fitnesi()
{
	var xmlhttp = new XMLHttpRequest();										
	 
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
	 
	xmlhttp.open("GET", "/gymfit/fitnesi", true);							
	xmlhttp.send();													
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
	var ID_fitnesa = document.getElementById("obrazec")["ID_fitnesa"].value;
	document.getElementById("odgovor").innerHTML = "";
	
	var xmlhttp = new XMLHttpRequest();										 
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
	 
	xmlhttp.open("GET", "/gymfit/fitnesi/"+ID_fitnesa, true);							
	xmlhttp.send();													
}	

function posodobiPodatke()
{
	const data = formToJSON(document.getElementById("posodobitev").elements);	// vsebino obrazca pretvorimo v objekt
	var JSONdata = JSON.stringify(data, null, "  ");						// objekt pretvorimo v znakovni niz v formatu JSON
	
	var xmlhttp = new XMLHttpRequest();										// ustvarimo HTTP zahtevo
	 
	xmlhttp.onreadystatechange = function()									// določimo odziv v primeru različnih razpletov komunikacije
	{
		if (this.readyState == 4 && this.status == 204)						// zahteva je bila uspešno poslana, prišel je odgovor 201
		{
			document.getElementById("odgovor").innerHTML="Posodobitev uspela!";
		}
		if(this.readyState == 4 && this.status != 204)						// zahteva je bila uspešno poslana, prišel je odgovor, ki ni 201
		{
			document.getElementById("odgovor").innerHTML="Posodobitev ni uspela: "+this.status;
		}
	};
	 
	var ID_fitnesa = document.getElementById("obrazec")["ID_fitnesa"].value;
	
	xmlhttp.open("PUT", "/gymfit/fitnesi/"+ID_fitnesa, true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send(JSONdata);	
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

const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});
