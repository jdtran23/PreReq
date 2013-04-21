function login(){ 
	document.getElementById("navbar-login").setAttribute("class", "hidden");
	document.getElementById("navbar-logout").setAttribute("class", "visible");
	alert("I am an alert box!");
} 

function logout(){ 
	document.getElementById("navbar-login").setAttribute("class", "visible");
	document.getElementById("navbar-logout").setAttribute("class", "hidden");
} 



