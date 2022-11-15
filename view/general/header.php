<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sara Vidal García">
    <meta name="description" content="Página de administración de LUMBRE">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Lumbre - Administración</title>
</head>
<body>
    <header class="cabecera">
        <div class="lumbre" onclick="gestionarUsuarios();" title="LUMBRE" alt="Logo de LUMBRE"></div>
        <div class="menu-cabecera">
            <button id="username" class="boton-cabecera">Administración</button>
            <div class="menu-cabecera-opciones">
              <a onclick="gestionarUsuarios();">Usuarios</a>
              <a onclick="gestionarAdmins();">Administradores</a>
              <a onclick="cerrarSesion();">Cerrar sesión</a>
            </div>
        </div>
    </header>