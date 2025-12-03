<?php 
require_once(__DIR__."/../persistencia/Conexion.php");
require_once(__DIR__."/../persistencia/AsientoDAO.php");
require_once(__DIR__."/Vuelo.php");
class Asiento{
    private $id;
    private $precio;
    private $vuelo;

    public function __construct($id="",$precio="", $vuelo=""){
        $this->id=$id;
        $this -> precio= $precio;
        $this -> vuelo= $vuelo;
    }

    public function consultar(){
        $conexion = new Conexion();
        $asientoDAO = new AsientoDAO();
        $conexion->abrir();
        $conexion->ejecutar($asientoDAO->consultar());
        $asientos = array();
        while (($tupla = $conexion->registro())!= null){
            $asiento = new Asiento($tupla[0], $tupla[1], $tupla[2]);
            array_push($asientos, $asiento);
        }
        $conexion->cerrar();
        return $asientos;
    }

    public function consultarPorId(){
        $conexion = new Conexion();
        $asientoDAO = new AsientoDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($asientoDAO->consultarPorId());
        $tupla = $conexion->registro();
        $this->precio = $tupla[1];
        $this->vuelo = $tupla[2];
        $conexion->cerrar();
    }

    public function consultarPorVuelo($idVuelo){
        $conexion = new Conexion();
        $asientoDAO = new AsientoDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($asientoDAO->consultarPorVuelo($idVuelo));
        $asientos = array();
        while (($tupla = $conexion->registro()) != null) {
            $asiento = new Asiento($tupla[0], $tupla[1], $tupla[2]);
           array_push($asientos, $asiento);
        }
        $conexion->cerrar();
        return $asientos;
    }



    public function getId(){
        return $this->id;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getVuelo(){
        return $this->vuelo;
    }

}
?>