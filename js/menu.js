function myFunction(){
	var x = document.getElementById("nav");
	if (x.className == "myTopnav"){
		x.className += " responsive";
	}else{
		x.className ="myTopnav";
	}
}