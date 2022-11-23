<?=$head?>
    <meta name="description" content="Página de visualización de empleados de la web de administración de Lumbre">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <title>Empleados - LumbreAdmin</title>
<?=$cabecera?>
				<h1>Empleados</h1>
                <button id="crearadmin" type="button" title="Crear administrador" onclick="location.href='<?=base_url('empleado/crear')?>'">Nuevo</button>
			</section>
			<section class="cuerpo-info">
            <?php
                    if (count((array)$empleados) > 0) {
                    ?>
                        <table>
                            <thead>
                                <tr>
                                <th scope="col">DNI</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($empleados as $empleado): ?>
                                    <tr>
                                        <td class="t-empleados"><?=$empleado['dni'];?></td>
                                        <td class="t-empleados"><?php echo $empleado['nombre'].' '.$empleado['apellidos'];?></td>
                                        <td class="t-empleados"><?=$empleado['username'];?></td>
                                        <td class="t-empleados"><?=$empleado['email'];?></td>
                                        <td class="t-empleados t-opciones">
                                            <button class="b-opcion-tabla" onclick="location.href='empleado/<?=$empleado['id'];?>';">Ver</button>
                                            <button class="b-opcion-tabla" onclick="deleteEmpleado('<?=$empleado['id'];?>');">Borrar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <p class="mensaje">No hay empleados registrados en el sistema</p>
                    <?php } ?>

			</section>
		</section>
<?=$footer?>
<script type="text/javascript" src="assets/js/general.js"></script>
<script type="text/javascript" src="assets/js/empleados.js"></script>
</body>
</html>