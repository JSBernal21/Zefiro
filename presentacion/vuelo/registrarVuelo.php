<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $ruta = new Ruta();
    $rutas = $ruta->consultar();
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
                    POR FAVOR INGRESE LA INFORMACION SOBRE EL VUELO:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/vuelo/registrarVuelo.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <!-- fecha hora -->
                    <div>
                        <label class="form-label">Fecha y hora de salida:</label>
                        <input type="datetime-local" id="fechahora" name="fechahora"
                            class="form-control border border-danger-subtle">
                    </div>
                    <!-- ruta-> id origen para consultar pilotos y aviones -->
                    <div>

                        <label class="form-label">Rutas:</label>
                        <input class="form-control  border border-danger-subtle" type="text" id="filtro" name="filtro"
                            placeholder="escriba aqui para filtrar">
                        <div id="selectruta">
                            <select class="form-select mt-1 mb-2 border border-danger-subtle" name="ruta" id="ruta">
                                <option value="" disabled selected>Seleccione una ruta:</option>
                                <?php
                                foreach ($rutas as $r) {
                                    echo $r->getId();
                                    echo "<option value='" . $r->getId() . "'>" . $r->getDescripcion() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- piloto y copiloto --->
                <div id="piloto">
                </div>
                <div id="copiloto">
                </div>
                <!-- aviones --->
                <div id="aviones">
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
        $("#filtro").on("keyup", function () {
            if ($("#filtro").val().length > 2) {
                $.ajax({
                    type: "POST",
                    data: { filtro: $("#filtro").val() },
                    url: "presentacion/ruta/consultarRutaAJAX.php",
                    success: function (respuesta) {
                        $("#selectruta").html(respuesta);
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    data: { filtro: null },
                    url: "presentacion/ruta/consultarRutaAJAX.php",
                    success: function (respuesta) {
                        $("#selectruta").html(respuesta);
                    }
                });
            }
        });
    });
    $(document).on("change", "#ruta", function () {

        $.ajax({
            type: "POST",
            data: { rutaId: $("#ruta").val() },
            url: "presentacion/piloto/buscarPilotoAJAX.php",
            success: function (respuesta) {
                $("#piloto").html(respuesta);
            }
        });

        $.ajax({
            type: "POST",
            data: { rutaId: $("#ruta").val() },
            url: "presentacion/aviones/buscarAvionAJAX.php",
            success: function (respuesta) {
                $("#aviones").html(respuesta);
            }
        });

    });
    $(document).on("change", "#idpiloto", function () {
        $.ajax({
            type: "POST",
            data: { rutaId: $("#ruta").val(), piloto: $("#idpiloto").val() },
            url: "presentacion/piloto/buscarCopilotoAJAX.php",
            success: function (respuesta) {
                $("#copiloto").html(respuesta);
            }
        });
    });
    
</script>