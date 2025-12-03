<?php
$id = $_SESSION["id"];
if ($_SESSION["rol"] != "pasajero") {
    header('Location: ?pid=' . base64_encode("noAutorizado.php"));
}
$pasajero = new Pasajero($id);
$pasajero->consultarPorId();

$tiquete = new CheckIn();
$tiquetes = $tiquete -> graficaPaisesVisitados($id);

$tiquetesCiudades = $tiquete -> graficaCiudadesVisitadas($id);

include ("presentacion/pasajero/menuPasajero.php");
?>

<div class="container mx-2 mx-md-5 py-3">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-50 text-center">
            <h3 class="m-0"><i class="fa-solid fa-globe me-3"></i>Paises a los que he viajado</h3>
        </div>
        <div class="card-body">
            <div id="barrasPaises" style="width: 800px; height: 600px;"></div>
        </div>
    </div>
</div>


<div class="container mx-2 mx-md-5 py-3">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-50 text-center">
            <h3 class="m-0"><i class="fa-solid fa-map-location me-3"></i>Resumen viajes</h3>
        </div>
        <div class="card-body">
            <div id="arbolCiudades" style="width: 900px; height: 500px;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //La grafica de Barras
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Pais', 'Vuelos'],
            <?php 
            foreach ($tiquetes as $t){
            echo "['" . $t->getPaises() . "', " . $t->getCantidadVuelos() . "],\n";
            }
            ?>
    ]);

    var options = {
        width: 800,
        legend: { position: 'none' },
        chart: {
        title: 'Paises visitados',
        subtitle: '' },
        axes: {
        x: {
            0: { side: 'top', label: 'Paises'}
        }
        },
        bar: { groupWidth: "50%" }
    };

    var chart = new google.charts.Bar(document.getElementById('barrasPaises'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
    };

    //La grafica de arbol - Ciudades
    google.charts.load('current', {'packages':['treemap']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Location', 'Parent', 'Tamano', 'Color'],
        ['Pais',    null,      0,     null],
        <?php 
        foreach ($tiquetes as $t){
            echo "['" . $t->getPaises() . "', 'Pais', " . $t->getCantidadVuelos() . "," . $t->getCantidadVuelos() . "],\n";
            foreach ($tiquetesCiudades as $tc){
                if ($tc->getPaises() == $t->getPaises()) {
                    echo "['" . $tc->getCiudades() . "', '" . $t->getPaises() . "', " . $tc->getCantidadVuelosCiudades() . ", " . $tc->getCantidadVuelosCiudades() ."],\n";
                }
            }
        }      
        ?>
    ]);

    tree = new google.visualization.TreeMap(document.getElementById('arbolCiudades'));

    tree.draw(data, {
        minColor: '#8b21fc',
        midColor: '#c7a0ff',
        maxColor: '#4a0027',
        showScale: true
    });

    }


    //La grafica de arbol - General

</script>