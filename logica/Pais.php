<?php 
require_once(__DIR__."/../persistencia/Conexion.php");
require_once(__DIR__."/../persistencia/PaisDAO.php");
class Pais{
    private $id;
    private $nombre;
    private $cantidadVuelos;
    public function __construct($id="",$nombre="", $cantidadVuelos=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> cantidadVuelos= $cantidadVuelos;
    }

    public function consultar(){
        $paisDAO = new PaisDAO();
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($paisDAO->consultar());
        $paises = array();
        while (($registro = $conexion->registro())!= null){
            $pais = new Pais($registro[0], $registro[1]);
            array_push($paises, $pais);
        }
        $conexion->cerrar();
        return $paises;
    }
    public function consultarPorId(){
        $conexion = new Conexion();
        $paisDAO = new PaisDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($paisDAO->consultarPorId());
        $tupla = $conexion->registro();
        $this->nombre = $tupla[0];
        $conexion->cerrar();
    }
    public function consultarVuelosPorPais(){
        $conexion = new Conexion();
        $paisDAO = new PaisDAO();       
        $conexion->abrir();
        $conexion->ejecutar($paisDAO->consultarVuelosPorPais());
        $resultados = array();
        while (($registro = $conexion->registro())!= null){
            $resultado = new Pais("", $registro[0], $registro[1]);
            array_push($resultados, $resultado);
        }
        $conexion->cerrar();
        return $resultados;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getCantidadVuelos(){
        return $this->cantidadVuelos;
    }

}