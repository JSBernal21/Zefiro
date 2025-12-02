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
    $ciudad = new Ciudad();
    $ciudades = $ciudad->consultar();
    ?>

    <div class="bloqueCiudad">
        <?php echo "----------------------------------------------"; ?>
        <div class="my-3 ">
            <label class="form-label">Nombre: </label>
            <input type="text" class="form-control border border-danger-subtle" name="nombre[]">
        </div>
        <div class="my-3 ">
            <label class="form-label">Cantidad de sillas: </label>
            <input type="text" class="form-control border border-danger-subtle" name="cantidad[]">
        </div>
        <div class="my-3">
            <label class="form-label">Ubicacion Ciudad: </label>
            <select class="form-select mt-1 mb-2 border border-danger-subtle" name="ciudad[]">
                <?php
                foreach ($ciudades as $c) {
                    echo "<option value='" . $c->getId() . "'>" . $c->getNombre() . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

<?php } ?>