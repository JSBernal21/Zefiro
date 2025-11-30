<?php 
if (isset($_SESSION["id"])) {
    if ($_SESSION["rol"] == "admin") {
        include("presentacion/admin/menuAdmin.php");
    } else {
        if ($_SESSION["rol"] == "pasajero") {
            include("presentacion/pasajero/menuPasajero.php");
        } 
    }
} else {
    include("presentacion/menuSinSesion.php");
}

?>

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



