function podatkiUporabnika()
{
	var email = document.getElementById("obrazec")["email"].value;
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
				console.log("Napaka pri razčlenjevanju podatkov");
				return;
			}
			prikazi(odgovorJSON);
			//prikaziZaUrejanje(odgovorJSON);
		}
		if (this.readyState == 4 && this.status != 200)
		{
			document.getElementById("odgovor").innerHTML="Ni uspelo! " +this.status;
		}
	};
	 
	xmlhttp.open("GET", "http://192.168.64.109/gymfitAPI/uporabniki/"+email, true);							
	xmlhttp.send();													
}

function prikaziZaUrejanje(odgovorJSON)
{
	var obrazec = document.getElementById("posodobitev"); 
	
	obrazec.style.display = "block";
	
	obrazec.ID_uporabnika.value = odgovorJSON["ID_uporabnika"];
	obrazec.ime.value = odgovorJSON["ime"];
	obrazec.priimek.value = odgovorJSON["priimek"];
	obrazec.geslo.value = odgovorJSON["geslo"];
	obrazec.email.value = odgovorJSON["email"];
	obrazec.Paket.value = odgovorJSON["paket"];
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
	 
	var ID_uporabnika = document.getElementById("obrazec")["ID_uporabnika"].value;
	
	xmlhttp.open("PUT", "http://192.168.64.109/gymfitAPI/uporabniki/"+ID_uporabnika, true);							// določimo metodo in URL zahteve, izberemo asinhrono zahtevo (true)
	xmlhttp.send(JSONdata);	
}


function prikazi(odgovorJSON)
{
	var fragment = document.createDocumentFragment(); 		
	
	for(var stolpec in odgovorJSON) 
	{ 				
		var div = document.createElement("div");
		div.innerHTML = stolpec + ": " + odgovorJSON[stolpec]; 
		fragment.appendChild(div);
	}
	document.getElementById("odgovor").innerHTML="";
	document.getElementById("odgovor").appendChild(fragment);
}