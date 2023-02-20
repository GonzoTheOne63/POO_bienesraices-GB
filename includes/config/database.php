<?php

function conectarDB() : mysqli
{
  $db = new mysqli('localhost', 'root', '', 'bienes_raices'); /* APLICANDO la forma orientada a objetos */
  mysqli_set_charset($db, 'utf8');
  
  if (!$db) {
    echo "Error de conexión";
    exit;
  }
  return $db;
}

/* if($db) { 
    echo "Conexión correcta";
  } else {
    echo "Conexión fallida";
  } */