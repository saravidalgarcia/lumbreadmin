window.onload = () => {
	if (localStorage.getItem("username") == null)
        window.location.replace("https://lumbreadmin.es/login");
	else{
    document.getElementById("menu-ppal-usuarios").classList.remove("actual");
	document.getElementById("menu-ppal-empleados").classList.add("actual");
	document.getElementById("username").innerHTML = localStorage.getItem("username");
	}
}

function getEmpleados(param){
	return $.ajax({
		type: 'GET',
		url: param
	});
}

function getEmpleado(id){
	return $.ajax({
		type: 'GET',
		url: '../../getempleado/'+id
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

function validarDatos(dni,username,email,empleados){
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

function crearEmpleado() {
	//Campos para validar
	dni = document.formCrearEmpleado.dni.value;
	username = document.formCrearEmpleado.username.value;
	email = document.formCrearEmpleado.email.value;
	passwd = document.formCrearEmpleado.passwd.value;
	passwd2 = document.formCrearEmpleado.passwd2.value;
	if (!validarDNI(dni)){
		document.formCrearEmpleado.dni.focus();
		return;
	}
	if (!validarPassword(passwd,passwd2)){
		document.formCrearEmpleado.passwd.focus();
		return;
	}
	getEmpleados('../getempleados').then(function(response){
		let empleados = JSON.parse(response);
		enviar = validarDatos(dni,username,email,empleados);
		if(enviar){
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "guardar", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + username +
					 "&email=" + email+ 
					 "&dni=" + dni+ 
					 "&nombre="+ document.formCrearEmpleado.nombre.value+ 
					 "&apellidos=" + document.formCrearEmpleado.apellidos.value+ 
					 "&passwd=" + passwd+ 
					 "&telefono=" + document.formCrearEmpleado.telefono.value+ 
					 "&direccion=" + document.formCrearEmpleado.direccion.value+ 
					 "&poblacion=" + document.formCrearEmpleado.poblacion.value+ 
					 "&cp=" + document.formCrearEmpleado.cp.value+ 
					 "&pais=" + document.formCrearEmpleado.pais.value);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					location.href="../empleados";
					alert('El empleado se ha creado correctamente.');
				}
				else {
					console.log("Error " + xhr.status);
				}
			});
		}
	});
}

function updateEmpleado(id) {
	//Campos para validar
	dni = document.formUpdateEmpleado.dni.value;
	username = document.formUpdateEmpleado.username.value;
	email = document.formUpdateEmpleado.email.value;
	if (!validarDNI(dni)){
		document.formCrearEmpleado.dni.focus();
		return;
	}
	//Se obtienen los datos antiguos del empleado
	getEmpleado(id).then(function(response){
		//Solo se validan los datos si son diferentes a los antiguos
		let old = JSON.parse(response)['empleado'];
		let u = (old.username == username) ? "" : username;
		let e = (old.email == email) ? "" : email;
		let d = (old.dni == dni) ? "" : dni;
		getEmpleados('../../getempleados').then(function(response){
			let empleados = JSON.parse(response);
			enviar = validarDatos(d,u,e,empleados);
			if(enviar){
				let xhr = new XMLHttpRequest();
				xhr.open("POST", "../actualizar", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("id="+id+
						"&username=" + username + 
						"&email=" + email+ 
						"&dni=" + dni+ 
						"&nombre="+ document.formUpdateEmpleado.nombre.value+ 
						"&apellidos=" + document.formUpdateEmpleado.apellidos.value+ 
						"&telefono=" + document.formUpdateEmpleado.telefono.value+ 
						"&direccion=" + document.formUpdateEmpleado.direccion.value+ 
						"&poblacion=" + document.formUpdateEmpleado.poblacion.value+ 
						"&cp=" + document.formUpdateEmpleado.cp.value+ 
						"&pais=" + document.formUpdateEmpleado.pais.value);
				xhr.addEventListener("readystatechange", (e) => {
					if (xhr.readyState !== 4) return;
					if (xhr.status >= 200 && xhr.status < 300) {
						location.href="../"+id;
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

function deleteEmpleado(id) {
	if(id == "1")
		alert("No se puede eliminar la cuenta de administración por defecto.");
	else
		if (confirm('¿Seguro que quieres eliminar este empleado?')) {
			let direccion = "https://lumbreadmin.es/empleado/borrar/"+id
			location.href= direccion;
		}
}

