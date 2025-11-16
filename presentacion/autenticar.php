<?php

$error = 0; // 0=sin errores, 1=credenciales invalidas, 2=no habilitado

if (isset($_POST["autenticar"])) {
    $seguridad = new Seguridad();
    $correo = $seguridad->limpiar_cadena($_POST["correo"]);
    $clave = $seguridad->limpiar_cadena($_POST["clave"]);
    $correo;
    $admin = new Administrador("", "", "", $correo, $clave);
    if ($admin->autenticar()) {
        $_SESSION["id"] = $admin->getId();
        $_SESSION["rol"] = "admin";
        header('Location: ?pid=' . base64_encode("presentacion/admin/sesionAdmin.php"));
    } else {
        $piloto = new Piloto("", "", "", $correo, $clave);
        if ($piloto->autenticar()) {
            $_SESSION["id"] = $piloto->getId();
            $_SESSION["rol"] = "piloto";
            header('Location: ?pid=' . base64_encode("presentacion/piloto/sesionPiloto.php"));
        } else {
            $pasajero = new Pasajero("", "", "", $correo, $clave);
            if ($pasajero->autenticar()) {
                $_SESSION["id"] = $pasajero->getId();
                $_SESSION["rol"] = "pasajero";
                header('Location: ?pid=' . base64_encode("presentacion/pasajero/sesionPasajero.php"));
            } else {
                $error = 1;
            }
        }

    }
}

?>

<body class="bg-warning-subtle">
    <div class="container my-5 bg-warning-subtle p-5">
        <div class="row">
            <div class="col-sm-4 col-md-5 col-lg-6">
                <div class="my-5 text-center fw-bold mx-2">
                    BIENVENIDO A ....
                </div>
                <div class="my-5 text-center mx-2">
                    LOGO
                </div>
            </div>
            <div class="col-sm-8 col-md-7 col-lg-6">
                <div class="card shadow-lg rounded-4 m-2 border border-danger-subtle">
                    <div class="card-head rounded-top-4 p-3 bg-warning text-center">
                        hola
                    </div>
                    <div class="card-body">
                        <form action="?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>" method="post">
                            <div class="my-3 ">
                                <label class="form-label">Correo: </label>
                                <input type="email" class="form-control border border-danger-subtle"
                                    aria-describedby="emailHelp" placeholder="Example:Juan21@example.com" name="correo">
                            </div>
                            <div class="my-3">
                                <label class="form-label">Contraseña: </label>
                                <input type="password" class="form-control border border-danger-subtle" name="clave">
                            </div>
                            <?php
                            ?>
                            <div class="text-ligth text-end">
                                <button type="submit" class="btn btn-warning" name="autenticar"> Iniciar Sesion </button>
                            </div>
                        </form>
                        <div class="text-center my-2">
                            <span>¿No tienes una cuenta? <a
                                    href="?pid=<?php echo base64_encode("presentacion/cliente/registrarCliente.php") ?>"
                                    class="text-decoration-none">Regístrate aquí</a></span>
                        </div>
                        <div class="text-center my-2">
                            <span>¿Quieres volver al inicio? <a
                                    href="?pid=<?php echo base64_encode("presentacion/inicio.php") ?>"
                                    class="text-decoration-none">Oprime aquí</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>