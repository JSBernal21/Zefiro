<?php
class CheckInDAO{
    private $pasajero;
    private $vuelo;
    private $cantidadPersonas;
    private $precioPorPersona;
    private $total;
    private $calificacionTripulacion;
    private $calificacionAvion;
    public function __construct($pasajero="", $vuelo="", $cantidadPersonas="", $precioPorPersona="", $total="", $calificacionTripulacion="", $calificacionAvion=""){
        $this->pasajero=$pasajero;
        $this -> vuelo= $vuelo;
        $this -> cantidadPersonas= $cantidadPersonas;
        $this -> precioPorPersona = $precioPorPersona;
        $this -> total = $total;
        $this -> calificacionTripulacion = $calificacionTripulacion;
        $this -> calificacionAvion = $calificacionAvion;
    }
    public function consultar(){
        return "select P3Pasajero_idPasajero, P3Vuelo_idVuelo, cantPersonas, precioPorPersona, total, calTripulacion, calAvion
            from P3Check-In";
    }
    public function graficaPaisesVisitados($idPasajero){
        return "select p.nombre, count(v.idVuelo) as cantidadVuelos
            from P3CheckIn ci
            join P3Vuelo v on ci.P3Vuelo_idVuelo = v.idVuelo
            join P3Ruta r on v.P3Ruta_idRuta = r.idRuta
            join P3Ciudad cd on r.P3CiudadDestino = cd.idCiudad
            join P3Pais p on cd.P3Pais_idPais = p.idPais
            where ci.P3Pasajero_idPasajero = " . $idPasajero . "
            group by p.nombre";
    }
    
}

?>