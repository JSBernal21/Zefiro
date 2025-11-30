<?php
$error = 0;
if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {

    $pais = new Pais();
    $paises = $pais->consultar();
    $piloto = new Piloto($_SESSION['idPiloto']);
    $piloto->consultarPorId();

    if (isset($_POST["actualizarPiloto"])) {
        $seguridad = new Seguridad();
        $nombre = $seguridad->limpiar_cadena($_POST["nombre"]);
        $apellido = $seguridad->limpiar_cadena($_POST["apellido"]);
        $ciudadId = $seguridad->limpiar_cadena($_POST["ciudad"]);
        $imagen = $seguridad->limpiar_cadena($_FILES["imagen"]["name"]);
        $imagenAnt = $piloto->getImagen();
        if ($imagen != "") {
            $imgExtension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
            $tamano = $_FILES["imagen"]["size"];
            $tipos = array("jpeg", "jpg", "png");
            if (in_array($imgExtension, $tipos) && ($tamano < 2000000)) {
                if ($imagenAnt != "" && $imagenAnt != "porDefecto.png") {
                    unlink("imagenes/piloto/" . $imagenAnt);
                }
                $imagenRutaLocal = $_FILES["imagen"]["tmp_name"];
                $imagenAnt = date("Ymd_His") . "." . $imgExtension;
                copy($imagenRutaLocal, "imagenes/piloto/" . $imagenAnt);
                $imagen = $imagenAnt;
            } else {
                $error = 1;
                $imagen = $imagenAnt;
                //echo "<script>alert('La imagen no es correcta. Solo se permiten archivos jpg, jpeg, png y deben ser menores a 2MB');</script>";
            }
        } else {
            $imagen = $imagenAnt;
        }
        $piloto = new Piloto($piloto->getId(), $nombre, $apellido, "", "", $imagen, "", $ciudadId);
        $piloto->actualizar();
        $piloto->consultarPorId();

    }
    ?>
    <?php include("presentacion/admin/menuAdmin.php"); ?>
    <div class="container mb-4 p-5">
        <div class="card shadow-lg rounded-4 mx-5 border border-danger-subtle p-2">
            <div class="bg-primary rounded-top-4 bg-opacity-100">
                <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                    INFORMACION ACTUAL DEL PILOTO:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/piloto/actualizarPiloto.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="my-3 ">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control border border-danger-subtle" aria-describedby="emailHelp"
                            name="nombre" value="<?php echo $piloto->getNombre() ?>">
                    </div>
                    <div class="my-3">
                        <label class="form-label">Apellido: </label>
                        <input type="text" class="form-control border border-danger-subtle" name="apellido"
                            value="<?php echo $piloto->getApellido() ?>">
                    </div>
                    <div class="my-3 ">
                        <label class="form-label">Correo: </label>
                        <input type="email" class="form-control border border-danger-subtle" aria-describedby="emailHelp"
                            placeholder="Example:Juan21@example.com" name="correo"
                            value="<?php echo $piloto->getCorreo() ?>">
                    </div>
                    <div class="my-3">
                        <label class="form-label">imagen: </label>
                        <label class="form-label">Actual: <img src="imagenes/piloto/<?php echo $piloto->getImagen() ?>"
                                height="60px"></label>
                        <input type="file" class="form-control border border-danger-subtle" name="imagen">
                    </div>
                    <div class="my-3">
                        <label class="form-label">Seleccione donde se encuentra el piloto: </label>
                        <select class="form-select mt-1 mb-2 border border-danger-subtle" id="pais">
                            <?php
                            foreach ($paises as $p) {
                                echo "<option value='" . $p->getId() . "' " . ($p->getId() == $piloto->getCiudad()->getPais()->getId() ? "selected" : "") . ">" . $p->getNombre() . "</option>";
                            }
                            ?>
                        </select>
                        <div id="ciudad">
                        </div>
                    </div>
                    <div class="text-ligth text-end">
                        <button type="submit" class="btn" name="actualizarPiloto">
                            <div class="bg-primary rounded-4">
                                <div class="bg-danger bg-opacity-50 p-2 rounded-4 fw-bold text-light">Actualizar Piloto
                                </div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $(document).ready(function () {
        $("#pais").change(function () {
            var Pais = $("#pais").val();
            let ciudadId = "<?php echo $piloto->getCiudad()->getId() ?>";
            $.ajax({
                type: "POST",
                url: "presentacion/ciudad/consultarCiudadesAJAX.php",
                data: { pais: Pais, ciudadId: ciudadId },
                success: function (respuesta) {
                    $("#ciudad").html(respuesta);
                }
            });
        });
        $("#pais").trigger("change");
    });
</script>