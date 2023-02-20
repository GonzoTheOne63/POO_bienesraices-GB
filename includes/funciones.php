<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

function incluirTemplate(string $nombre, bool $inicio = false)
{
	include TEMPLATES_URL . "/${nombre}.php";
}
function limitar_cadena($cadena, $limite, $sufijo)
{
	// Si la longitud es mayor que el límite...
	if (strlen($cadena) > $limite) {
		// Entonces corta la cadena y ponle el sufijo
		return substr($cadena, 0, $limite) . $sufijo;
	}
	// Si no, entonces devuelve la cadena normal
	return $cadena;
}

// Verifica que el usuario esté autenticado
function estaAutenticado()
{
	session_start();

	if (!$_SESSION['login']) {
		header('Location: /');
	}
}

function debug($variable)
{
	echo "<pre>";
	var_dump($variable);
	echo "</pre>";
	exit;
}
  /* SIN cierre de php */