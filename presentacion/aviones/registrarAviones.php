<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $ciudad = new Ciudad();
    $ciudades = $ciudad->consultar();
    if (isset($_POST["registrarAvion"])) {
        $seguridad = new Seguridad();
        $nombres = $_POST["nombre"];
        $cantidades = $_POST["cantidad"];
        $ciudades = $_POST["ciudad"];
        for ($i = 0; $i < count($nombres); $i++) {
            $nombre = $seguridad->limpiar_cadena($nombres[$i]);
            $cantidad = $seguridad->limpiar_cadena($cantidades[$i]);
            $ciudadId = $seguridad->limpiar_cadena($ciudades[$i]);
            if (empty($nombre) || $cantidad == 0) {
                continue; // Saltar si el nombre está vacío o el país no es válido
            }
            $avion = new Avion("", $nombre, $cantidad, $ciudadId);
            $avion->registrar();
            header("Location: ?pid=" . base64_encode("presentacion/aviones/registrarAviones.php"));
        }
    }

    include("presentacion/admin/menuAdmin.php");
    ?>

    <div class="container my-4 p-5">
        <div class="card shadow-lg rounded-4 mx-5 border border-danger-subtle p-2">
            <div class="bg-primary rounded-top-4 bg-opacity-100">
                <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                    POR FAVOR INGRESE LA SIGUIENTE INFORMACION PARA CADA AVION:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/aviones/registrarAviones.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <div id="ciudades">
                        <div class="bloqueCiudad">
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
                    </div>
                    <div class="row">
                        <div class="text-ligth text-start col-6">
                            <button type="button" class="btn" id="agregarAvion">
                                <div class="bg-success bg-opacity-75 p-2 rounded-4 fw-bold text-light">Agregar Avion</div>
                            </button>
                            <button type="button" class="btn" id="quitarAvion">
                                <div class="bg-danger bg-opacity-75 p-2 rounded-4 fw-bold text-light">Quitar Avion</div>
                            </button>
                        </div>
                        <div class="text-ligth text-end col-6">
                            <button type="submit" class="btn" name="registrarAvion">
                                <div class="bg-primary rounded-4">
                                    <div class="bg-danger bg-opacity-50 p-2 rounded-4 fw-bold text-light">Registrar Avion
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
<script>
    $(document).ready(function () {
        $("#agregarAvion").on("click", function () {
            $.ajax({
                type: "POST",
                url: "presentacion/aviones/registrarAvionesAJAX.php",
                success: function (respuesta) {
                    $("#ciudades").append(respuesta);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {

        $("#quitarAvion").on("click", function () {
            var total = $("#ciudades .bloqueCiudad").length;
            if (total > 1) {
                $("#ciudades .bloqueCiudad").last().remove();
            }
        });

    });
</script>