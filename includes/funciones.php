<?php

require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false)
{
	// echo TEMPLATES_URL . "/${nombre}.php";  // IMPRIME la ruta completa                                                                                                                                                                                                                                      
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
function estaAutenticado(): bool
{
	session_start();
	$auth = $_SESSION['login'];
	if($auth) {
		return true;
	}
	return false;
}

function debug($variable)
{
	echo "<pre>";
	var_dump($variable);
	echo "</pre>";
	exit;
}
  /* SIN cierre de php */