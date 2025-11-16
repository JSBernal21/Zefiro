<body class="text-center">
    <h1> =================================== </h1>
    <h1> ||    USUARIO NO AUTORIZADO CERRANDO SESION    || </h1>
    <h1> =================================== </h1>
    <?php session_destroy();?>
    <a href="?pid=<?php echo base64_encode("presentacion/inicio.php")?>" class="text-decoration-none"> VOLVER AL INICIO </a>
</body>