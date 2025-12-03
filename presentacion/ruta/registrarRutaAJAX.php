<?php
session_start();
require_once("../../logica/Ciudad.php");
if ($_SESSION['rol'] != 'admin') {
    if ($_SERVER['REMOTE_ADDR'] == "::1") {
        header("Location: /proyecto2API/?pid=" . base64_encode("presentacion/noAutorizado.php"));
    } else {
        header('Location: /?pid=' . base64_encode("presentacion/noAutorizado.php"));
    }
    exit();
} else {

    require_once("../../logica/Ciudad.php");
    $ciudad = new Ciudad($_POST["ciudadId"]);
    $filtro= isset($_POST["filtro"]) ? $_POST["filtro"] : "";
    $ciudades = $ciudad->consultarDisponibles($filtro);
    

    ?>
    <?php foreach ($ciudades as $c): ?>
        <?php $id = $c->getId(); ?>
        <div class="col-md-4">
            <div class="form-check mb-1">
                <input class="form-check-input equipo-checkbox" type="checkbox" name="ciudades[]"
                    value="<?= $c->getId(); ?>" id="ciudad<?= htmlspecialchars($id) ?>">
                <label class="form-check-label d-flex align-items-center" for="ciudad<?= htmlspecialchars($id) ?>">
                    <?= htmlspecialchars($c->getNombre()) ?>
                </label>
            </div>
        </div>
    <?php endforeach; ?>

<?php } ?>