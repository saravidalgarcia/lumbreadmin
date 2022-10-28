//Por defecto, se carga la tabla con los usuarios en la página
addEventListener('load', verAdmins, false);

function verAdmins() {
	$.ajax({
		type: 'GET',
		url: '?m=set_admins',
		success: function (response) {
			$("#listado").html(response);
		}
	});
}

//Validación de DNI
function validarDNI(dni){
	let patron = /^\d{8}[A-Za-z]$/;
    dni = dni.toUpperCase();
    if(dni.match(patron)){
		let letras = 'TRWAGMYFPDXBNJZSQVHLCKET'; 
		let letra = dni.substr(dni.length-1, 1);
        let numero = dni.substr(0,dni.length-1);
        numero = numero % 23;
        if (letra != letras.substring(numero, numero+1)) {
            document.getElementById("mensaje-feedback").innerHTML = "El DNI es incorrecto.";
            return false;
        }else{
            return true;
        }
    }else{
        document.getElementById("mensaje-feedback").innerHTML = "El formato del DNI debe ser de 8 números y una letra.";
        return false;
    }
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

//Comprobación de que no hay duplicados
function validarDatos(dni, username, email) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			type: 'GET',
			url: '?m=get_admins',
			success: function (response) {
				let respuesta = JSON.parse(response);
				if (respuesta.length == 0) resolve(true);
				else
					for (let i = 0; i < respuesta.length; i++) {
                        if (respuesta[i].dni == dni) {
							document.getElementById("mensaje-feedback").innerHTML = "Este DNI ya está registrado en el sistema.";
							resolve(false);
							return;
						}
						if (respuesta[i].username == username) {
							document.getElementById("mensaje-feedback").innerHTML = "Este username ya está registrado en el sistema.";
							resolve(false);
							return;
						}
						if (respuesta[i].email == email) {
							document.getElementById("mensaje-feedback").innerHTML = "Este email ya está registrado en el sistema.";
							resolve(false);
							return;
						}
					}
					document.getElementById("mensaje-feedback").innerHTML = "";
					resolve(true);
			},
			error: function (err) {
				reject(err);
			}
		});
	});
}

function crearAdmin() {
    let dni = document.formCrearAdmin.dni.value;
    let nombre = document.formCrearAdmin.nombre.value;
    let apellidos = document.formCrearAdmin.apellidos.value;
	let username = document.formCrearAdmin.username.value;
	let email = document.formCrearAdmin.email.value;
    let passwd = document.formCrearAdmin.passwd.value;
	let passwd2 = document.formCrearAdmin.passwd2.value;
	let telefono = document.formCrearAdmin.telefono.value;
	let direccion = document.formCrearAdmin.direccion.value;
	let poblacion = document.formCrearAdmin.poblacion.value;
	let cp = document.formCrearAdmin.cp.value;
	let pais = document.formCrearAdmin.pais.value;
	if (!validarDNI(dni)){
		document.formCrearAdmin.dni.focus();
		return;
	}
	if (!validarPassword(passwd,passwd2)){
		document.formCrearAdmin.passwd.focus();
		return;
	}
	validarDatos(dni, username, email).then(function (data) {
		if (data) {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "?m=crear_admin", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + username + "&email=" + email+ "&dni=" + dni+ "&nombre="+ nombre+ "&apellidos=" + apellidos+ "&passwd=" + passwd+ "&telefono=" + telefono+ "&direccion=" + direccion+ "&poblacion=" + poblacion+ "&cp=" + cp+ "&pais=" + pais);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					verAdmins();
					alert('El administrador se ha creado correctamente.');
				}
				else {
					console.log("Error " + xhr.status);
				}
			});
		}
	}).catch(function (err) {
		console.log(err)
	})
}

function deleteAdmin(id) {
	if(id == "1")
		alert("No se puede eliminar la cuenta de administración por defecto.");
	else
		if (confirm('¿Seguro que quieres eliminar este administrador?')) {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "?m=delete_admin", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("id=" + id);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					verAdmins();
				}
				else {
					console.log("Error " + xhr.status);
				}
			});
		}
}


//Solicitud de vistas

function getCreacion() {
	$.ajax({
		type: 'GET',
		url: '?m=creacion',
		success: function (response) {
			$("#listado").html(response);
		}
	});
}


//Cierre de sesión

function cerrarSesion() {
	$.ajax({
		type: 'GET',
		url: '?m=cerrar_sesion',
		success: function () {
			location.reload();
		}
	});
}

//Carga del controlador apropiado

function gestionarUsuarios() {
	$.ajax({
		type: 'GET',
		url: '?m=usuarios',
		success: function () {
			location.reload();
		}
	});
}

function gestionarAdmins() {
	$.ajax({
		type: 'GET',
		url: '?m=admins',
		success: function () {
			location.reload();
		}
	});
}