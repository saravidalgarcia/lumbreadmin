window.onload = () => {
    document.getElementById("main").classList.remove("contenido");
	document.getElementById("main").classList.add("about");
    document.getElementById("menu-ppal").style.visibility="hidden";
    document.getElementById("menu-ppal").style.display="none";
    document.getElementById("cabecera-info").style.flexFlow="column nowrap";
    if (localStorage.getItem("username") == null){
        document.getElementById("header-ppal").style.visibility="hidden";
        document.getElementById("header-ppal").style.display="none";
    }
    else
	    document.getElementById("username").innerHTML = localStorage.getItem("username");
}