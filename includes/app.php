<?php
// ESTE archivo se va a convertir en el pricipal pues va a llamar a las funciones y a las classes
require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

/* CONECTARNOS a la base de datos */
$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);