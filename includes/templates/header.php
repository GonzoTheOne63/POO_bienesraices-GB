<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? null;
// var_dump($auth);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO Bienes Raices GB</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ' '; ?>">
        <!-- Igual a un if y else pero en una sola línea -->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/"> <!-- GB_bienesraices-PHP -->
                    <img class="logotipo" src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!-- Barra -->
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?> <!-- EXPRESIÓN Ternaria -->

            <!-- <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?> --> <!-- EXPRESIÓN REGULAR -->
        </div>
    </header>