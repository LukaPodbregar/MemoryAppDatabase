const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});
 
function addUser() // Function used to add users with browser interface
{
	const data = formToJSON(document.getElementById("form").elements);
	var JSONdata = JSON.stringify(data, null, "  ");					
	
	var xmlhttp = new XMLHttpRequest();										
	 
	xmlhttp.onreadystatechange = function()									
	{
		if (this.readyState == 4 && this.status == 201)						
		{
			document.getElementById("result").innerHTML="User added successfully!";
		}
		if(this.readyState == 4 && this.status != 201)						
		{
			document.getElementById("result").innerHTML="Error adding new user: "+this.status;
		}
	};
	 
	xmlhttp.open("POST", "/application/users", true);						
	xmlhttp.send(JSONdata);												
}