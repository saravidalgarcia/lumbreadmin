/**
 * Se comprueba que el usuario esté autenticado y, si no es así, se le redirige a
 * la página de login
 */
window.onload = () => {
    if (localStorage.getItem("username") == null)
        window.location.replace("https://lumbreadmin.es/login");
}

//Cierre de sesión
function logout(){
    localStorage.removeItem("username");
    location.replace("https://lumbreadmin.es/login");
}

//Validación de contraseña
function validarPassword(passwd,passwd2){
	//Contraseña de 8 o más caracteres, una mayúscula, una minúscula y un número
    let patron = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwd.match(patron)) {
        document.getElementById("mensaje-feedback").innerHTML = "La contraseña debe tener 8 o más caracteres, y contener mayúsculas, minúsculas y números.";
        return false;
    }
    //Contraseñas coincidentes
    if (passwd != passwd2) {
        document.getElementById("mensaje-feedback").innerHTML = "Las contraseñas introducidas deben coincidir.";
        return false;
    }
	return true;
}

function updatePassword(){
    passwd = document.formUpdatePassword.passwd.value;
	passwdn = document.formUpdatePassword.passwdn.value;
    passwdn2 = document.formUpdatePassword.passwdn2.value;
	
    if (!validarPassword(passwdn,passwdn2)){
		document.formUpdatePassword.passwdn.focus();
		return;
	}
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "cambiarpassword", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username=" + localStorage.getItem("username")+
            "&passwd="+passwd+
            "&passwdn="+passwdn);
    xhr.addEventListener("readystatechange", (e) => {
        if (xhr.readyState !== 4) return;
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log(xhr.response);
            let resultado = xhr.response.charAt(0);
            switch(resultado){
                case "0": document.getElementById("mensaje-feedback").innerHTML = "No se ha podido recuperar la información del empleado";break;
                case "1":
                    document.formUpdatePassword.passwd.focus(); 
                    document.getElementById("mensaje-feedback").innerHTML = "La contraseña introducida es incorrecta";
                    break;
                case "2":
                    alert("La contraseña se ha actualizado con éxito");
                    location.replace("http://localhost/prueba/public/usuarios");
                    break;
                default: document.getElementById("mensaje-feedback").innerHTML = "Se ha producido un error";
            }
        }
        else {
            console.log("Error " + xhr.status);
        }
    });
}