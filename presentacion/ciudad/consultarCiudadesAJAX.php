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
    
    $pais = isset($_POST['pais']) ? $_POST['pais'] : null;
    if ($pais === null) {
        if ($_SERVER['REMOTE_ADDR'] == "::1") {
            header("Location: /proyecto2API/?pid=" . base64_encode("presentacion/noAutorizado.php"));
        } else {
            header('Location: /?pid=' . base64_encode("presentacion/noAutorizado.php"));
        }
        exit();
    } else {
        $ciudadId = isset($_POST['ciudadId']) ? $_POST['ciudadId'] : null;
        $ciudad = new Ciudad("", "", $pais);
        $ciudades = $ciudad->consultarPorPais();
        ?>
        <select class="form-select border border-danger-subtle" name="ciudad" id="ciudadSelect" required>
            <option value="0" disabled <?php echo ($ciudadId===null) ? "selected" : ""; ?>>Seleccione una ciudad</option>
            <?php
            foreach ($ciudades as $c) {
                echo "<option value='" . $c->getId() . "' ".($c->getId() == $ciudadId ? "selected" : "").">" . $c->getNombre() . "</option>";
            }
            ?>
        </select>
        <?php
    }
}
