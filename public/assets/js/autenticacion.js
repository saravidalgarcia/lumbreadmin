/**
 * LumbreAdmin - Funciones de las páginas relacionadas con el control de acceso
 * 
 * @author Sara Vidal García
 */

const baseURL = "https://lumbreadmin.es/";

/**
 * Se comprueba que el usuario si el usuario está autenticado y, si lo está, se le redirige a
 * la página de gestión de usuarios
 */
window.onload = () => {
    if (localStorage.getItem("username") != null)
        window.location.replace(baseURL + "usuarios");
}

/**
 * Lee la información introducida en el formulario de inicio de sesión,
 * llama al controlador para validar que es correcta y gestiona la respuesta
 */
function login() {
    let username = document.formLogin.username.value;
    let password = document.formLogin.passwd.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", baseURL + "checklogin", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username=" + username + "&passwd=" + password);
    xhr.addEventListener("readystatechange", (e) => {
        if (xhr.readyState !== 4) return;
        if (xhr.status >= 200 && xhr.status < 300) {
            //Si el controlador devuelve un 0, el username introducido no está en el sistema
            //Si el controlador devuelve un 1, la cuenta existe pero el username y la contraseña no coinciden
            //Si el controlador devuelve un 2, el login es correcto y se redirige al usuario
            let resultado = xhr.response.charAt(0);
            switch (resultado) {
                case "0": document.getElementById("mensaje-feedback").innerHTML = "El usuario introducido no existe"; break;
                case "1": document.getElementById("mensaje-feedback").innerHTML = "Usuario o contraseña incorrectos"; break;
                case "2":
                    localStorage.username = username;
                    location.replace(baseURL + "usuarios");
                    break;
                default: document.getElementById("mensaje-feedback").innerHTML = "Se ha producido un error";
            }
        }
        else {
            console.log("Error " + xhr.status);
        }
    });
}