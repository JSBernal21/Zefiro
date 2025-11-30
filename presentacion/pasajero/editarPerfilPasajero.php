<nav class="navbar navbar-expand-lg position-relative text-white">
    <div class="w-100 h-100 position-absolute bg-primary"></div>
    <div class="w-100 h-100 position-absolute bg-danger opacity-50"></div>

    <div class="container position-relative">
        <a class="navbar-brand"  href="<?php echo base64_encode('presentacion/inicio.php') ?>">
            <img src="img/logoLetras.png" alt="logo Zefiro" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">             
                <li class="nav-item">
                <a class="nav-link" href="#">Mis reservas</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Historial de vuelos</a>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false"> Mis vuelos </a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item"
							href="">Mis reservas</a></li>
						<li><a class="dropdown-item"
							href="">Historial de vuelos</a></li>
						<li><a class="dropdown-item"
							href="">Check-in</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul></li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">    
                Opciones de perfil
            </ul>
        </div>
    </div>
</nav>



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
<?php
    echo ("editar Perfil = <a href='?pid=" . base64_encode("presentacion/pasajero/editarPerfilPasajero.php") . "'>AUTENTICAR</a>")
?>