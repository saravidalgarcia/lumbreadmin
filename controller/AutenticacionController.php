<?php

//Controlador para la autenticación
class AutenticacionController extends Administrador
{

	//Función que carga la vista de la página de login
	function index()
	{
		require_once('view/login.php');
	}

	//Función que realiza el login
	function login()
	{
		$username = $_REQUEST['username'];
		$passwd = $_REQUEST['passwd'];
		$data = parent::login_modelo($username, $passwd);
		//Si se ha recibido un usuario, la autenticación es exitosa
		if (count($data) == 1) {
			session_start();
			$_SESSION['auth'] = 'true';
		}
		echo count($data);
	}
}
?>