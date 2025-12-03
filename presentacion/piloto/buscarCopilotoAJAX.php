<?php
session_start();
require_once("../../logica/Persona.php");
require_once("../../logica/Piloto.php");
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
    $piloto = isset($_POST["piloto"]) ? $_POST["piloto"] : "";
    $ruta = new Ruta($filtro);
    $ruta->consultarPorId();
    $ciudadOrigenId = $ruta->getOrigen()->getId();
    $piloto = new Piloto($piloto);
    $pilotos = $piloto->consultarCopilotoPorCiudad($ciudadOrigenId);
    ?>
    <label class="form-label">CoPilotos disponibles: </label>
    <select class="form-select mt-1 mb-2 border border-danger-subtle" name="piloto" id="piloto">
        <option value="" disabled selected>Seleccione un piloto:</option>
        <?php
        foreach ($pilotos as $p) {
            echo "<option value='" . $p->getId() . "'>" . $p->getNombre() . "</option>";
        }
        ?>
    </select>

<?php } ?>