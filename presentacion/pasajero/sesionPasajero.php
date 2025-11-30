<?php

if ($_SESSION["rol"] != 'pasajero') {
    if ($_SESSION["id"] == null) {
        header("Location: ?pid=".base64_encode("presentacion/autenticar.php"));
    } else {
        header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    }
}
?>
<body>
<?php include 'presentacion/pasajero/menuPasajero.php'; ?>
</body>