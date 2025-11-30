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

    require_once("../../logica/Pais.php");
    $pais = new Pais();
    $paises = $pais->consultar();
    ?>

    <div class="bloqueCiudad">
        <div class="my-3 ">
            <label class="form-label">Nombre: </label>
            <input type="text" class="form-control border border-danger-subtle" name="nombre[]">
        </div>
        <div class="my-3">
            <label class="form-label">Pais al que pertenece la ciudad: </label>
            <select class="form-select mt-1 mb-2 border border-danger-subtle" name="pais[]">
                <?php
                foreach ($paises as $p) {
                    echo "<option value='" . $p->getId() . "'>" . $p->getNombre() . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

<?php } ?>