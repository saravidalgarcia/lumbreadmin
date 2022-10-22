function acceder() {
    let username = document.formAcceso.username.value;
    let password = document.formAcceso.password.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "?m=login", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username=" + username + "&passwd=" + password);
    xhr.addEventListener("readystatechange", (e) => {
        if (xhr.readyState !== 4) return;
        if (xhr.status >= 200 && xhr.status < 300) {
            if (xhr.response.slice(-1) == "1")
                location.reload();
            else
                document.getElementById("mensaje-feedback").innerHTML = "Usuario o contraseña incorrectos";
        }
        else {
            console.log("Error " + xhr.status);
        }
    });
}