<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $ciudad = new Ciudad();
    $ciudades = $ciudad->consultar();
    if (isset($_POST["registrarRuta"])) {

        $seguridad = new Seguridad();

        if (!isset($_POST["ciudades"]) || count($_POST["ciudades"]) == 0) {
            echo "<script>alert('Debe seleccionar al menos una ciudad');</script>";
        } else {

            $ciudadSalida = $seguridad->limpiar_cadena($_POST["ciudadSalida"]);
            $ciudadesDestino = $_POST["ciudades"];
            $ciudadSal = new Ciudad($ciudadSalida);
            $ciudadSal->consultarPorId();
            foreach ($ciudadesDestino as $idCiudadDestino) {
                $idDestino = $seguridad->limpiar_cadena($idCiudadDestino);
                $ciudadDes = new Ciudad($idDestino);
                $ciudadDes->consultarPorId();
                $descripcion = $ciudadSal->getNombre() . "→" . $ciudadDes->getNombre();
                $ruta = new Ruta("", $descripcion, $ciudadSalida, $idDestino);
                $ruta->registrar();
            }
        }
    }


    include("presentacion/admin/menuAdmin.php");
    ?>

    <div class="container my-4 p-5">
        <div class="card shadow-lg rounded-4 mx-5 border border-danger-subtle p-2">
            <div class="bg-primary rounded-top-4 bg-opacity-100">
                <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                    POR FAVOR INGRESE LA SIGUIENTE INFORMACION:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/ruta/registrarRuta.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <div id="ciudades">
                        <div class="bloqueCiudad">
                            <div class="my-3">
                                <label class="form-label">Ciudad de salida: </label>
                                <select class="form-select mt-1 mb-2 border border-danger-subtle" name="ciudadSalida"
                                    id="ciudad">
                                    <option value="" disabled selected>Seleccione una ciudad</option>
                                    <?php
                                    foreach ($ciudades as $c) {
                                        echo "<option value='" . $c->getId() . "'>" . $c->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="my-3 ">
                                <label class="form-label">Ciudades a las que puede llegar: </label>
                                <input type="text" class="form-control border border-danger-subtle" name="filtroCiudades"
                                    id="filtro" placeholder="Escriba para filtrar ciudades...">
                                <div class="mb-3 row" id="ciudadesDisponibles">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-ligth text-start col-6">
                        </div>
                        <div class="text-ligth text-end col-6">
                            <button type="submit" class="btn" name="registrarRuta">
                                <div class="bg-primary rounded-4">
                                    <div class="bg-danger bg-opacity-50 p-2 rounded-4 fw-bold text-light">Registrar ruta
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
        $("#ciudad").on("change", function () {
            if ($("#filtro").val.length > 0) {
                $.ajax({
                    type: "POST",
                    data: { ciudadId: $("#ciudad").val(), filtro: $("#filtro").val() },
                    url: "presentacion/ruta/registrarRutaAJAX.php",
                    success: function (respuesta) {
                        $("#ciudadesDisponibles").html(respuesta);
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    data: { ciudadId: $("#ciudad").val() },
                    url: "presentacion/ruta/registrarRutaAJAX.php",
                    success: function (respuesta) {
                        $("#ciudadesDisponibles").html(respuesta);
                        restaurarSeleccion();
                    }
                });
            }
            $("#filtro").on("keyup", function () {
                $.ajax({
                    type: "POST",
                    data: { ciudadId: $("#ciudad").val(), filtro: $("#filtro").val() },
                    url: "presentacion/ruta/registrarRutaAJAX.php",
                    success: function (respuesta) {
                        $("#ciudadesDisponibles").html(respuesta);
                        restaurarSeleccion();
                    }
                });
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
<script>
    let ciudadesSeleccionadas = [];
    $(document).on("change", ".equipo-checkbox", function () {
        const valor = $(this).val();
        if ($(this).is(":checked")) {
            if (!ciudadesSeleccionadas.includes(valor)) {
                ciudadesSeleccionadas.push(valor);
            }
        } else {
            ciudadesSeleccionadas = ciudadesSeleccionadas.filter(id => id !== valor);
        }
    });
    function restaurarSeleccion() {
        $(".equipo-checkbox").each(function () {
            if (ciudadesSeleccionadas.includes($(this).val())) {
                $(this).prop("checked", true);
            }
        });
    }
</script>