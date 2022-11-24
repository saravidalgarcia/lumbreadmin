<?=$head?>
    <meta name="description" content="Página de actualización de empleado de la web de administración de Lumbre">
    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../../assets/img/favicon.png" rel="icon" type="image/png">
    <title>Actualizar empleado - LumbreAdmin</title>
<?=$cabecera?>
<section class="info">
            <section id="cabecera-info" class="cabecera-info">
				<h3>Actualizar empleado</h3>
			</section>
			
                <div class="div-form new-form">
                    <form name="formUpdateEmpleado" onsubmit="updateEmpleado(<?=$empleado['id'];?>); return false">
                        <input id="username" type="text" name="username" placeholder="Nombre de usuario" value="<?=$empleado['username'];?>" required>
                        <br>
                        <input id="email" type="email" name="email" placeholder="Email" value="<?=$empleado['email'];?>" required>
                        <br>
                        <input id="dni" type="text" name="dni" placeholder="DNI" value="<?=$empleado['dni'];?>" required>
                        <br>
                        <input id="nombre" type="text" name="nombre" placeholder="Nombre" value="<?=$empleado['nombre'];?>">
                        <br>
                        <input id="apellidos" type="text" name="apellidos" placeholder="Apellidos" value="<?=$empleado['apellidos'];?>">
                        <br>
                        <p>Información de contacto</p>
                        <br>
                        <input id="telefono" type="text" name="telefono" placeholder="Teléfono" value="<?=$contacto['telefono'];?>">
                        <br>
                        <input id="direccion" type="text" name="direccion" placeholder="Dirección" value="<?=$contacto['direccion'];?>">
                        <br>
                        <input id="poblacion" type="text" name="poblacion" placeholder="Población" value="<?=$contacto['poblacion'];?>">
                        <br>
                        <input id="cp" type="text" name="cp" placeholder="CP" value="<?=$contacto['cp'];?>">
                        <br>
                        <input id="pais" type="text" name="pais" placeholder="País" value="<?=$contacto['pais'];?>">
                        <br>
                        
                        <input class="boton boton-admin" title="Actualizar empleado" type="submit" value="Actualizar">
                           
                        
                    </form>
                    <p id="mensaje-feedback" class="mensaje-feedback"></p>
                    </section>
                </div>
			
		</section>
        <?=$footer?>
<script type="text/javascript" src="../../assets/js/general.js"></script>
<script type="text/javascript" src="../../assets/js/empleados.js"></script>
</body>
</html>