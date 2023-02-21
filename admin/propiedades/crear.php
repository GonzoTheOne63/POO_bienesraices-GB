<?php
require '../../includes/app.php';

use App\Propiedad;

estaAutenticado();

$db = conectarDB();

// CONSULTAR y obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

/* {VALIDADOR} array con mensajes de errores*/
$errores = Propiedad::getErrores();

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

// EJECUTA el código después que el usuario envía el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);

    $errores = $propiedad->validar();

    /* {REVISAR} que el array de errores esté vacio, no tenga errores */
    if (empty($errores)) {

        $propiedad->guardar();

        // ASIGNAR files hacia una variable
        $imagen = $_FILES['imagen'];

        /* SUBIDA DE ARCHIVOS */
        /* CREAR la carpeta */
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        /* GENERAR UN NOMBRE ÚNICO */
        $nombreImagen = md5(uniqid(rand(), true)) . strrchr($_FILES['imagen']['name'], '.');  // sttchr() trae la extensión de la imagen 
        // var_dump($nombreImagen);

        /* SUBIR LA IMAGEN */
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        // exit;

        // echo $query;  // GENERA el query que puedo insertar a tableplus
        // GUARDAR EN LA BASE DE DATOS
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario.
            header('Location: ../admin.php?resultado=1');
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin/admin.php" class="boton boton-verde">Clic Volver</a>

    <?php foreach ($errores as $error) : ?>
        <!-- foreach se ejecuta una vez por cada elemento -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título de la Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio; ?> ">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for=" descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Tus Comentarios son de gran Valor"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for=" habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1" max="10" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej. 3" min="1" max="10" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1" max="10" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">-- Seleccione --</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>