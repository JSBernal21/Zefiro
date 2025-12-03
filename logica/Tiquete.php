<?php
require_once ("persistencia/TiqueteDAO.php");
require_once ("persistencia/Conexion.php");
class Tiquete{
    private $id;
    private $precio;
    private $reserva;
    private $asiento;
    private $paises;
    private $ciudades;
    private $cantidadVuelos;
    private $cantidadVuelosCiudades;
    public function __construct($id="", $precio="", $reserva="", $asiento="", $paises="", $cantidadVuelos="", $ciudades="", $cantidadVuelosCiudades=""){
        $this->id=$id;
        $this -> precio= $precio;
        $this -> reserva= $reserva;
        $this -> asiento= $asiento;
        $this -> paises = $paises;
        $this -> ciudades = $ciudades;
        $this -> cantidadVuelos = $cantidadVuelos;
        $this -> cantidadVuelosCiudades = $cantidadVuelosCiudades;
    }
    public function graficaPaisesVisitados($idPasajero){
        $conexion = new Conexion();
        $tiqueteDAO = new TiqueteDAO();        
        $conexion->abrir();
        $conexion -> ejecutar($tiqueteDAO -> graficaPaisesVisitados($idPasajero));
        $tiquetes = array();
        while (($tupla = $conexion->registro()) != null) {
            $tiquete = new Tiquete("", "", "", "", $tupla[0], $tupla[1]);
            array_push($tiquetes, $tiquete);
        }
        $conexion->cerrar();
        return $tiquetes;
    }
    public function graficaCiudadesVisitadas($idPasajero){
        $tiqueteDAO = new TiqueteDAO();
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion -> ejecutar($tiqueteDAO -> graficaCiudadesVisitadas($idPasajero));
        $tiquetes = array();

        while (($tupla = $conexion->registro()) != null) {
            // DEVOLVEMOS ciudad + pais + cantidad
            $tiquete = new Tiquete("", "", "", "", $tupla[1], "", $tupla[0], $tupla[2]);
            array_push($tiquetes, $tiquete);
        }
        $conexion->cerrar();
        return $tiquetes;
    }

    public function getPaises(){
        return $this->paises;
    }
    public function getCantidadVuelos(){
        return $this->cantidadVuelos;
    }
    public function getCiudades(){
        return $this->ciudades;
    }
    public function getCantidadVuelosCiudades(){
        return $this->cantidadVuelosCiudades;
    }


}