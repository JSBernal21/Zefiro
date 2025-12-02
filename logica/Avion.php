<?php
require_once ("persistencia/Conexion.php");
require_once ("persistencia/AvionDAO.php");
class Avion{
    private $id;
    private $nombre;
    private $capacidad;
    private $ubicacionActual;
    public function __construct($id="", $nombre="", $capacidad="",$ubicacionActual=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> capacidad= $capacidad;
        $this -> ubicacionActual = $ubicacionActual;
    }

    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getCapacidad(){
        return $this->capacidad;
    }
    public function getUbicacionActual(){
        return $this->ubicacionActual;
    }
    public function consultarPorId(){
        $conexion = new Conexion();
        $avionDAO = new AvionDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($avionDAO->consultarPorId());
        $tupla = $conexion -> registro();
        $this->nombre = $tupla[1];
        $this->capacidad = $tupla[2];
        $this->ubicacionActual = new Ciudad($tupla[3]);
        $this->ubicacionActual->consultarPorId();
        $conexion->cerrar();
    }
}