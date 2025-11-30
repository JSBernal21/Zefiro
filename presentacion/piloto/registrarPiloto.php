<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") {
    header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
} else {
    $pais = new Pais();
    $paises = $pais->consultar();
    if (isset($_POST["registrarPiloto"])) {
        $seguridad = new Seguridad();
        $nombre = $seguridad->limpiar_cadena($_POST["nombre"]);
        $apellido = $seguridad->limpiar_cadena($_POST["apellido"]);
        $correo = $seguridad->limpiar_cadena($_POST["correo"]);
        $clave = $seguridad->limpiar_cadena($_POST["clave"]);
        $ciudadId = $seguridad->limpiar_cadena($_POST["ciudad"]);
        $imagen = "porDefecto.png";
        $piloto = new Piloto("", $nombre, $apellido, $correo, $clave, $imagen,0,$ciudadId);
        $piloto->registrar();
        $asunto = "Confirmacion de registro - Zefiro";
        $mensaje = "Hola " . $nombre . "\n\r";
        $mensaje .= "Debe activar su cuenta haciendo clic en: \n\r";
        $mensaje .= "http://cocinaetilica.itiud.org/?pid=" . base64_encode("presentacion/piloto/activarPiloto.php") . "&c=" . base64_encode($correo) . "&p=" . base64_encode($clave);
        $opciones = array(
            "From" => "Zefiro <contacto@itiud.org>",
            "Reply-To" => "no-responder@itiud.org"
        );

        mail($correo, $asunto, $mensaje, $opciones);
    }
    include("presentacion/admin/menuAdmin.php");
    ?>

    <div class="container my-4 p-5">
        <div class="card shadow-lg rounded-4 mx-5 border border-danger-subtle p-2">
            <div class="bg-primary rounded-top-4 bg-opacity-100">
                <div class="card-head rounded-top-4 p-3 bg-danger bg-opacity-50 text-center fw-bold text-light">
                    POR FAVOR INGRESE LA SIGUIENTE INFORMACION DEL PILOTO:
                </div>
            </div>
            <div class="card-body">
                <form action="?pid=<?php echo base64_encode("presentacion/piloto/registrarPiloto.php") ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="my-3 ">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control border border-danger-subtle" aria-describedby="emailHelp"
                            name="nombre">
                    </div>
                    <div class="my-3">
                        <label class="form-label">Apellido: </label>
                        <input type="text" class="form-control border border-danger-subtle" name="apellido">
                    </div>
                    <div class="my-3 ">
                        <label class="form-label">Correo: </label>
                        <input type="email" class="form-control border border-danger-subtle" aria-describedby="emailHelp"
                            placeholder="Example:Juan21@example.com" name="correo">
                    </div>
                    <div class="my-3">
                        <label class="form-label">Contraseña: </label>
                        <input type="password" class="form-control border border-danger-subtle" name="clave">
                    </div>
                    <div class="my-3">
                        <label class="form-label">Seleccione donde se encuentra el piloto: </label>
                       <select class="form-select mt-1 mb-2 border border-danger-subtle" id="pais">
                            <?php
                            foreach ($paises as $p) {
                                echo "<option value='" . $p->getId() . "'>" . $p->getNombre() . "</option>";
                            }
                            ?>
                        </select>
                        <div id="ciudad">
                        </div>
                    </div>
                    <div class="text-ligth text-end">
                        <button type="submit" class="btn" name="registrarPiloto">
                            <div class="bg-primary rounded-4">
                                <div class="bg-danger bg-opacity-50 p-2 rounded-4 fw-bold text-light">Registrar Piloto</div>
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
            $.ajax({
                type: "POST",
                url: "presentacion/ciudad/consultarCiudadesAJAX.php",
                data: { pais: Pais },
                success: function (respuesta) {
                    $("#ciudad").html(respuesta);
                }
            });
        });
        $("#pais").trigger("change");
    });
</script>