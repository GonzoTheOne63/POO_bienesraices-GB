<?php
require '../includes/funciones.php';
$auth = estaAutenticado();

if(!$auth){
    header('Location: /');
}

/*  {IMPORTAR} la conexión */
require '../includes/config/database.php';
$db = conectarDB();

/*  {ESCRIBIR} el QUERY */
$query  = "SELECT * FROM propiedades";

/*  {CONSULTAR} la BD */
$resultadoConsulta = mysqli_query($db, $query);

// echo "<pre>";
// var_dump($_GET);
// echo "</pre>"; 
/* {MUESTRA} mensaje condicional */
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { /* PARA evitar el undefined en mi variable */
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        /* ELIMINA el archivo (imagen)*/
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/' . $propiedad['imagen']);
        
        /* ELIMINA la propiedad */
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('Location: /admin/admin.php?resultado=3');
        }
    }
}

/* {INCLUYE} en TEMPLATE */
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva
        Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo de la Propiedad</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>¿Qué desea hacer?</th>
            </tr>
        </thead>

        <tbody>
            <!-- {MOSTRAR} los resultados  -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <!-- ITERAR para traer los resultados -->
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td class="precio">$<?php echo number_format($propiedad['precio']); ?>.00
                    <td>
                        <form method="POST" class="w-100">
                            <!-- INPUT oculto -->
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
/* {CERRAR} la BD */
mysqli_close($db);

incluirTemplate("footer");
?>