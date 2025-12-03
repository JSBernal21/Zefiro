<?php
session_start();
require_once("../../logica/Ciudad.php");
require_once("../../logica/Ruta.php");
if ($_SESSION['rol'] != 'admin') {
    if ($_SERVER['REMOTE_ADDR'] == "::1") {
        header("Location: /proyecto2API/?pid=" . base64_encode("presentacion/noAutorizado.php"));
    } else {
        header('Location: /?pid=' . base64_encode("presentacion/noAutorizado.php"));
    }
    exit();
} else {

    require_once("../../logica/Ciudad.php");

    $ruta = new Ruta();
    $filtro = isset($_POST["filtro"]) ? $_POST["filtro"] : "";
    $rutas = $ruta->consultarRuta($filtro);

    ?>
    
    <select class="form-select mt-1 mb-2 border border-danger-subtle" name="ruta" id="ruta">
        <option value="" disabled selected>Seleccione una ruta:</option>
        <?php
        foreach ($rutas as $r) {
            echo "<option value='" . $r->getId() . "'>" . $r->getDescripcion() . "</option>";
        }
        ?>
    </select>

<?php } ?>