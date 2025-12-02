<?php 
require ("logica/Ciudad.php");
$busqueda = $_GET["busqueda"];
$ciudad = new Ciudad();
$ciudades = $ciudad -> buscar($busqueda);
if(count($ciudades) > 0){
    foreach($ciudades as $cd){
        $nombre = $cd->getNombre();
        $pais = $cd->getPais();
        echo " <button type='button' 
                class='list-group-item list-group-item-action ciudad-item'
                data-nombre='$nombre'>
            <div class='d-flex justify-content-between'>
                <strong>$nombre</strong>
            </div>
            <small class='text-muted'>$pais</small>
        </button>";
    }
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay coincidencias</div>";
}
?>