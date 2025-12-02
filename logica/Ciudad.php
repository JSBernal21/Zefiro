<?php
require_once(__DIR__ . "/../persistencia/Conexion.php");
require_once(__DIR__ . "/../persistencia/CiudadDAO.php");
require_once(__DIR__ . "/../logica/Pais.php");
class Ciudad
{
    private $id;
    private $nombre;
    private $pais;
    public function __construct($id = "", $nombre = "", $pais = "")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pais = $pais;
    }
    public function consultarPorPais()
    {
        $conexion = new Conexion();
        $ciudadDAO = new CiudadDAO("", "", $this->pais);
        $conexion->abrir();
        $conexion->ejecutar($ciudadDAO->consultarPorPais());
        $ciudades = array();
        while (($registro = $conexion->registro()) != null) {
            $ciudad = new Ciudad($registro[0], $registro[1], $this->pais);
            array_push($ciudades, $ciudad);
        }
        $conexion->cerrar();
        return $ciudades;
    }
    public function consultarPorId()
    {
        $conexion = new Conexion();
        $ciudadDAO = new CiudadDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($ciudadDAO->consultarPorId());
        $tupla = $conexion->registro();
        $this->nombre = $tupla[0];
        $this->pais = new Pais($tupla[1]);
        $this->pais->consultarPorId();
        $conexion->cerrar();
    }
    public function registrar()
    {
        $conexion = new Conexion();
        $ciudadDAO = new CiudadDAO("", $this->nombre, $this->pais);
        $conexion->abrir();
        $conexion->ejecutar($ciudadDAO->registrar());
        $conexion->cerrar();
    }
    public function buscar($busqueda){
        $conexion = new Conexion();
        $ciudadDAO = new CiudadDAO();
        $conexion -> abrir();
        $conexion -> ejecutar($ciudadDAO -> buscar($busqueda));
        $ciudades = array();
        while (($datos = $conexion->registro()) != null) {
            $ciudad = new Ciudad($datos[0], $datos[1], $datos[2]);
            array_push($ciudades, $ciudad);
        }
        $conexion->cerrar();
        return $ciudades;
    }
    public function consultar(){
        $conexion = new Conexion();
        $ciudadDAO = new CiudadDAO();
        $conexion -> abrir();
        $conexion -> ejecutar($ciudadDAO -> consultar());
        $ciudades = array();
        while (($datos = $conexion->registro()) != null) {
            $pais = new Pais($datos[2]);
            $pais -> consultarPorId();
            $ciudad = new Ciudad($datos[0], $datos[1], $pais);
            array_push($ciudades, $ciudad);
        }
        $conexion->cerrar();
        return $ciudades;
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
    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }
}