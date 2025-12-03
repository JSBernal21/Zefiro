<?php
require_once ("persistencia/Conexion.php");
require_once ("persistencia/VueloDAO.php");
require_once("logica/Persona.php");
require_once("logica/Piloto.php");
require_once("logica/Avion.php");
require_once("logica/Ruta.php");
require_once("logica/Asiento.php");
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
    public function consultarPorId(){
        $conexion = new Conexion();
        $vueloDAO = new VueloDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($vueloDAO->consultarPorId());
        $tupla = $conexion -> registro();
        $this->precioAsiento = new Asiento($tupla[1]);
        $this->precioAsiento->consultarPorId();
        $this->fechaHoraLlegada = $tupla[2];
        $this->fechaHoraSalida = $tupla[3];
        $this->ruta = new Ruta($tupla[4]);
        $this->ruta->consultarPorId();
        $this->avion = new Avion($tupla[5]);
        $this->avion->consultarPorId();
        $this->copiloto = new Piloto($tupla[6]);
        $this->copiloto->consultarPorId();
        $this->piloto = new Piloto($tupla[7]);
        $this->piloto->consultarPorId();
        $this->estado = $tupla[8];
        $conexion->cerrar();
    }
    public function consultarDisponiblesPasajero($origen, $destino, $fechaIda="", $fechaVuelta=""){
        $conexion = new Conexion();
        $conexion -> abrir();
        $vueloDAO = new VueloDAO();        
        $conexion -> ejecutar($vueloDAO -> consultarDisponiblesPasajero($origen, $destino, $fechaIda, $fechaVuelta));
        $vuelos = array();
        while (($datos = $conexion->registro()) != null) {
            $piloto = new Piloto($datos[8]);
            $piloto->consultarPorId();
            $copiloto = new Piloto($datos[7]);
            $copiloto->consultarPorId();
            $avion = new Avion($datos[6]);
            $avion->consultarPorId();
            $ruta = new Ruta($datos[5]);
            $ruta->consultarPorId();
            $asiento = new Asiento($datos[1]);
            $asiento->consultarPorId();
            $vuelo = new Vuelo($datos[0], $asiento, $datos[3], $datos[4], $ruta, $avion, $copiloto, $piloto, $datos[9]);
            array_push($vuelos, $vuelo);
        }
        $conexion->cerrar();
        return $vuelos;
    }
    public function consultarDisponiblesPorFecha($origen, $destino, $fecha){
        $conexion = new Conexion();
        $conexion->abrir();
        $vueloDAO = new VueloDAO();
        $conexion->ejecutar($vueloDAO->consultarDisponiblesPorFecha($origen, $destino, $fecha));
        $vuelos = array();
        while(($datos = $conexion->registro()) != null){
            $piloto = new Piloto($datos[6]); 
            $piloto->consultarPorId();
            $copiloto = new Piloto($datos[5]); 
            $copiloto->consultarPorId();
            $avion = new Avion($datos[4]); 
            $avion->consultarPorId();
            $ruta = new Ruta($datos[3]); 
            $ruta->consultarPorId();
            $vuelo = new Vuelo($datos[0], "", $datos[1], $datos[2], $ruta, $avion, $copiloto, $piloto, $datos[7]);
            array_push($vuelos, $vuelo);
        }
        $conexion->cerrar();
        return $vuelos;
    }

    public function consultarDisponiblesVuelta($origen, $destino, $fecha){
        $conexion = new Conexion();
        $conexion->abrir();
        $vueloDAO = new VueloDAO();
        $conexion->ejecutar($vueloDAO->consultarDisponiblesVuelta($origen, $destino, $fecha));
        $vuelos = array();
        while(($datos = $conexion->registro()) != null){
            $piloto = new Piloto($datos[6]); 
            $piloto->consultarPorId();
            $copiloto = new Piloto($datos[5]); 
            $copiloto->consultarPorId();
            $avion = new Avion($datos[4]); 
            $avion->consultarPorId();
            $ruta = new Ruta($datos[3]); 
            $ruta->consultarPorId();
            $vuelo = new Vuelo($datos[0], "", $datos[1], $datos[2], $ruta, $avion, $copiloto, $piloto, $datos[7]);
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