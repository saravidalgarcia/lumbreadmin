<?php
session_start();
require_once 'core/core.php';

//Si el usuario administrador está autenticado, se utiliza el
//controlador de usuarios o administradores según corresponda, 
//y en caso contrario el de autenticación
if (isset($_SESSION['auth'])) {
    if(isset($_SESSION['c'])){
        $controlador = $_SESSION['c'];
    }
    else{
        $controlador = 'Usuario';
    }
    $controlador .= 'Controller';
} else {
    $controlador = 'AutenticacionController';
}

require_once 'controller/' . $controlador . '.php';
$controlador = new $controlador;
$metodo = isset($_GET['m']) ? $_GET['m'] : 'index';

if (method_exists($controlador, $metodo)) {
    //El método de acceso de los administradores require de un usuario y contraseña
    if ($metodo == "login") {
        $username = isset($_GET['username']) ? $_GET['username'] : null;
        $passwd = isset($_GET['passwd']) ? $_GET['passwd'] : null;
        call_user_func([$controlador, $metodo], $username, $passwd);
    } else {
        //El método que llama a la vista de actualización de usuarios requiere del id del usuario,
        //su username y su email actuales (previos a la actualización)
        if ($metodo == "actualizacion") {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $username = isset($_GET['username']) ? $_GET['username'] : null;
            $email = isset($_GET['email']) ? $_GET['email'] : null;
            call_user_func([$controlador, $metodo], $id, $username, $email);
        }
        //El resto de métodos se llaman sin parámetros
        else
            call_user_func([$controlador, $metodo]);
    }
} else {
    die("Error: El metodo '{$metodo}' no existe.");
}
