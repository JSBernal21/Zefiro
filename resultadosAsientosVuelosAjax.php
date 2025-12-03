<?php 
require_once("logica/Asiento.php");

$idVuelo = $_GET["idVuelo"];

$asiento = new Asiento();
$asientos = $asiento -> consultarPorVuelo($idVuelo);

$grupos = [];

foreach($asientos as $a){
    $precio = $a->getPrecio();
    if(!isset($grupos[$precio])){
        $grupos[$precio] = [
            "precio" => $precio,
            "cantidad" => 0,
            "asientos" => []
        ];
    }
    $grupos[$precio]["cantidad"]++;
    $grupos[$precio]["asientos"][] = $a->getId();
}

if(count($asientos) > 0){
    foreach($grupos as $g){

        echo "
        <div class='card border-0 shadow-sm rounded-4 mb-3'>
            <div class='card-body'>
            
                <h4 class='fw-bold mb-1'>COP ".number_format($g['precio'],0,',','.')."</h4>
                <p class='text-muted mb-2'>Asientos disponibles: ".$g['cantidad']."</p>

                <div class='row'>
                    <div class='col-md-3'>
                        <label class='form-label mb-0'>Cantidad a comprar</label>
                        <div class='input-group'>
                            <i class='fa-solid fa-user-plus input-group-text'></i>
                            <input type='number' min='1' max='".$g['cantidad']."' 
                                class='form-control cantidad-asiento' 
                                data-precio='".$g['precio']."'
                                placeholder='Cant'>
                        </div>
                    </div>
                </div>

                <button class='btn text-white mt-3 btn-agregar-asiento' 
                        style='background-color:#a078eb;' 
                        data-precio='".$g['precio']."'>
                        Agregar
                </button>
            
            </div>
        </div>
        ";
    }
    
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No se encontraron vuelos con esas características</div>";
}
?>
