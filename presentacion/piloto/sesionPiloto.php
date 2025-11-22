<?php 
if ($_SESSION["rol"] != 'piloto') {
    if ($_SESSION["id"] == null) {
        header("Location: ?pid=".base64_encode("presentacion/autenticar.php"));
    } else {
        header("Location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    }
}

?>

<h1>PILOTO</h1>