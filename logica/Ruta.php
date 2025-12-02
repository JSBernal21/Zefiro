<?php
require_once ("persistencia/Conexion.php");
require_once ("persistencia/RutaDAO.php");

class Ruta{
    private $id;
    private $descripcion;
    private $origen;
    private $destino;
    public function __construct($id="", $descripcion="", $origen="",$destino=""){
        $this->id=$id;
        $this -> descripcion= $descripcion;
        $this -> origen= $origen;
        $this -> destino = $destino;
    }
    public function consultarPorId(){
        $conexion = new Conexion();
        $rutaDAO = new RutaDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($rutaDAO->consultarPorId());
        $tupla = $conexion -> registro();
        $this->descripcion = $tupla[1];
        $this->origen = new Ciudad($tupla[2]);
        $this->origen->consultarPorId();
        $this->destino = new Ciudad($tupla[3]);
        $this->destino->consultarPorId();
        $conexion->cerrar();
    }

    public function getOrigen(){
        return $this->origen;
    }
    public function getDestino(){
        return $this->destino;
    }

}
?>