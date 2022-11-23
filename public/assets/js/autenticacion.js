window.onload = () => {
    if (localStorage.getItem("username") != null)
        window.location.replace("https://lumbreadmin.es/usuarios");
}

function login() {
    let username = document.formLogin.username.value;
    let password = document.formLogin.passwd.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "checklogin", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username=" + username + "&passwd=" + password);
    xhr.addEventListener("readystatechange", (e) => {
        if (xhr.readyState !== 4) return;
        if (xhr.status >= 200 && xhr.status < 300) {
            let resultado = xhr.response.charAt(0);
            switch(resultado){
                case "0": document.getElementById("mensaje-feedback").innerHTML = "El usuario introducido no existe";break;
                case "1": document.getElementById("mensaje-feedback").innerHTML = "Usuario o contraseña incorrectos";break;
                case "2":
                    localStorage.username = username; 
                    location.replace("https://lumbreadmin.es/usuarios");
                    break;
                default: document.getElementById("mensaje-feedback").innerHTML = "Se ha producido un error";
            }
        }
        else {
            console.log("Error " + xhr.status);
        }
    });
}