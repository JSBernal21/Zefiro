<?php
session_start();
require_once("../../logica/Persona.php");
require_once("../../logica/Piloto.php");
if ($_SESSION['rol'] != 'admin') {
    if ($_SERVER['REMOTE_ADDR'] == "::1") {
        header("Location: /proyecto2API/?pid=" . base64_encode("presentacion/noAutorizado.php"));
    } else {
        header('Location: /?pid=' . base64_encode("presentacion/noAutorizado.php"));
    }
    exit();
} else {
    $idPiloto = isset($_POST['id']) ? $_POST['id'] : null;
    $estado = isset($_POST['e']) ? $_POST['e'] : null;
    if ($idPiloto === null || $estado === null) {
        if ($_SERVER['REMOTE_ADDR'] == "::1") {
            header("Location: /proyecto2API/?pid=" . base64_encode("presentacion/noAutorizado.php"));
        } else {
            header('Location: /?pid=' . base64_encode("presentacion/noAutorizado.php"));
        }
    } else {
        $piloto = new Piloto($idPiloto);
        $piloto->cambiarEstado($estado);
        echo $estado ? "<div class='rounded-4 bg-success text-light px-1'><i class='fa-solid fa-circle-check'></i> Activo</div>" : "<div class='rounded-4 bg-danger text-light px-1'><i class='fa-solid fa-circle-xmark'></i> Inactivo</div>";
    }

}
