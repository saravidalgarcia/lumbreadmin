<?=$head?>
    <meta name="description" content="Página de visualización de empleado de la web de administración de Lumbre">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/img/favicon.png" rel="icon" type="image/png">
    <title>Ver empleado - LumbreAdmin</title>
<?=$cabecera?>
                <?php if($empleado['id'] != '1'){ ?>
				<h1><?php echo $empleado['nombre'].' '.$empleado['apellidos'];?></h1>
                <div class="contenedor-botones-titulo">
                    <button title="Actualizar empleado" onclick="location.href='../empleado/editar/<?=$empleado['id'];?>'">Actualizar</button>
                    <button title="Eliminar empleado" onclick="deleteEmpleado('<?=$empleado['id'];?>');">Eliminar</button>
                </div>
                <?php } else { ?>
                    <h1>Cuenta de administración por defecto</h1>
                <?php } ?>
			</section>
			<section class="cuerpo-info">
                <h3>Datos del empleado</h3>
                <table>
                    <tr>
                        <th scope="row">Nombre y apellidos</th>
                        <td><?php echo $empleado['nombre'].' '.$empleado['apellidos'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">DNI</th>
                        <td><?=$empleado['dni'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Nombre de usuario</th>
                        <td><?=$empleado['username'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?=$empleado['email'];?></td>
                    </tr>
                </table>
                <h3>Información de contacto</h3>
                <table>
                    <tr>
                        <th scope="row">Teléfono</th>
                        <td><?=$contacto['telefono']?></td>
                    </tr>
                    <tr>
                        <th scope="row">Dirección</th>
                        <td><?=$contacto['direccion']?></td>
                    </tr>
                    <tr>
                        <th scope="row">Población</th>
                        <td><?=$contacto['poblacion']?></td>
                    </tr>
                    <tr>
                        <th scope="row">CP</th>
                        <td><?=$contacto['cp']?></td>
                    </tr>
                    <tr>
                        <th scope="row">País</th>
                        <td><?=$contacto['pais']?></td>
                    </tr>
                </table>
			</section>
		</section>
        <?=$footer?>
<script type="text/javascript" src="../assets/js/general.js"></script>
<script type="text/javascript" src="../assets/js/empleados.js"></script>
</body>
</html>