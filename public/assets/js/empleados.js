/**
 * LumbreAdmin - Funciones de las páginas relacionadas con la gestión de empleados
 * 
 * @author Sara Vidal García
 */

/**
 * Se comprueba que el usuario esté autenticado y, si no es así, se le redirige a
 * la página de login
 */
window.onload = () => {
	if (localStorage.getItem("admin") == null)
		window.location.replace(baseURL + "login");
	else {
		document.getElementById("menu-ppal-usuarios").classList.remove("actual");
		document.getElementById("menu-ppal-empleados").classList.add("actual");
		document.getElementById("username").innerHTML = localStorage.getItem("admin");
	}
}

/**
 * Obtiene la información de los empleados registrados en el sistema
 */
function getEmpleados() {
	return $.ajax({
		type: 'GET',
		url: baseURL + 'getempleados'
	});
}

/**
 * Obtiene la información asociada a un empleado dado su id
 * @param id
 */
function getEmpleado(id) {
	return $.ajax({
		type: 'GET',
		url: baseURL + 'getempleado/' + id
	});
}

/**
 * Valida que el dni recibido sea válido, es decir, que esté compuesto por
 * ocho números y una letra, y que la letra sea la correspondiente en función
 * de los números
 * @param dni  
 */
function validarDNI(dni) {
	let patron = /^\d{8}[A-Za-z]$/;
	dni = dni.toUpperCase();
	if (dni.match(patron)) {
		let letras = 'TRWAGMYFPDXBNJZSQVHLCKET';
		let letra = dni.substr(dni.length - 1, 1);
		let numero = dni.substr(0, dni.length - 1);
		numero = numero % 23;
		if (letra != letras.substring(numero, numero + 1)) {
			document.getElementById("mensaje-feedback").innerHTML = "El DNI es incorrecto.";
			return false;
		} else {
			return true;
		}
	} else {
		document.getElementById("mensaje-feedback").innerHTML = "El formato del DNI debe ser de 8 números y una letra.";
		return false;
	}
}

/**
 * Comprueba que el dni, el username y el email recibidos no se encuentren ya
 * registrados en el sistema
 * @param dni
 * @param username 
 * @param email 
 * @param empleados - La información de los empleados ya registrados
 */
function validarDatos(dni, username, email, empleados) {
	let respuesta = empleados['empleados'];
	for (let i = 0; i < respuesta.length; i++) {
		if (respuesta[i].dni == dni) {
			document.getElementById("mensaje-feedback").innerHTML = "Este DNI ya está registrado en el sistema.";
			return false;
		}
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
 * creación de empleado, la valida y, en caso de ser válida, la 
 * envía al controlador para crear al nuevo empleado
 */
function crearEmpleado() {
	//Campos para validar
	dni = document.formCrearEmpleado.dni.value;
	username = document.formCrearEmpleado.username.value;
	email = document.formCrearEmpleado.email.value;
	passwd = document.formCrearEmpleado.passwd.value;
	passwd2 = document.formCrearEmpleado.passwd2.value;
	if (!validarDNI(dni)) {
		document.formCrearEmpleado.dni.focus();
		return;
	}
	if (!validarPassword(passwd, passwd2)) {
		document.formCrearEmpleado.passwd.focus();
		return;
	}
	getEmpleados().then(function (response) {
		let empleados = JSON.parse(response);
		enviar = validarDatos(dni, username, email, empleados);
		if (enviar) {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", baseURL + "empleado/guardar", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + username +
				"&email=" + email +
				"&dni=" + dni +
				"&nombre=" + document.formCrearEmpleado.nombre.value +
				"&apellidos=" + document.formCrearEmpleado.apellidos.value +
				"&passwd=" + passwd +
				"&telefono=" + document.formCrearEmpleado.telefono.value +
				"&direccion=" + document.formCrearEmpleado.direccion.value +
				"&poblacion=" + document.formCrearEmpleado.poblacion.value +
				"&cp=" + document.formCrearEmpleado.cp.value +
				"&pais=" + document.formCrearEmpleado.pais.value);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					location.href = baseURL + "empleados";
					alert('El empleado se ha creado correctamente.');
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
 * edición de empleado, la valida y, en caso de ser válida, la 
 * envía al controlador para actualizar el empleado con el id dado
 * @param id 
 */
function updateEmpleado(id) {
	//Campos para validar
	dni = document.formUpdateEmpleado.dni.value;
	username = document.formUpdateEmpleado.username.value;
	email = document.formUpdateEmpleado.email.value;
	//Se valida el DNI
	if (!validarDNI(dni)) {
		document.formCrearEmpleado.dni.focus();
		return;
	}
	//Se obtienen los datos antiguos del empleado
	getEmpleado(id).then(function (response) {
		//Solo se validan los datos si son diferentes a los antiguos
		let old = JSON.parse(response)['empleado'];
		let u = (old.username == username) ? "" : username;
		let e = (old.email == email) ? "" : email;
		let d = (old.dni == dni) ? "" : dni;
		getEmpleados().then(function (response) {
			let empleados = JSON.parse(response);
			enviar = validarDatos(d, u, e, empleados);
			if (enviar) {
				let xhr = new XMLHttpRequest();
				xhr.open("POST", baseURL + "empleado/actualizar", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("id=" + id +
					"&username=" + username +
					"&email=" + email +
					"&dni=" + dni +
					"&nombre=" + document.formUpdateEmpleado.nombre.value +
					"&apellidos=" + document.formUpdateEmpleado.apellidos.value +
					"&telefono=" + document.formUpdateEmpleado.telefono.value +
					"&direccion=" + document.formUpdateEmpleado.direccion.value +
					"&poblacion=" + document.formUpdateEmpleado.poblacion.value +
					"&cp=" + document.formUpdateEmpleado.cp.value +
					"&pais=" + document.formUpdateEmpleado.pais.value);
				xhr.addEventListener("readystatechange", (e) => {
					if (xhr.readyState !== 4) return;
					if (xhr.status >= 200 && xhr.status < 300) {
						location.href = baseURL + "empleado/" + id;
						alert('El empleado se ha actualizado correctamente.');
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
 * para borrar al empleado con el id dado
 * La cuenta de administración por defecto, con el id = 1, no se puede borrar
 * @param id 
 */
function deleteEmpleado(id) {
	if (id == "1")
		alert("No se puede eliminar la cuenta de administración por defecto.");
	else
		if (confirm('¿Seguro que quieres eliminar este empleado?')) {
			location.href = baseURL + "empleado/borrar/" + id;
		}
}

