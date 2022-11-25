<?= $head ?>

<meta name="description" content="Página de visualización de empleados de la web de administración de Lumbre">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/img/favicon.png" rel="icon" type="image/png">
<title>Empleados - LumbreAdmin</title>

<?= $cabecera ?>

    <section class="info">
        <section id="cabecera-info" class="cabecera-info">
            <h1>Empleados</h1>
            <button id="crearadmin" type="button" title="Crear administrador" onclick="location.href='<?= base_url('empleado/crear') ?>'">Nuevo</button>
        </section>
        <section class="cuerpo-info">
            <input type="text" class="buscador" id="buscador" onkeyup="buscarEnTabla(4)" placeholder="Buscar..." title="Escribe un DNI, nombre, username o email para buscar coincidencias">
            <p class="mensaje orden-tabla" id="mensaje-error">Pulsa sobre el nombre de una columna para ordenar los resultados.</p>
            <?php
            if (count((array)$empleados) > 0) {
            ?>
                <table id="tabla">
                    <thead>
                        <tr>
                            <th onclick="ordenarTabla(0)" scope="col">DNI</th>
                            <th onclick="ordenarTabla(1)" scope="col">Nombre</th>
                            <th onclick="ordenarTabla(2)" scope="col">Username</th>
                            <th onclick="ordenarTabla(3)" scope="col">Email</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $empleado) : ?>
                            <tr>
                                <td class="t-empleados"><?= $empleado['dni']; ?></td>
                                <td class="t-empleados"><?php echo $empleado['nombre'] . ' ' . $empleado['apellidos']; ?></td>
                                <td class="t-empleados"><?= $empleado['username']; ?></td>
                                <td class="t-empleados"><?= $empleado['email']; ?></td>
                                <td class="t-empleados t-opciones">
                                    <button class="b-opcion-tabla" onclick="location.href='empleado/<?= $empleado['id']; ?>';">Ver</button>
                                    <button class="b-opcion-tabla" onclick="deleteEmpleado('<?= $empleado['id']; ?>');">Borrar</button>
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

<?= $footer ?>

    <script type="text/javascript" src="assets/js/general.js"></script>
    <script type="text/javascript" src="assets/js/empleados.js"></script>
</body>

</html>