<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $avion = new Avion($_SESSION['idAvion']);
    $avion->consultarPorId();
    $ciudad = new Ciudad();
    $ciudades = $ciudad->consultar();
    if (isset($_POST["editarAvion"])) {
        $seguridad = new Seguridad();
        $nombres = $_POST["nombre"];
        $cantidades = $_POST["cantidad"];
        $ciudades = $_POST["ciudad"];
        $nombre = $seguridad->limpiar_cadena($nombres);
        $cantidad = $seguridad->limpiar_cadena($cantidades);
        $ciudadId = $seguridad->limpiar_cadena($ciudades);
        $avion = new Avion($_SESSION['idAvion'], $nombre, $cantidad, $ciudadId);
        $avion->actualizar();
        $avion->consultarPorId();
        $ciudades = $ciudad->consultar();
    }

    include("presentacion/admin/menuAdmin.php");
    ?>

    <div class="container my-4 p-5">
        <div class="card shadow-lg rounded-4 mx-5 border border-danger-subtle p-2">
            <div class="bg-primary rounded-top-4 bg-opacity-100">
                <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                    POR FAVOR INGRESE LA SIGUIENTE INFORMACION DEL AVION:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/aviones/editarAvion.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <div id="ciudades">
                        <div class="bloqueCiudad">
                            <div class="my-3 ">
                                <label class="form-label">Nombre: </label>
                                <input type="text" class="form-control border border-danger-subtle" name="nombre" value="<?php echo $avion->getNombre()?>">
                            </div>
                            <div class="my-3 ">
                                <label class="form-label">Cantidad de sillas: </label>
                                <input type="text" class="form-control border border-danger-subtle" name="cantidad" value="<?php echo $avion->getCapacidad()?>">
                            </div>
                            <div class="my-3">
                                <label class="form-label">Ubicacion Ciudad: </label>
                                <select class="form-select mt-1 mb-2 border border-danger-subtle" name="ciudad">
                                    <?php
                                    foreach ($ciudades as $c) {
                                        echo "<option value='" . $c->getId() . "' " . ($c->getId() == $avion->getUbicacionActual()->getId() ? "selected" : "") . ">" . $c->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-ligth text-start col-6">
                        </div>
                        <div class="text-ligth text-end col-6">
                            <button type="submit" class="btn" name="editarAvion">
                                <div class="bg-primary rounded-4">
                                    <div class="bg-danger bg-opacity-50 p-2 rounded-4 fw-bold text-light">Editar Avion
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>