window.onload = () => {
	if (localStorage.getItem("username") == null)
        window.location.replace("https://lumbreadmin.es/login");
	else{
    document.getElementById("menu-ppal-usuarios").classList.add("actual");
	document.getElementById("menu-ppal-empleados").classList.remove("actual");
	document.getElementById("username").innerHTML = localStorage.getItem("username");
	}
}

function getUsuarios(param){
	return $.ajax({
		type: 'GET',
		url: param
	});
}

function getUsuario(id){
	return $.ajax({
		type: 'GET',
		url: '../../getusuario/'+id
	});
}

function validarDatos(username,email,usuarios){
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

function crearUsuario() {
	username = document.formCrearUsuario.username.value;
	email = document.formCrearUsuario.email.value;
	getUsuarios('../getusuarios').then(function(response){
		let usuarios = JSON.parse(response);
		enviar = validarDatos(username,email,usuarios);
		if(enviar){
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "guardar", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("username=" + username + "&email=" + email);
			xhr.addEventListener("readystatechange", (e) => {
				if (xhr.readyState !== 4) return;
				if (xhr.status >= 200 && xhr.status < 300) {
					location.href="../usuarios";
					alert('El usuario se ha creado correctamente.');
				}
				else {
					console.log("Error " + xhr.status);
				}
			});
		}
	});
}

function updateUsuario(id) {
	username = document.formUpdateUsuario.username.value;
	email = document.formUpdateUsuario.email.value;
	//Se obtienen los datos antiguos del usuario
	getUsuario(id).then(function(response){
		//Solo se validan los datos si son diferentes a los antiguos
		let old = JSON.parse(response)['usuario'];
		let u = (old.username == username) ? "" : username;
		let e = (old.email == email) ? "" : email;
		getUsuarios('../../getusuarios').then(function(response){
			let usuarios = JSON.parse(response);
			enviar = validarDatos(u,e,usuarios);
			if(enviar){
				let xhr = new XMLHttpRequest();
				xhr.open("POST", "../actualizar", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("id=" + id + "&username=" + username + "&email=" + email);
				xhr.addEventListener("readystatechange", (e) => {
					if (xhr.readyState !== 4) return;
					if (xhr.status >= 200 && xhr.status < 300) {
						location.href="../../usuarios";
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

function deleteUsuario(id) {
	if (confirm('¿Seguro que quieres eliminar este usuario?')) {
		let direccion = "usuario/borrar/"+id
		location.href= direccion;
	}
}



