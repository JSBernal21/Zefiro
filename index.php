<?php
require_once("logica/Persona.php");
require_once("logica/Seguridad.php");
require_once("logica/Pasajero.php");
require_once("logica/Piloto.php");
require_once("logica/Administrador.php");

session_start();
if (isset($_GET["salir"])) {
    session_destroy();
    header("Location: ?pid=" . base64_encode("presentacion/inicio.php"));
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>proyecto</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

    <?php
    $PaginasSinAutenticacion = array(
        "presentacion/autenticar.php",
        "presentacion/inicio.php",
        "presentacion/noAutorizado.php",

    );

    $PaginasConAutenticacion = array(
        "presentacion/admin/sesionAdmin.php",
        "presentacion/piloto/sesionPiloto.php",
        "presentacion/pasajero/sesionPasajero.php",
    );
    if (!isset($_GET["pid"])) {
        include("presentacion/inicio.php");
    } else {
        $pid = base64_decode($_GET["pid"]);
        if (in_array($pid, $PaginasSinAutenticacion)) {
            include($pid);
        } else if (in_array($pid, $PaginasConAutenticacion)) {
            if (!$_SESSION["id"]) {
                include("presentacion/registrar");
            } else {
                include($pid);
            }
        } else {
            echo "<div class='container fw-bold'>Error404: Pagina no Encontrada </div>";
        }
    }
    echo ("autenticar = <a href='?pid=".base64_encode("presentacion/autenticar.php")."'>AUTENTICAR</a>")
    ?>

</html>