<?php
if ($_SESSION['rol'] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {

    $ruta = new Ruta();
    $rutas = $ruta->consultar();

    if (isset($_POST['eliminarRuta'])) {
        $_SESSION['idRuta'] = $_POST['eliminarRuta'];
        header("Location: ?pid=" . base64_encode("presentacion/ruta/eliminarRuta.php"));
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
                        Rutas Registradas
                    </div>
                </div>
                <div class="card-body">

                <?php
                if (count($rutas) == 0) {
                    echo "<div class='alert alert-warning'>No hay registros</div>";
                } else {
                ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ciudad de salida</th>
                                <th>Ciudad de destino</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rutas as $r) { ?>
                            <tr>
                                <td><?= $r->getDescripcion() ?></td>
                                <td><?= $r->getOrigen()->getNombre() ?></td>
                                <td><?= $r->getDestino()->getNombre() ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <button type="submit" name="eliminarRuta" value="<?= $r->getId() ?>" class="btn btn-danger btn-sm">
                                            Eliminar
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

<?php } ?>
