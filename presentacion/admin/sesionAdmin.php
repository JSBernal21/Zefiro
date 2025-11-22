<?php 
if ($_SESSION["rol"] != 'admin') {
    echo "entro a rol diferente ";
    if ($_SESSION["id"] == null) {
        header("Location: ?pid=".base64_encode("presentacion/autenticar.php"));
    } else {
        echo "entro a la redireccion";
        header("location: ?pid=" . base64_encode("presentacion/noAutorizado.php"));
    }
}else{

echo $_SESSION["rol"] != 'admin';
?>
<h1>ADMIN</h1><?php
}?>