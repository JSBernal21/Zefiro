<?php
$id = $_SESSION["id"];
if ($_SESSION["rol"] != "pasajero") {
    header('Location: ?pid=' . base64_encode("noAutorizado.php"));
}
$pasajero = new Pasajero();
$pasajero->consultarPorId();

$seguridad = new Seguridad();

if(isset($_POST["editar"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    if(!empty($_FILES["foto"]["name"])){
        $fotoNombre = time() . "." . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);    
        $fotoRutaLocal = $_FILES["foto"]["tmp_name"];
        copy($fotoRutaLocal, "imagenes/" . $fotoNombre);
    } else {
        $fotoNombre = "patoFotoPorDefecto.png";
    }
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    $pasajeroEditado = new Pasajero("", $nombre, $apellido, $correo, $clave, $fotoNombre, "", "");
    $pasajero->editar();



}

include ("presentacion/pasajero/menuPasajero.php");
?>

<div class="container py-4">
    <div class="row justify-content-center">
        
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary bg-opacity-75 text-white text-center">
                    <h5 class="m-0">Editar Perfil</h5>
                </div>

                <img src="img/patoEditarPerfil.png"
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
