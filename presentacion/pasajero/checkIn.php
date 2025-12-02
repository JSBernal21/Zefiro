<?php
$id = $_SESSION["id"];
if ($_SESSION["rol"] != "pasajero") {
    header('Location: ?pid=' . base64_encode("noAutorizado.php"));
}
$pasajero = new Pasajero($id);
$pasajero->consultarPorId();


include ("presentacion/pasajero/menuPasajero.php");
?>