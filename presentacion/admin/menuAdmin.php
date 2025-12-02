<?php 
$admin=new Administrador($_SESSION["id"]);
$admin->consultarPorId();
?>
<nav class="navbar navbar-expand-lg position-relative">
    <div class="w-100 h-100 position-absolute bg-primary"></div>
    <div class="w-100 h-100 position-absolute bg-danger opacity-50"></div>

    <div class="container position-relative">
        <a class="navbar-brand"  href="?pid=<?php echo base64_encode('presentacion/inicio.php') ?>">
            <img src="img/logoLetras.png" alt="logo Zefiro" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-end">
                <li class="nav-item "><a class="nav-link active" href="?pid=<?php echo base64_encode("presentacion/admin/sesionAdmin.php")?>">Inicio</a></li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Pilotos</a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/piloto/registrarPiloto.php")?>">Registrar Piloto</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/piloto/consultarPilotos.php")?>">Consultar Pilotos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Aviones</a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/aviones/registrarAviones.php")?>">Registrar Aviones</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/aviones/consultarAviones.php")?>">Consultar Aviones</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Rutas</a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/registrar/registrarPartido.php")?>">Registrar Nueva Cuidad</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/consultar/consultarPartido.php")?>">Lista de Rutas</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Vuelos</a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/registrar/registrarPartido.php")?>">Registrar Vuelo</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/consultar/consultarPartido.php")?>">Consultar Vuelos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">Ciudades</a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/ciudad/registrarCiudades.php")?>">Registrar Ciudad</a></li>
                        <li><a class="dropdown-item" href="?pid=<?php echo base64_encode("presentacion/consultar/consultarCiudades.php")?>">Consultar Ciudades</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i
                            class="fa-solid fa-user-circle me-2"></i>Administrador:
                        <?php echo $admin->getNombre() . " " . $admin->getApellido() ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-pen me-2"></i> Editar
                                Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="?salir=true"> <i
                                    class="fa-solid fa-right-from-bracket me-2"></i> Salir
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>