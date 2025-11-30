<?php
require_once("logica/Persona.php");
require_once("logica/Seguridad.php");
require_once("logica/Pasajero.php");
require_once("logica/Piloto.php");
require_once("logica/Administrador.php");
require_once("logica/Pais.php");
require_once("logica/Ciudad.php");

session_start();
if (isset($_GET["salir"])) {
    session_destroy();
    header("Location: ?pid=" . base64_encode("presentacion/inicio.php"));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Zefiro Aerolinea</title>
    <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="img/logoSL.png">
</head>

<body>
    <?php
    $PaginasSinAutenticacion = array(
        "presentacion/autenticar.php",
        "presentacion/inicio.php",
        "presentacion/noAutorizado.php",
        "presentacion/pasajero/registroPasajero.php",
        "presentacion/pasajero/editarPerfilPasajero.php"

    );

    $PaginasConAutenticacion = array(
        "presentacion/admin/sesionAdmin.php",
        "presentacion/piloto/sesionPiloto.php",
        "presentacion/pasajero/sesionPasajero.php",
        "presentacion/piloto/registrarPiloto.php",
        "presentacion/piloto/consultarPilotos.php",
        "presentacion/piloto/actualizarPiloto.php",
        "presentacion/ciudad/registrarCiudades.php",
        "presentacion/consultar/consultarCiudades.php",
    );
    if (!isset($_GET["pid"])) {
        include("presentacion/inicio.php");
    } else {
        $pid = base64_decode($_GET["pid"]);
        if (in_array($pid, $PaginasSinAutenticacion)) {
            include($pid);
        } else if (in_array($pid, $PaginasConAutenticacion)) {
            if (!isset($_SESSION["id"])) {
                include("presentacion/autenticar.php");
            } else {
                include($pid);
            }
        } else {
            echo "<div class='container fw-bold'>Error404: Pagina no Encontrada </div>";
        }
    }
    ?>
    <footer class="text-white py-3 position-relative">
        <div class="w-100 h-100 position-absolute bg-primary"></div>
        <div class="w-100 h-100 position-absolute bg-danger opacity-50"></div>
        <div class="container position-relative">

            <hr class="border-white mb-3">
            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center gap-2">
                    <img src="img/logoLetras.png" alt="Logo Zefiro" height="40">
                    <p class="mx-5 my-1 fs-4"><strong>© 2025 Zefiro Aerolinea, Inc</strong></p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="https://www.instagram.com/" target="_blank" class="text-white fs-4">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/" target="_blank" class="text-white fs-4">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://www.tiktok.com/" target="_blank" class="text-white fs-4">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <a href="https://co.linkedin.com/" target="_blank" class="text-white fs-4">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>

            </div>
        </div>
    </footer>
</body>

</html>