<?php
require_once (__DIR__."/../persistencia/Conexion.php");
require_once (__DIR__."/../persistencia/AvionDAO.php");
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
    public function registrar()
    {
        $conexion = new Conexion();
        $avionDAO = new AvionDAO("", $this->nombre, $this->capacidad, $this->ubicacionActual);
        $conexion->abrir();
        $conexion->ejecutar($avionDAO->registrar());
        $conexion->cerrar();
    }
    public function consultar(){
        $conexion = new Conexion();
        $avionDAO = new AvionDAO();
        $conexion -> abrir();
        $conexion -> ejecutar($avionDAO -> consultar());
        $aviones = array();
        while (($datos = $conexion->registro()) != null) {
            $ciudad = new Ciudad($datos[3]);
            $ciudad->consultarPorId();
            $avion = new Avion($datos[0], $datos[1], $datos[2], $ciudad);
            array_push($aviones, $avion);
        }
        $conexion->cerrar();
        return $aviones;
    }
    public function actualizar(){
        $conexion = new Conexion();
        $avionDAO = new AvionDAO($this->id, $this->nombre, $this->capacidad, $this->ubicacionActual);
        $conexion->abrir();
        $conexion->ejecutar($avionDAO->actualizar());
        $conexion->cerrar();
    }
    public function consultarAvionPorCiudad($ciudadOrigenId)
    {
        $conexion = new Conexion();
        $avionDAO = new AvionDAO();
        $conexion->abrir();
        $conexion->ejecutar($avionDAO->consultarAvionPorCiudad($ciudadOrigenId));
        $aviones = array();
        while (($tupla = $conexion->registro())!= null) {
            $Ciudad=new Ciudad($tupla[3]);
            $Ciudad->consultarPorId();
            $avion = new Avion($tupla[0], $tupla[1], $tupla[2], $Ciudad);
            array_push($aviones, $avion);
        }
        $conexion->cerrar();
        return $aviones;
    }
}