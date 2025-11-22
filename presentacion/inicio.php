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

        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                <a class="nav-link text-light" href="?pid=<?php echo base64_encode('presentacion/inicio.php') ?>">Inicio</a>
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
                href="?pid=<?php echo base64_encode("presentacion/pasajero/registroCliente.php")?>">
                <i class="fa-solid fa-user-plus me-3"></i>Registrarse</a>
                <a class="btn btn-outline-primary text-white" 
                href="?pid=<?php echo base64_encode("presentacion/autenticar.php")?>">
                <i class="fa-solid fa-user-check me-3"></i>Autenticarse</a>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid bg-primary bg-opacity-25">
    <form class="d-flex py-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
</div>

<div class="container mx-2 mx-md-5 py-3">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-50">
            <h5 class="m-0">¡Se parte de la familia Zefiro!</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-0 text-center py-5">
                    <p>Prepara todo para tu viaje y registrate en nuestra pagina para comprar tus tiketes de manera facil y rapida.
                        <br>¡No esperes más!<br><br>
                        <a class="btn text-white" style="background-color: #6f42c1;"
                        href="?pid=<?php echo base64_encode("presentacion/pasajero/registroCliente.php")?>">
                        <i class="fa-regular fa-address-card me-2"></i>Registrarte Ahora</a>
                    </p>
                </div>

                <div class="col-12 col-md-6">
                    <img src="img/patoRegistrate.png" alt="Imagen de registro" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-2 mx-md-5 py-3">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-50">
            <h5 class="m-0">Conoce los vuelos mas economicos</h5>
        </div>
        <div class="card-body">
            <h3>En desarrollo ...</h3>
        </div>
    </div>
</div>

<div class="container mx-2 mx-md-5 py-3">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-50">
            <h5 class="m-0">¿No sabes a donde ir de vacaciones? Estos son los lugares mas populares</h5>
        </div>
        <div class="card-body">
            <h3>En desarrollo ...</h3>
        </div>
    </div>
</div>



