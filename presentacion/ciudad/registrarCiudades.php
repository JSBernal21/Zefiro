<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $pais = new Pais();
    $paises = $pais->consultar();
    if (isset($_POST["registrarCiudad"])) {
        $seguridad = new Seguridad();
        $nombres = $_POST["nombre"];
        $paises = $_POST["pais"];
        for ($i = 0; $i < count($nombres); $i++) {
            $nombre = $seguridad->limpiar_cadena($nombres[$i]);
            $paisId = $seguridad->limpiar_cadena($paises[$i]);
            if (empty($nombre) || $paisId == 0) {
                continue; // Saltar si el nombre está vacío o el país no es válido
            }
            $ciudad = new Ciudad("", $nombre, $paisId);
            $ciudad->registrar();
            header("Location: ?pid=" . base64_encode("presentacion/ciudad/registrarCiudades.php"));
        }
    }

    include("presentacion/admin/menuAdmin.php");
    ?>

    <div class="container my-4 p-5">
        <div class="card shadow-lg rounded-4 mx-5 border border-danger-subtle p-2">
            <div class="bg-primary rounded-top-4 bg-opacity-100">
                <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                    POR FAVOR INGRESE LA SIGUIENTE INFORMACION DE LA CIUDAD:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/ciudad/registrarCiudades.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <div id="ciudades">
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
                    </div>
                    <div class="row">
                        <div class="text-ligth text-start col-6">
                            <button type="button" class="btn" id="agregarCiudad">
                                <div class="bg-success bg-opacity-75 p-2 rounded-4 fw-bold text-light">Agregar Ciudad</div>
                            </button>
                            <button type="button" class="btn" id="quitarCiudad">
                                <div class="bg-danger bg-opacity-75 p-2 rounded-4 fw-bold text-light">Quitar Ciudad</div>
                            </button>
                        </div>
                        <div class="text-ligth text-end col-6">
                            <button type="submit" class="btn" name="registrarCiudad">
                                <div class="bg-primary rounded-4">
                                    <div class="bg-danger bg-opacity-50 p-2 rounded-4 fw-bold text-light">Registrar Ciudad
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
        $("#agregarCiudad").on("click", function () {
            $.ajax({
                type: "POST",
                url: "presentacion/ciudad/registrarCiudadesAJAX.php",
                success: function (respuesta) {
                    $("#ciudades").append(respuesta);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {

        $("#quitarCiudad").on("click", function () {
            var total = $("#ciudades .bloqueCiudad").length;
            if (total > 1) {
                $("#ciudades .bloqueCiudad").last().remove();
            }
        });

    });
</script>