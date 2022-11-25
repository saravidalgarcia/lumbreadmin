<?= $head ?>

<meta name="description" content="Página de inicio de sesión de la web de administración de Lumbre">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/img/favicon.png" rel="icon" type="image/png">
<title>Login - LumbreAdmin</title>
</head>

<body>
    <main class="administracion">
        <h1>Administración de Lumbre</h1>
        <div class="div-form login-form">
            <section>
                <form name="formLogin" onsubmit="login(); return false">
                    <input id="username" type="text" name="username" placeholder="Nombre de usuario" required>
                    <br>
                    <input id="passwd" type="password" name="passwd" placeholder="Contraseña" required>
                    <br>
                    <input class="boton" title="Iniciar sesión" type="submit" value="Iniciar sesión" />
                </form>
                <p id="mensaje-feedback" class="mensaje-feedback"></p>
            </section>
        </div>

        <?= $footer ?>
        
        <script type="text/javascript" src="assets/js/autenticacion.js"></script>
</body>

</html>