function userImages(){
	var userID = document.getElementById("form")["userID"].value;

	var httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 201)	{
			try{
				var responseJASON = JSON.parse(this.response);
			}
			catch(e){
				console.log("Napaka pri razčlenjevanju podatkov");
				return;
			}
			clearImages();
			responseJASON.forEach(element => getImage(element.path, element.imageName));
		}
	};
	 
	httpRequest.open("GET", "/application/images/"+userID, true);
	httpRequest.send();
}

function getImage(imagePath, imageName) {
	let div = document.createElement('div');
    var img = document.createElement('IMG');
    img.src = imagePath;
	let text = document.createTextNode(imageName);
	div.appendChild(text);
	div.appendChild(img);
    document.getElementById('result').appendChild(div);
}

function clearImages(){
	document.getElementById('result').innerHTML = "";
}
