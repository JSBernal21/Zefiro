<?php
if ($_SESSION['rol'] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $piloto = new Piloto();
    $pilotos = $piloto->consultar();
    if (isset($_POST['actualizarPiloto'])) {
        $_SESSION['idPiloto'] = $_POST['actualizarPiloto'];
        header("Location: ?pid=" . base64_encode("presentacion/piloto/actualizarPiloto.php"));
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
                            Pilotos Registrados
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (count($pilotos) == 0) {
                            echo "<div class='alert alert-warning' role='alert'>
                                    No hay registros
                                    </div>";
                        } else {
                            ?>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Ubicacion Actual</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pilotos as $p) {
                                        echo "<tr>";
                                        echo "<td scope='col'>" . $p->getId() . "</td>";
                                        echo "<td scope='col'>" . $p->getNombre() . "</td>";
                                        echo "<td scope='col'>" . $p->getApellido() . "</td>";
                                        echo "<td scope='col'>" . $p->getCorreo() . "</td>";
                                        echo "<td scope='col'>" . (($p->getImagen() != "") ? "<img src='imagenes/piloto/" . $p->getImagen() . "' height='60px'>" : "") . "</td>";
                                        echo "<td scope='col'><div id='estado" . $p->getId() . "'>" . ($p->getEstado() ? "<div class='rounded-4 bg-success text-light px-1'><i class='fa-solid fa-circle-check'></i> Activo</div>" : "<div class='rounded-4 bg-danger text-light px-1'><i class='fa-solid fa-circle-xmark'></i> Inactivo</div>") . "</div></td>";
                                        echo "<td scope='col'>" . $p->getCiudad()->getNombre() . "</td>";
                                        echo "<td scope='col'>
                                                <form method='POST' style='display:inline;'>
                                                    <button 
                                                        type='submit' 
                                                        name='actualizarPiloto' 
                                                        value='" . $p->getId() . "' 
                                                        class='btn btn-warning btn-sm'>
                                                        Editar
                                                    </button>
                                                </form>
                                                <button class='border border-none' id='habilitar" . $p->getId() . "' " . ($p->getEstado() ? "style='display: none;'" : "style") . "><div class='rounded-4 bg-success text-light px-1'><i class='fa-solid fa-circle-check'></i> Habilitar</div></button>
                                                <button class='border border-none' id='inhabilitar" . $p->getId() . "' " . ($p->getEstado() ? "style" : "style='display: none;'") . "><div class='rounded-4 bg-danger text-light px-1'><i class='fa-solid fa-circle-xmark'></i> Inhabilitar</div></button>
                                              </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        <?php
        foreach ($pilotos as $p) {
            ?>
            $("#inhabilitar<?php echo $p->getId() ?>").click(function () {
                $.ajax({
                    type: "POST",
                    url: "presentacion/piloto/cambiarEstadoPiloto.php",
                    data: {
                        id: <?php echo $p->getId() ?>,
                        e: 0
                    },
                    success: function (respuesta) {
                        $("#estado<?php echo $p->getId() ?>").html(respuesta);
                        $("#inhabilitar<?php echo $p->getId() ?>").hide();
                        $("#habilitar<?php echo $p->getId() ?>").show();
                    }
                });
            });
            $("#habilitar<?php echo $p->getId() ?>").click(function () {
                $.ajax({
                    type: "POST",
                    url: "presentacion/piloto/cambiarEstadoPiloto.php",
                    data: {
                        id: <?php echo $p->getId() ?>,
                        e: 1
                    },
                    success: function (respuesta) {
                        $("#estado<?php echo $p->getId() ?>").html(respuesta);
                        $("#habilitar<?php echo $p->getId() ?>").hide();
                        $("#inhabilitar<?php echo $p->getId() ?>").show();
                    }
                });
            });
            <?php
        }
        ?>
    </script>
    <?php
}
?>