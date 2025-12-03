<?php
if ($_SESSION['rol'] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {

    $ciudad = new Ciudad();
    $ciudades = $ciudad->consultar();

    if (isset($_POST['actualizarCiudad'])) {
        $_SESSION['idCiudad'] = $_POST['actualizarCiudad'];
        header("Location: ?pid=" . base64_encode("presentacion/ciudad/editarCiudades.php"));
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
                        Ciudades Registradas
                    </div>
                </div>
                <div class="card-body">

                <?php
                if (count($ciudades) == 0) {
                    echo "<div class='alert alert-warning'>No hay registros</div>";
                } else {
                ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Pais</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ciudades as $c) { ?>
                            <tr>
                                <td><?= $c->getNombre() ?></td>
                                <td><?= $c->getPais()->getNombre() ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <button type="submit" name="actualizarCiudad" value="<?= $c->getId() ?>" class="btn btn-warning btn-sm">
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

<?php } ?>
