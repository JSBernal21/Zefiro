
<nav class="navbar navbar-expand-lg position-relative">
    <div class="w-100 h-100 position-absolute bg-primary"></div>
    <div class="w-100 h-100 position-absolute bg-danger opacity-50"></div>

    <div class="container position-relative">
        <a class="navbar-brand" href="?pid=<?php echo base64_encode('presentacion/inicio.php') ?>">
            <img src="img/logoLetras.png" alt="logo Zefiro" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link text-light"
                        href="?pid=<?php echo base64_encode('presentacion/inicio.php') ?>">Inicio</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-light" href="#">Destinos</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-light" href="#">Contacto y soporte</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <a class="btn btn-outline-primary text-white me-3"
                    href="?pid=<?php echo base64_encode("presentacion/pasajero/registroPasajero.php") ?>">
                    <i class="fa-solid fa-user-plus me-3"></i>Registrarse</a>
                <a class="btn btn-outline-primary text-white"
                    href="?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>">
                    <i class="fa-solid fa-user-check me-3"></i>Autenticarse</a>
            </ul>
        </div>
    </div>
</nav>