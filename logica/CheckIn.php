<?php
require_once ("persistencia/CheckInDAO.php");
require_once ("persistencia/Conexion.php");
class CheckIn{
    private $pasajero;
    private $vuelo;
    private $cantidadPersonas;
    private $precioPorPersona;
    private $total;
    private $calificacionTripulacion;
    private $calificacionAvion;
    private $paises;
    private $ciudades;
    private $cantidadVuelos;
    private $cantidadVuelosCiudades;
    public function __construct($pasajero="", $vuelo="", $cantidadPersonas="", $precioPorPersona="", $total="", $calificacionTripulacion="", $calificacionAvion="", $paises="", $cantidadVuelos="", $ciudades="", $cantidadVuelosCiudades=""){
        $this->pasajero=$pasajero;
        $this -> vuelo= $vuelo;
        $this -> cantidadPersonas= $cantidadPersonas;
        $this -> precioPorPersona = $precioPorPersona;
        $this -> total = $total;
        $this -> calificacionTripulacion = $calificacionTripulacion;
        $this -> calificacionAvion = $calificacionAvion;
        $this -> paises = $paises;
        $this -> cantidadVuelos = $cantidadVuelos;
        $this -> ciudades = $ciudades;
        $this -> cantidadVuelosCiudades = $cantidadVuelosCiudades;
    }
    public function graficaPaisesVisitados($idPasajero){
        $conexion = new Conexion();
        $checkInDAO = new CheckInDAO();
        $conexion->abrir();
        $conexion->ejecutar($checkInDAO->graficaPaisesVisitados($idPasajero));
        $resultados = array();
        while (($tupla = $conexion->registro())!= null){
            $resultado = new CheckIn("", "", "", "", "", "", "", $tupla[0], $tupla[1]);
            array_push($resultados, $resultado);
        }
        $conexion->cerrar();
        return $resultados;
    }
    public function graficaCiudadesVisitadas($idPasajero){
        $conexion = new Conexion();
        $checkInDAO = new CheckInDAO();
        $conexion->abrir();
        $conexion->ejecutar($checkInDAO->graficaCiudadesVisitadas($idPasajero));
        $resultados = array();
        while (($tupla = $conexion->registro())!= null){
            $resultado = new CheckIn("", "", "", "", "", "", "", $tupla[1], "", $tupla[0], $tupla[2]);
            array_push($resultados, $resultado);
        }
        $conexion->cerrar();
        return $resultados;
    }

    public function getNombre(){
        return $this->paises;
    }
    public function getCantidadVuelos(){
        return $this->cantidadVuelos;
    }
    public function getPaises(){
        return $this->paises;
    }
    public function getCiudades(){
        return $this->ciudades;
    }
    public function getCantidadVuelosCiudades(){
        return $this->cantidadVuelosCiudades;
    }
}
?>