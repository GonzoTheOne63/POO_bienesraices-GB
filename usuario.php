<?php
// IMPORTAR la conexión
require 'includes/config/database.php';
$db = conectarDB();
// CREAR un email y passowrd
$email = "correogb@correo.com";
$password = "6863";
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// var_dump($passwordHash); // NO es seguro
// QUERY para crear el usuario
$query = " INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}'); ";

// echo $query;
// exit;

// AGREGAR el usuario a la base de datos
mysqli_query($db, $query);
