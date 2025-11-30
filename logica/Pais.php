<?php 
require_once(__DIR__."/../persistencia/Conexion.php");
require_once(__DIR__."/../persistencia/PaisDAO.php");
class Pais{
    private $id;
    private $nombre;
    public function __construct($id="",$nombre=""){
        $this->id=$id;
        $this -> nombre= $nombre;
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
}