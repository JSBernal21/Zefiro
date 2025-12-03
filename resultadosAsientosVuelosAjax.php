<?php 
require_once("logica/Asiento.php");
require_once("logica/Vuelo.php");

$idVuelo = isset($_GET["idVuelo"]) ? intval($_GET["idVuelo"]) : 0;
if($idVuelo <= 0){
    echo "<div class='alert alert-danger'>Id de vuelo inválido.</div>";
    exit;
}

$vuelo = new Vuelo();
$vuelosIda = $vuelo -> consultarDisponiblesPasajero($origen, $destino, $fechaIda);
?>
<div class="row g-3">

<?php foreach($vuelo as $a): ?>

    <div class="col-6 col-md-4 col-lg-3">
        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body text-center">
                <h5 class="fw-bold mb-1">COP <?= number_format($a -> getPrecio(),0,",",".") ?></h5>
                <p class="text-muted mb-2">Disponibles: <?= $g -> getPrecio() ?></p>

                <label class="form-label small">Seleccionar cantidad</label>
                <input type="number" 
                    min="0" 
                    data-precio="<?= $a -> getPrecio() ?>"
                    class="form-control text-center seleccionar-asiento">
            </div>

        </div>
    </div>

<?php endforeach; ?>
</div>

<div class="text-center mt-4">
    <button id="btnReservar" class="btn btn-success px-5 py-2 fw-bold">
        Reservar
    </button>
</div>

