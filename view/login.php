<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sara Vidal García">
    <meta name="description" content="Página de login de administración de LUMBRE">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Lumbre - Administración</title>
</head>
<body>
    <main class="administracion">
        <div class="div-form">
            <h3>Administración de Lumbre</h3>
            <form name="formAcceso" onsubmit="acceder(); return false">
                <input id="username" type="text" name="username" placeholder="Nombre de usuario" required autocomplete="off">
                <br>
                <input id="password" type="password" name="password" placeholder="Contraseña" required autocomplete="off">
                <br>
                <button class="boton boton-login" type="submit">Login</button>
            </form>
            <p id="mensaje-feedback" class="mensaje-feedback"></p>
        </div>
    </main>
    <footer>
		<p>Sara Vidal García | 2022</p>
	</footer>
	<script type="text/javascript" src="assets/js/acceso.js"></script>
</body>
</html>