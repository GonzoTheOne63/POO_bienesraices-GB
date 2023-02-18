<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
// var_dump($id);
if (!$id) {
    header('Location: /');
}

require 'includes/app.php';

$db = conectarDB();
// CONSUTAR la base de datos
$query = "SELECT * FROM propiedades WHERE id = ${id}";
// OBTENER los resultados
$resultado = mysqli_query($db, $query);

// echo "<pre>";
// var_dump($resultado->num_rows);
// echo "</pre>"; // AYUDA a verificar errores

if(!$resultado->num_rows) {
    header('Location: /');
}

$propiedad = mysqli_fetch_assoc($resultado);


incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad" />


    <div class="resumen-propiedad">
        <p class="precio">$<?php echo number_format($propiedad['precio']); ?>.00</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc" />
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" />
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion']; ?></p>
        <a href="/anuncios.php" class="boton-verde">Volver Anuncios</a>
    </div>

</main>

<?php
mysqli_close($db);
incluirTemplate("footer");
?>