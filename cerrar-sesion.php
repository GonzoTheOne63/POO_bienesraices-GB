<?php

session_start(); // LA sesión debe estar iniciada

$_SESSION = []; // REESCRIBE la sesióna un arreglo vacio para cerrarla

// var_dump($_SESSION);
 
header('Location: /'); // REDIRECCIONA al usuario a la página principal