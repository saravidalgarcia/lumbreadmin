window.onload = () => {
    if (localStorage.getItem("username") == null){
        document.getElementById("header-ppal").style.visibility="hidden";
        document.getElementById("header-ppal").style.display="none";
        document.getElementById("menu-ppal").style.visibility="hidden";
        document.getElementById("menu-ppal").style.display="none";
        document.getElementById("info").style.paddingLeft="3%";
    }
    else
	    document.getElementById("username").innerHTML = localStorage.getItem("username");
}