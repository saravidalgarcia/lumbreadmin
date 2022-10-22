<?php

//Conexión con la BD
class BD
{

	//Función que devuelve la conexión con la BD
	protected function connect()
	{
		try {
			$connect = new PDO('mysql:host=localhost;dbname=lumbre;charset=utf8;', 'root', 'root');
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $connect;
		} catch (Exception $e) {
			die('Error: BD(connect) ' . $e->getMessage());
		}
	}
}
?>