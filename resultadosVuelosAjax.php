<?php 
require_once("logica/Vuelo.php");
require_once("logica/Ruta.php");
require_once("logica/Ciudad.php");

$origen = $_GET["origen"];
$destino = $_GET["destino"];
$fechaIda = $_GET["fechaIda"];
$fechaVuelta = $_GET["fechaVuelta"];
$tipoViaje = $_GET["tipoViaje"];

$vuelo = new Vuelo();
$vuelosIda = $vuelo -> consultarDisponiblesPorFecha($origen, $destino, $fechaIda);
$vuelosVuelta = [];
if($tipoViaje === "idaVuelta"){
    $vuelosVuelta = $vuelo->consultarDisponiblesVuelta($origen, $destino, $fechaVuelta);
}

if(count($vuelosIda) === 0){
    echo "<div class='alert alert-danger mt-3' role='alert'>No se encontraron vuelos disponibles de Ida con esas caracteristicas</div>";
}

if(count($vuelosIda) > 0 || count($vuelosVuelta) > 0){
    echo "<h3 class='mb-4'>Vuelos de Ida</h3>";
    foreach($vuelosIda as $v){
        //$intervalo = $v->getFechaHoraSalida()->diff($v->getFechaHoraLlegada());
        //$duracion = $intervalo->h . "h " . $intervalo->i . "m";
        echo "
        <div class='card border-0 shadow-sm rounded-4'>
            <div class='row g-0'>

                <!-- Sección izquierda -->
                <div class='col-md-9 p-4'>

                    <div class='row text-center align-items-center'>

                        <!-- Hora salida -->
                        <div class='col-3'>
                            <h3 class='fw-bold mb-0'>". $v -> getFechaHoraSalida() . "</h3>
                            <small class='text-muted'>" . $v -> getRuta() -> getOrigen() ->getNombre() ."</small>
                        </div>

                        <!-- Línea central + info -->
                        <div class='col-6'>

                            <div class='d-flex justify-content-center align-items-center mb-1'>
                                <span class='me-2'>Nombre del Avion: " . $v -> getAvion() ->getNombre() . "</span>
                                <span class='text-muted'>|</span>
                                <span class='ms-2'>" . /*$duracion . */"</span>
                            </div>

                            <div class='d-flex align-items-center'>
                                <div class='flex-grow-1 border-top border-dashed'></div>
                                <i class='fa-solid fa-plane'></i>
                                <div class='flex-grow-1 border-top border-dashed'></div>
                            </div>

                            <div class='mt-3'>
                                    Piloto: <strong>" . $v->getPiloto() -> getNombre() . " " . $v->getPiloto() -> getApellido() ."</strong><br>
                                    Copiloto: <strong>" . $v->getCopiloto() -> getNombre() . " " . $v->getCopiloto() -> getApellido() ."</strong>
                            </div>
                        </div>

                        <div class='col-3'>
                            <h3 class='fw-bold mb-0'> " . $v->getFechaHoraLlegada() . "</h3>
                            <small class='text-muted'>" . $v-> getRuta() -> getDestino() ->getNombre(). "</small>
                        </div>

                    </div>
                </div>

                <div class='col-md-3 bg-light p-4 rounded-end-4 d-flex flex-column justify-content-center'>
                    <button class='btn text-white btn-asientos' style='background-color:#a078eb;' data-id='".$v->getId()."'>Seleccionar</button>
                </div>

            </div>
        </div>";
    }
    
    echo "<h3 class='mb-4'>Vuelos de Vuelta</h3>";
if($tipoViaje === "idaVuelta" && count($vuelosVuelta) === 0){
    echo "<div class='alert alert-danger mt-3' role='alert'>No se encontraron vuelos de vuelta con esas características</div>";
}
    
    foreach($vuelosVuelta as $v){
        //$intervalo = $v->getFechaHoraSalida()->diff($v->getFechaHoraLlegada());
        //$duracion = $intervalo->h . "h " . $intervalo->i . "m";
        echo "
        <div class='card border-0 shadow-sm rounded-4'>
            <div class='row g-0'>

                <!-- Sección izquierda -->
                <div class='col-md-9 p-4'>

                    <div class='row text-center align-items-center'>

                        <!-- Hora salida -->
                        <div class='col-3'>
                            <h3 class='fw-bold mb-0'>". $v -> getFechaHoraSalida() . "</h3>
                            <small class='text-muted'>" . $v -> getRuta() -> getOrigen() ->getNombre() ."</small>
                        </div>

                        <!-- Línea central + info -->
                        <div class='col-6'>

                            <div class='d-flex justify-content-center align-items-center mb-1'>
                                <span class='me-2'>Nombre del Avion: " . $v -> getAvion() ->getNombre() . "</span>
                                <span class='text-muted'>|</span>
                                <span class='ms-2'>" . /*$duracion . */"</span>
                            </div>

                            <div class='d-flex align-items-center'>
                                <div class='flex-grow-1 border-top border-dashed'></div>
                                <i class='fa-solid fa-plane'></i>
                                <div class='flex-grow-1 border-top border-dashed'></div>
                            </div>

                            <div class='mt-3'>
                                    Piloto: <strong>" . $v->getPiloto() -> getNombre() . " " . $v->getPiloto() -> getApellido() ."</strong><br>
                                    Copiloto: <strong>" . $v->getCopiloto() -> getNombre() . " " . $v->getCopiloto() -> getApellido() ."</strong>
                            </div>
                        </div>

                        <div class='col-3'>
                            <h3 class='fw-bold mb-0'> " . $v->getFechaHoraLlegada() . "</h3>
                            <small class='text-muted'>" . $v-> getRuta() -> getDestino() ->getNombre(). "</small>
                        </div>

                    </div>
                </div>

                <div class='col-md-3 bg-light p-4 rounded-end-4 d-flex flex-column justify-content-center'>
                    <button class='btn text-white btn-asientos' style='background-color:#a078eb;' data-id='".$v->getId()."' >Seleccionar</button>
                </div>

            </div>
        </div>";
    }
    echo "<div id='asientosDisponibles'></div>";
}
?>
