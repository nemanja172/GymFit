/*const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});*/
 
function registracija() 
{
	const data = formToJSON(document.getElementById("register").elements);	
	var JSONdata = JSON.stringify(data, null, "  ");
	//var params = "ime=" + document.getElementById("ime").value + "&priimek=" + document.getElementById("priimek").value + "&geslo=" + document.getElementById("geslo").value + "&Datum_rojstva=" + document.getElementById("Datum_rojstva").value + "&Spol=" + document.getElementById("Spol").value + "&tel=" + document.getElementById("tel").value + "&email=" + document.getElementById("email").value + "&Paket=" + document.getElementById("Paket").value;

	var xhr= new XMLHttpRequest(); 
	
	xhr.onreadystatechange = function () 
	{
	   if (this.readyState == 4 && this.status == 201)						
		{
			document.getElementById("odgovor").innerHTML="Dodajanje uspelo! Prijavi se";
		}
		if(this.readyState == 4 && this.status != 201)						
		{
			document.getElementById("odgovor").innerHTML="Dodajanje ni uspelo: "+this.status;
		}
	};
	xhr.open("POST", "http://192.168.64.109/gymfitAPI/uporabniki", true);
	xhr.send(params);
}
