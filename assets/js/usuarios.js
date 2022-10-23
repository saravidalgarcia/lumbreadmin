//Por defecto, se carga la tabla con los usuarios en la página
addEventListener('load', verUsuarios, false);

function verUsuarios() {
	$.ajax({
		type: 'GET',
		url: '?m=set_usuarios',
		success: function (response) {
			$("#listado").html(response);
		}
	});
}

function validarDatos(username, email) {
	return new Promise(function (resolve, reject) {
		$.ajax({
			type: 'GET',
			url: '?m=get_usuarios',
			success: function (response) {
				let respuesta = JSON.parse(response);
				if (respuesta.length == 0) resolve(true);
				else
					for (let i = 0; i < respuesta.length; i++) {
						if (respuesta[i].username == username) {
							document.getElementById("mensaje-feedback").innerHTML = "Este nombre de usuario ya está registrado en el sistema.";
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

function crearUsuario() {
	username = document.formCrearUsuario.username.value;
	email = document.formCrearUsuario.email.value;
	validarDatos(username, email).then(function (data) {
		if (data) {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "?m=crear_usuario", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + username + "&email=" + email);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					verUsuarios();
					alert('El usuario se ha creado correctamente.');
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

function updateUsuario() {
	id = document.formUpdateUsuario.id.value;
	oldusername = document.formUpdateUsuario.oldusername.value;
	oldemail = document.formUpdateUsuario.oldemail.value;
	newusername = document.formUpdateUsuario.newusername.value;
	newemail = document.formUpdateUsuario.newemail.value;
	//Solo se validan los nuevos datos si son diferentes a los antiguos
	username = (oldusername == newusername) ? "" : newusername;
	email = (oldemail == newemail) ? "" : newemail;
	validarDatos(username, email).then(function (data) {
		if (data) {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "?m=update_usuario", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + newusername + "&email=" + newemail + "&id=" + id);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					verUsuarios();
					alert('El usuario se ha actualizado correctamente.');
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

function deleteUsuario(id) {
	if (confirm('¿Seguro que quieres eliminar este usuario?')) {
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "?m=delete_usuario", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("id=" + id);
		xhr.addEventListener("readystatechange", (e) => {
			if (xhr.readyState !== 4) return;
			if (xhr.status >= 200 && xhr.status < 300) {
				verUsuarios();
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

function getActualizacion(id, username, email) {
	$.ajax({
		type: 'GET',
		url: '?m=actualizacion&id=' + id + '&username=' + username + '&email=' + email,
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