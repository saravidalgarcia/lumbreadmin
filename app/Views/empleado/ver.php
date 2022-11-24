<?=$head?>
    <meta name="description" content="Página de visualización de empleado de la web de administración de Lumbre">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/img/favicon.png" rel="icon" type="image/png">
    <title>Ver empleado - LumbreAdmin</title>
<?=$cabecera?>
<section class="info">
            <h1>Ficha de empleado</h1>
            <section id="cabecera-info" class="cabecera-info">    
                <?php if($empleado['id'] != '1'){ ?>
				<h3><?php echo $empleado['nombre'].' '.$empleado['apellidos'];?></h3>
                <div class="contenedor-botones-titulo">
                    <button title="Actualizar empleado" onclick="location.href='../empleado/editar/<?=$empleado['id'];?>'">Actualizar</button>
                    <button title="Eliminar empleado" onclick="deleteEmpleado('<?=$empleado['id'];?>');">Eliminar</button>
                </div>
                <?php } else { ?>
                    <h3>Cuenta de administración por defecto</h3>
                <?php } ?>
			</section>
			<section class="cuerpo-info ficha-empleado">
                <article>
                    <h3>Datos generales</h3>
                    <h4>Código de Empleado</h4>
                    <p><?=$empleado['id'];?></p>
                    <h4>DNI</h4>
                    <p><?=$empleado['dni'];?></p>
                    <h4>Apellidos y Nombre</h4>
                    <?php if($empleado['id'] == "1") { ?>
                    <p>-</p>
                    <?php } else { ?>
                    <p class="mayus"><?php echo $empleado['apellidos'].', '.$empleado['nombre'];?></p>
                    <?php } ?>
                    <h4>Nombre de Usuario Web</h4>
                    <p><?=$empleado['username'];?></p>
                    <h4>Email de registro</h4>
                    <p><?=$empleado['email'];?></p>
                </article>
                <article>
                    <h3>Dirección y contacto</h3>
                    <h4>Dirección</h4>
                    <p><?=$contacto['direccion']?></p>
                    <h4>Población</h4>
                    <p><?=$contacto['poblacion']?></p>
                    <h4>Código Postal</h4>
                    <p><?=$contacto['cp']?></p>
                    <h4>País</h4>
                    <p><?=$contacto['pais']?></p>
                    <h4>Teléfono</h4>
                    <p><?=$contacto['telefono']?></p>
                </article>
			</section>
		</section>
        <?=$footer?>
<script type="text/javascript" src="../assets/js/general.js"></script>
<script type="text/javascript" src="../assets/js/empleados.js"></script>
</body>
</html>