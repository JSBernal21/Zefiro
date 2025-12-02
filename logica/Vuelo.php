<?php
require_once ("persistencia/Conexion.php");
require_once ("persistencia/VueloDAO.php");
require_once("logica/Persona.php");
require_once("logica/Piloto.php");
require_once("logica/Avion.php");
require_once("logica/Ruta.php");
class Vuelo{
    private $id;
    private $precioAsiento;
    private $fechaHoraLlegada;
    private $fechaHoraSalida;
    private $ruta;
    private $avion;
    private $copiloto;
    private $piloto;
    private $estado;

    public function __construct($id="", $precioAsiento="", $fechaHoraLlegada="", $fechaHoraSalida="", $ruta="", $avion="", $copiloto="", $piloto="", $estado=""){
        $this->id = $id;
        $this->precioAsiento = $precioAsiento;
        $this->fechaHoraLlegada = $fechaHoraLlegada;
        $this->fechaHoraSalida = $fechaHoraSalida;
        $this->ruta = $ruta;
        $this->avion = $avion;
        $this->copiloto = $copiloto;
        $this->piloto = $piloto;
        $this->estado = $estado;
    }

    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrir();
        $vueloDAO = new VueloDAO();        
        $conexion -> ejecutar($vueloDAO -> consultar());
        $vuelos = array();
        while (($datos = $conexion->registro()) != null) {
            $vuelo = new Vuelo($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8]);
            array_push($vuelos, $vuelo);
        }
        $conexion->cerrar();
        return $vuelos;
    }   
    public function consultarDisponiblesPasajero($origen, $destino){
        $conexion = new Conexion();
        $conexion -> abrir();
        $vueloDAO = new VueloDAO();        
        $conexion -> ejecutar($vueloDAO -> consultarDisponiblesPasajero($origen, $destino));
        $vuelos = array();
        while (($datos = $conexion->registro()) != null) {
            $piloto = new Piloto($datos[7]);
            $piloto->consultarPorId();
            $copiloto = new Piloto($datos[6]);
            $copiloto->consultarPorId();
            $avion = new Avion($datos[5]);
            $avion->consultarPorId();
            $ruta = new Ruta($datos[4]);
            $ruta->consultarPorId();
            $vuelo = new Vuelo($datos[0], $datos[1], $datos[2], $datos[3], $ruta, $avion, $copiloto, $piloto, $datos[8]);
            array_push($vuelos, $vuelo);
        }
        $conexion->cerrar();
        return $vuelos;
    }

    public function getId(){
        return $this->id;
    }
    public function getPrecioAsiento(){
        return $this->precioAsiento;
    }
    public function getFechaHoraLlegada(){
        return $this->fechaHoraLlegada;
    }
    public function getFechaHoraSalida(){
        return $this->fechaHoraSalida;
    }
    public function getRuta(){
        return $this->ruta;
    }
    public function getAvion(){
        return $this->avion;
    }
    public function getCopiloto(){
        return $this->copiloto;
    }
    public function getPiloto(){
        return $this->piloto;
    }
    public function getEstado(){
        return $this->estado;
    }

    
}


?>