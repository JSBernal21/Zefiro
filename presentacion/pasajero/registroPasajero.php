<?php

if(isset($_POST["registrar"])){
    $idPasajero = $_POST["idPasajero"];
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

    $pasajero = new Pasajero($idPasajero, $nombre, $apellido, $correo, $clave, $fotoNombre, 0, "");
    $pasajero->registrar();

    $asunto = "Activacion de la cuenta - Zefiro Aerolinea";
    $mensaje = '
    <html>
        <head>
            <meta charset="UTF-8">
        </head>
        <body class="text-center">
            <img src="https://p3.itiud.org/img/patoActivarCuenta.png" 
                alt="Zefiro Logo" 
                style="max-width: 200px; display: block; margin: 0 auto;">
            <h2>Hola ' . $nombre . '</h2>
            <p>Para activar su cuenta haga clic en el siguiente enlace:</p>
            <a class="btn text-white" style="background-color:#6f42c1;"
                href="http://p3.itiud.org/?pid=' . base64_encode("presentacion/pasajero/activarPasajero.php") . '&c=' . base64_encode($correo) . '">Activar Cuenta</a>
        </body>
    </html>
    ';
    $opciones = array(
        "From" => "Zefiro Aerolinea <zefiroZA@zefiro.com>",
        "Reply-To" => "no-responder@itiud.org"
    );
    
    //mail($correo, $asunto, $mensaje, $opciones);

    if(mail($correo, $asunto, $mensaje, $opciones)){
        echo "Mensaje enviado ¡Revisa tu correo!'";
    } else {
        echo "Error al enviar el mensaje por correo";
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

                <?php 
                if(isset($_POST["crear"])){
                    echo "<div class='alert alert-success' role='alert'>
                            Usuario creado exitosamente!
                            </div>";
                }
                ?>
                <div class="card-body">
                    <form action="?pid=<?php echo base64_encode("presentacion/pasajero/registroPasajero.php") ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Numero de Identificacion<span class="text-danger">*</span></label>
                            <input type="number" id="idPasajero" name="idPasajero" class="form-control" placeholder="Ingresa tu numero de identificación" required>
                        </div>
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
                            <input class="form-control" name="foto" id="foto" type="file" id="formFile" accept="image/*">
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