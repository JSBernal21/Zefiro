<?php
if(isset($_POST["registrar"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $TipoDocumento_idTipoDocumento = $_POST["TipoDocumento_idTipoDocumento"];    
    $foto = "";
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

        if ($yaExiste) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(){
                alert('Ese número de documento ya está registrado.');
                document.getElementById('idDueño').focus();
            });
            </script>";
        } else {
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $rutaLocal = $_FILES["foto"]["tmp_name"];
                $nuevoNombre = time() . ".png";
                $rutaServidor = "img/pasajero/" . $nuevoNombre;
                copy($rutaLocal, $rutaServidor);
                $foto = $nuevoNombre;
            }

            $dueño = new Dueño(
            $idDueño,
            $nombre,
            $apellido,
            $correo,
            $claveHasheada,
            $fechaNacimiento,
            $direccion,
            $telefono,
            $foto,
            $Localidad_idLocalidad,
            $TipoDocumento_idTipoDocumento
            );

            if ($dueño->insertar()) {
                header("Location: ?pid=" . base64_encode("Presentacion/registroDueño.php") . "&exito=true");
                exit;
            } else {
                $error = "Hubo un error al crear el usuario.";
            }
        }

}

include "presentacion/navInicio.php"
?>

<div class="container py-4">
    <div class="row justify-content-center">
        
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary bg-opacity-75 text-white text-center">
                    <h5 class="m-0">Regístrate en Zefiro</h5>
                </div>

                <img src="img/patoFormulario.png"
                    class="img-fluid mx-auto d-block p-3"
                    style="max-height: 220px; object-fit: contain;">

                <div class="card-body">
                    <form action="?pid=<?php echo base64_encode("Presentacion/registroCliente.php") ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nombre/s<span class="text-danger">*</span></label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellidos<span class="text-danger">*</span></label>
                            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingresa tus apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" name="foto" id="foto" type="file" id="formFile">
                            <div class="form-text">(opcional)</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo<span class="text-danger">*</span></label>
                            <input type="email" id="correo" name="correo" class="form-control" placeholder="correo@ejemplo.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Clave<span class="text-danger">*</span></label>
                            <input type="password" id="clave" name="clave" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color:#6f42c1;" name="registrar">
                                Registrarse
                            </button>
                        </div>
                        <div class="d-grid mt-4">
                            <p class="text-center">¿Ya tienes una cuenta?</p>
                            <a href="?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>" class="btn text-white" style="background-color:#a078eb;">Iniciar Sesión</a>                             
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
    echo ("editar Perfil = <a href='?pid=" . base64_encode("presentacion/pasajero/editarPerfilPasajero.php") . "'>editarPerfilPasajero</a>");
    echo ("no Autorizado = <a href='?pid=" . base64_encode("presentacion/noAutorizado.php") . "'>noAutorizado</a>");
?>