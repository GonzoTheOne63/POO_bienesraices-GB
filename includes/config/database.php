<?php

function conectarDB() : mysqli
{
  $db = mysqli_connect('localhost', 'root', '', 'bienes_raices');
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