<?=$head?>
    <meta name="description" content="Página de visualización de usuarios de la web de administración de Lumbre">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <title>Usuarios - LumbreAdmin</title>
<?=$cabecera?>
<section class="info">
            <section id="cabecera-info" class="cabecera-info">
				<h1>Usuarios</h1>
                <button id="crearusuario" type="button" title="Crear usuario" onclick="location.href='<?=base_url('usuario/crear')?>'">Nuevo</button>
			</section>
			<section class="cuerpo-info">
				
                    <?php
                    if (count((array)$usuarios) > 0) {
                    ?>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($usuarios as $usuario): ?>
                                    <tr>
                                        <td class="t-usuarios"><?=$usuario['id'];?></td>
                                        <td class="t-usuarios"><?=$usuario['username'];?></td>
                                        <td class="t-usuarios"><?=$usuario['email'];?></td>
                                        <td class="t-usuarios t-opciones">
                                            <button class="b-opcion-tabla" onclick="location.href='usuario/editar/<?=$usuario['id'];?>';">Actualizar</button>
                                            <button class="b-opcion-tabla" onclick="deleteUsuario('<?=$usuario['id'];?>');">Borrar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <p class="mensaje">No hay usuarios registrados en el sistema</p>
                    <?php } ?>
				
			
		</section>
<?=$footer?>
<script type="text/javascript" src="assets/js/general.js"></script>
<script type="text/javascript" src="assets/js/usuarios.js"></script>
</body>
</html>