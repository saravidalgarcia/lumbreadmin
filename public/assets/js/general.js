/**
 * LumbreAdmin - Funciones comunes a varias páginas
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
}

/**
 * Cierra la sesión del usuario y lo redirige a la página de login
 */
function logout() {
  localStorage.removeItem("username");
  location.replace(baseURL + "login");
}

/**
 * Valida que la contraseña recibida cumpla con el patrón y que las dos
 * contraseñas introducidas sean la misma
 * @param passwd 
 * @param passwd2 
 */
function validarPassword(passwd, passwd2) {
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

/**
 * Lee la información introducida por el usuario en el formulario de cambio de 
 * contraseña, valida la nueva contraseña, y si es válida llama al controlador 
 * para actualizar la contraseña. La validación de que la contraseña antigua
 * sea correcta se realiza directamente en el controlador.
 */
function updatePassword() {
  passwd = document.formUpdatePassword.passwd.value; //Contraseña antigua
  passwdn = document.formUpdatePassword.passwdn.value; //Nueva contraseña
  passwdn2 = document.formUpdatePassword.passwdn2.value; //Repetición de nueva contraseña
  //Se valida la nueva contraseña
  if (!validarPassword(passwdn, passwdn2)) {
    document.formUpdatePassword.passwdn.focus();
    return;
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", baseURL + "cambiarpassword", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("username=" + localStorage.getItem("username") +
    "&passwd=" + passwd +
    "&passwdn=" + passwdn);
  xhr.addEventListener("readystatechange", (e) => {
    if (xhr.readyState !== 4) return;
    if (xhr.status >= 200 && xhr.status < 300) {
      //Si el controlador devuelve un 0, se ha producido un error
      //Si el controlador devuelve un 1, la contraseña antigua es incorrecta
      //Si el controlador devuelve un 2, la contraseña se ha actualizado correctamente
      let resultado = xhr.response.charAt(0);
      switch (resultado) {
        case "0": document.getElementById("mensaje-feedback").innerHTML = "No se ha podido recuperar la información del empleado"; break;
        case "1":
          document.formUpdatePassword.passwd.focus();
          document.getElementById("mensaje-feedback").innerHTML = "La contraseña introducida es incorrecta";
          break;
        case "2":
          alert("La contraseña se ha actualizado con éxito");
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

/**
 * Filtra los resultados de la tabla por el texto introducido por
 * el usuario en el buscador dada la cantidad de columnas filtrables
 * @param n - La cantidad de columnas cuyo contenido sirve para filtrar
 */
function buscarEnTabla(n) {
  var busqueda, filtro, tabla, tr, td, i, texto;
  busqueda = document.getElementById("buscador");
  filtro = busqueda.value.toUpperCase();
  tabla = document.getElementById("tabla");
  tr = tabla.getElementsByTagName("tr");
  //Recorre las filas de la tabla
  let contador = 0;
  for (i = 0; i < tr.length; i++) {
    //Para cada fila, toma el valor de las columnas filtrables
    for (j = 0; j < n; j++) {
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        texto = td.textContent || td.innerText;
        //Oculta las filas en las que el valor de columna no coindica con el filtro
        //y reajusta los colores de las filas para mantener el patrón par-impar de colores
        if (texto.toUpperCase().indexOf(filtro) > -1) {
          tr[i].style.display = "";
          if (contador % 2 == 0)
            tr[i].style.backgroundColor = "var(--font-color-soft)";
          else
            tr[i].style.backgroundColor = "transparent";
          contador++;
          break;
        } else {
          tr[i].style.display = "none";
          tr[i].style.backgroundColor = "";
        }
      }
    }
  }
}

/**
* Ordena las filas de la tabla alfabéticamente por la columna
* que se indique en el parámetro n.
* @param n - La columna por la que se ordena
*/
function ordenarTabla(n) {
  var tabla, filas, cambiar, i, x, y, hacerCambio, dir, contador = 0;
  tabla = document.getElementById("tabla");
  cambiar = true;
  //La ordenación por defecto es ascendente
  dir = "asc";
  //Bucle que se repite mientras queden filas por ordenar
  while (cambiar) {
    cambiar = false;
    filas = tabla.rows;
    //Se recorren las filas
    for (i = 1; i < (filas.length - 1); i++) {
      hacerCambio = false;
      //Se toma el valor de la columna n de dos filas consecutivas
      x = filas[i].getElementsByTagName("td")[n];
      y = filas[i + 1].getElementsByTagName("td")[n];
      //Se comprueba si hay que intercambiar las filas
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          hacerCambio = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          hacerCambio = true;
          break;
        }
      }
    }
    //Se intercambian las filas si es necesario
    if (hacerCambio) {
      filas[i].parentNode.insertBefore(filas[i + 1], filas[i]);
      cambiar = true;
      //Se aumenta el contador para saber cuántos cambios se han realizado
      contador++;
    } else {
      //Si la tabla ya estaba ordenada ascendentemente, entonces se
      //reordena descendentemente
      if (contador == 0 && dir == "asc") {
        dir = "desc";
        cambiar = true;
      }
    }
  }
}