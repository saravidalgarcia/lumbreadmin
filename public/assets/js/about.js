/**
 * LumbreAdmin - Funciones de la página de información y contacto
 * 
 * @author Sara Vidal García
 */

const baseURL = "https://lumbreadmin.es/";

/**
 * Se comprueba que el usuario si el usuario está autenticado y, si no lo está,
 * se ocultan la cabecera y el menú principal
 */
window.onload = () => {
    if (localStorage.getItem("admin") == null) {
        document.getElementById("header-ppal").style.visibility = "hidden";
        document.getElementById("header-ppal").style.display = "none";
        document.getElementById("menu-ppal").style.visibility = "hidden";
        document.getElementById("menu-ppal").style.display = "none";
        document.getElementById("info").style.paddingLeft = "3%";
    }
    else
        document.getElementById("username").innerHTML = localStorage.getItem("admin");
}

/**
 * Cierra la sesión del usuario y lo redirige a la página de login
 */
function logout() {
    localStorage.removeItem("admin");
    location.replace(baseURL + "login");
}