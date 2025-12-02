<?php
if ($_SESSION['rol'] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {

    $avion = new Avion();
    $aviones = $avion->consultar();

    if (isset($_POST['actualizarAvion'])) {
        $_SESSION['idAvion'] = $_POST['actualizarAvion'];
        header("Location: ?pid=" . base64_encode("presentacion/aviones/editarAvion.php"));
        exit;
    }

    include("presentacion/admin/menuAdmin.php");
?>
<div class="container">
    <div class="row my-5">
        <div class="col">
            <div class="card border-danger-subtle shadow-lg mx-5">
                <div class="bg-primary rounded-top-4 bg-opacity-100">
                    <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                        Aviones Registrados
                    </div>
                </div>
                <div class="card-body">

                <?php
                if (count($aviones) == 0) {
                    echo "<div class='alert alert-warning'>No hay registros</div>";
                } else {
                ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Capacidad</th>
                                <th>Ubicación Actual</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($aviones as $a) { ?>
                            <tr>
                                <td><?= $a->getNombre() ?></td>
                                <td><?= $a->getCapacidad() ?></td>
                                <td><?= $a->getUbicacionActual()->getNombre() ?></td>

                                <td>
                                    <form method="POST" style="display:inline;">
                                        <button type="submit" name="actualizarAvion" value="<?= $a->getId() ?>" class="btn btn-warning btn-sm">
                                            Editar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
<?php foreach ($aviones as $a) { ?>

$("#inhabilitar<?= $a->getId() ?>").click(function () {
    $.ajax({
        type: "POST",
        url: "presentacion/avion/cambiarEstadoAvion.php",
        data: { id: <?= $a->getId() ?>, e: 0 },
        success: function (respuesta) {
            $("#estado<?= $a->getId() ?>").html(respuesta);
            $("#inhabilitar<?= $a->getId() ?>").hide();
            $("#habilitar<?= $a->getId() ?>").show();
        }
    });
});

$("#habilitar<?= $a->getId() ?>").click(function () {
    $.ajax({
        type: "POST",
        url: "presentacion/avion/cambiarEstadoAvion.php",
        data: { id: <?= $a->getId() ?>, e: 1 },
        success: function (respuesta) {
            $("#estado<?= $a->getId() ?>").html(respuesta);
            $("#habilitar<?= $a->getId() ?>").hide();
            $("#inhabilitar<?= $a->getId() ?>").show();
        }
    });
});

<?php } ?>
</script>

<?php } ?>
