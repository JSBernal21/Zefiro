<div class="text-center">
    <h1> ====================================== </h1>
    <h1> ||  ¡Upss!  USUARIO NO AUTORIZADO CERRANDO SESION    || </h1>
    <h1> ====================================== </h1>
    <?php session_destroy();?>
    <div class="container d-flex flex-column justify-content-center align-items-center text-center py-4">
        <div class="col-12 col-md-8 col-lg-5">
            <img src="img/patoNoAutorizado.png" class="img-fluid mx-auto d-block" alt="no autorizado">
        </div>
    </div>
    <a href="?pid=<?php echo base64_encode("presentacion/inicio.php")?>" class="btn text-white" style="background-color:#a078eb;"> VOLVER AL INICIO </a>

</div>