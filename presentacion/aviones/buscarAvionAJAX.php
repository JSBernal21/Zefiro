<?php
session_start();
require_once("../../logica/Avion.php");
require_once("../../logica/Ruta.php");
require_once("../../logica/Ciudad.php");
if ($_SESSION['rol'] != 'admin') {
    if ($_SERVER['REMOTE_ADDR'] == "::1") {
        header("Location: /proyecto2API/?pid=" . base64_encode("presentacion/noAutorizado.php"));
    } else {
        header('Location: /?pid=' . base64_encode("presentacion/noAutorizado.php"));
    }
    exit();
} else {
    $filtro = isset($_POST["rutaId"]) ? $_POST["rutaId"] : "";
    $ruta = new Ruta($filtro);
    $ruta->consultarPorId();
    $ciudadOrigenId = $ruta->getOrigen()->getId();
    $avion = new Avion();
    $aviones = $avion->consultarAvionPorCiudad($ciudadOrigenId);
    ?>
    <label class="form-label">Aviones disponibles: </label>
    <select class="form-select mt-1 mb-2 border border-danger-subtle" name="avion" id="avion">
        <option value="" disabled selected>Seleccione un avión:</option>
        <?php
        foreach ($aviones as $a) {
            echo "<option value='" . $a->getId() . "'>" . $a->getNombre() . "</option>";
        }
        ?>
    </select>

<?php } ?>