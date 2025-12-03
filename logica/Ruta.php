<?php
require_once (__DIR__."/../persistencia/Conexion.php");
require_once (__DIR__."/../persistencia/RutaDAO.php");

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
    public function registrar()
    {
        $conexion = new Conexion();
        $rutaDAO = new RutaDAO("", $this->descripcion, $this->origen, $this->destino);
        $conexion->abrir();
        $conexion->ejecutar($rutaDAO->registrar());
        $conexion->cerrar();
    }
    public function consultar(){
        $conexion = new Conexion();
        $rutaDAO = new RutaDAO();
        $conexion->abrir();
        $conexion->ejecutar($rutaDAO->consultar());
        $rutas = array();
        while (($registro = $conexion->registro()) != null) {
            $origen = new Ciudad($registro[2]);
            $origen->consultarPorId();
            $destino = new Ciudad($registro[3]);
            $destino->consultarPorId();
            $ruta = new Ruta($registro[0], $registro[1], $origen, $destino);
            array_push($rutas, $ruta);
        }
        $conexion->cerrar();
        return $rutas;
    }
    public function consultarRuta($filtro){
        $conexion = new Conexion();
        $rutaDAO = new RutaDAO();
        $conexion->abrir();
        $conexion->ejecutar($rutaDAO->consultarRuta($filtro));
        $rutas = array();
        while (($registro = $conexion->registro()) != null) {
            $origen = new Ciudad($registro[2]);
            $origen->consultarPorId();
            $destino = new Ciudad($registro[3]);
            $destino->consultarPorId();
            $ruta = new Ruta($registro[0], $registro[1], $origen, $destino);
            array_push($rutas, $ruta);
        }
        $conexion->cerrar();
        return $rutas;
    }
    public function getId(){
        return $this->id;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getOrigen(){
        return $this->origen;
    }
    public function getDestino(){
        return $this->destino;
    }

}
?>