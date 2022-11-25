<?= $head ?>

<meta name="description" content="Página de creación de usuario de la web de administración de Lumbre">
<link href="../assets/css/style.css" rel="stylesheet" type="text/css">
<link href="../assets/img/favicon.png" rel="icon" type="image/png">
<title>Crear usuario - LumbreAdmin</title>

<?= $cabecera ?>

    <section class="info">
        <section id="cabecera-info" class="cabecera-info">
            <h3>Crear usuario</h3>
        </section>
        <div class="div-form new-form">
            <section>
                <form name="formCrearUsuario" onsubmit="crearUsuario(); return false">
                    <input id="username" type="text" name="username" placeholder="Nombre de usuario" required autocomplete="off">
                    <br>
                    <input id="email" type="email" name="email" placeholder="Email" required autocomplete="off">
                    <br>
                    <input class="boton boton-admin" type="submit" title="Crear usuario" value="Crear">
                </form>
                <p id="mensaje-feedback" class="mensaje-feedback"></p>
            </section>
        </div>
    </section>

<?= $footer ?>

    <script type="text/javascript" src="../assets/js/general.js"></script>
    <script type="text/javascript" src="../assets/js/usuarios.js"></script>
</body>

</html>