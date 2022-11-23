<?=$head?>
    <meta name="description" content="Página de creación de empleado de la web de administración de Lumbre">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/img/favicon.png" rel="icon" type="image/png">
    <title>Crear empleado - LumbreAdmin</title>
<?=$cabecera?>
				<h1>Crear empleado</h1>
			</section>
			
                <div class="div-form new-form">
                    <section>
                    <form name="formCrearEmpleado" onsubmit="crearEmpleado(); return false">
                        <input id="username" type="text" name="username" placeholder="Nombre de usuario" required>
                        <br>
                        <input id="email" type="email" name="email" placeholder="Email" required>
                        <br>
                        <input id="dni" type="text" name="dni" placeholder="DNI" required>
                        <br>
                        <input id="nombre" type="text" name="nombre" placeholder="Nombre">
                        <br>
                        <input id="apellidos" type="text" name="apellidos" placeholder="Apellidos">
                        <br>
                        <input id="passwd" type="password" name="passwd" placeholder="Contraseña" required>
                        <br>
                        <input id="passwd2" type="password" name="passwd2" placeholder="Repetir contraseña" required>
                        <br>
                        <p>Información de contacto</p>
                        <br>
                        <input id="telefono" type="text" name="telefono" placeholder="Teléfono">
                        <br>
                        <input id="direccion" type="text" name="direccion" placeholder="Dirección">
                        <br>
                        <input id="poblacion" type="text" name="poblacion" placeholder="Población">
                        <br>
                        <input id="cp" type="text" name="cp" placeholder="CP">
                        <br>
                        <input id="pais" type="text" name="pais" placeholder="País">
                        <br>
                        <input class="boton boton-admin" type="submit" title="Crear empleado" value="Crear">
                    </form>
                    <p id="mensaje-feedback" class="mensaje-feedback"></p>
                    </section>
                </div>
			
		</section>
        <?=$footer?>
<script type="text/javascript" src="../assets/js/general.js"></script>
<script type="text/javascript" src="../assets/js/empleados.js"></script>
</body>
</html>