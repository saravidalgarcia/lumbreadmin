/**
 * LumbreAdmin - Funciones de las páginas relacionadas con la gestión de usuarios
 * 
 * @author Sara Vidal García
 */

const baseURL = "https://lumbreadmin.es/";

/**
 * Se comprueba que el usuario esté autenticado y, si no es así, se le redirige a
 * la página de login
 */
window.onload = () => {
	if (localStorage.getItem("username") == null)
		window.location.replace(baseURL + "login");
	else {
		document.getElementById("menu-ppal-usuarios").classList.add("actual");
		document.getElementById("menu-ppal-empleados").classList.remove("actual");
		document.getElementById("username").innerHTML = localStorage.getItem("username");
	}
}

/**
 * Obtiene la información de los usuarios registrados en el sistema
 */
function getUsuarios() {
	return $.ajax({
		type: 'GET',
		url: baseURL + 'getusuarios'
	});
}

/**
 * Obtiene la información asociada a un usuario dado su id
 * @param id
 */
function getUsuario(id) {
	return $.ajax({
		type: 'GET',
		url: baseURL + 'getusuario/' + id
	});
}

/**
 * Comprueba que el username y el email recibidos no se encuentren ya
 * registrados en el sistema
 * @param username 
 * @param email 
 * @param usuarios - La información de los usuarios ya registrados
 */
function validarDatos(username, email, usuarios) {
	let respuesta = usuarios['usuarios'];
	for (let i = 0; i < respuesta.length; i++) {
		if (respuesta[i].username == username) {
			document.getElementById("mensaje-feedback").innerHTML = "Este nombre de usuario ya está registrado en el sistema.";
			return false;
		}
		if (respuesta[i].email == email) {
			document.getElementById("mensaje-feedback").innerHTML = "Este email ya está registrado en el sistema.";
			return false;
		}
	}
	document.getElementById("mensaje-feedback").innerHTML = "";
	return true;
}

/**
 * Lee la información introducida por el usuario en el formulario de
 * creación de usuario, la valida y, en caso de ser válida, la 
 * envía al controlador para crear al nuevo usuario
 */
function crearUsuario() {
	username = document.formCrearUsuario.username.value;
	email = document.formCrearUsuario.email.value;
	getUsuarios().then(function (response) {
		let usuarios = JSON.parse(response);
		enviar = validarDatos(username, email, usuarios);
		if (enviar) {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", baseURL + "usuario/guardar", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + username + "&email=" + email);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					location.href = baseURL + "usuarios";
					alert('El usuario se ha creado correctamente.');
				}
				else {
					console.log("Error " + xhr.status);
				}
			});
		}
	});
}

/**
 * Lee la información introducida por el usuario en el formulario de
 * edición de usuario, la valida y, en caso de ser válida, la 
 * envía al controlador para actualizar el usuario con el id dado
 * @param id 
 */
function updateUsuario(id) {
	username = document.formUpdateUsuario.username.value;
	email = document.formUpdateUsuario.email.value;
	//Se obtienen los datos antiguos del usuario
	getUsuario(id).then(function (response) {
		//Solo se validan los datos si son diferentes a los antiguos
		let old = JSON.parse(response)['usuario'];
		let u = (old.username == username) ? "" : username;
		let e = (old.email == email) ? "" : email;
		getUsuarios().then(function (response) {
			let usuarios = JSON.parse(response);
			enviar = validarDatos(u, e, usuarios);
			if (enviar) {
				let xhr = new XMLHttpRequest();
				xhr.open("POST", baseURL + "usuario/actualizar", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("id=" + id + "&username=" + username + "&email=" + email);
				xhr.addEventListener("readystatechange", (e) => {
					if (xhr.readyState !== 4) return;
					if (xhr.status >= 200 && xhr.status < 300) {
						location.href = baseURL + "usuarios";
						alert('El usuario se ha actualizado correctamente.');
					}
					else {
						console.log("Error " + xhr.status);
					}
				});
			}
		});
	});
}

/**
 * Solicita confirmación al usuario y, en caso afirmativo, llama al controlador
 * para borrar al usuario con el id dado
 * @param id 
 */
function deleteUsuario(id) {
	if (confirm('¿Seguro que quieres eliminar este usuario?')) {
		location.href = baseURL + "usuario/borrar/" + id;
	}
}



