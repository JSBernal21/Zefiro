<?php 
require ("logica/Ciudad.php");
$busqueda = $_GET["busqueda"];
$ciudad = new Ciudad();
$ciudades = $ciudad -> buscar($busqueda);
if(count($ciudades) > 0){
    foreach($ciudades as $cd){
        echo "<p>" . str_ireplace($busqueda, "<strong>" . substr($cd -> getNombre(), stripos($cd -> getNombre(), $busqueda), strlen($busqueda)) . "</strong>", $cd -> getNombre()) . "</p>";
        echo "<p>" . str_ireplace($busqueda, "<strong>" . substr($cd -> getPais(), stripos($cd -> getPais(), $busqueda), strlen($busqueda)) . "</strong>", $cd -> getPais()) . "</p>";
    }
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay coincidencias</div>";
}
?>