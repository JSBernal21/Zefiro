<?php 
require_once("persistencia/Conexion.php");
require_once("persistencia/PasajeroDAO.php");
class pasajero extends Persona{
    private $foto;
    private $estado;
    private $fechaActivacion;

    public function __construct($id = '', $nombre = '', $apellido = '', $correo = '', $clave = '', $foto = '', $estado = 0, $fechaActivacion = ''){
        parent::__construct($id,$nombre,$apellido,$correo,$clave);
        $this->foto = $foto;
        $this->estado = $estado;
        $this->fechaActivacion = $fechaActivacion;
    }

    public function getFoto(){
        return $this->foto;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getFechaActivacion(){
        return $this->fechaActivacion;
    }

    public function autenticar(){
        $pasajeroDAO = new PasajeroDAO("","","",$this->correo, $this->clave );
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($pasajeroDAO->autenticar());
        $tupla = $conexion->registro();
        $conexion->cerrar();
        if ($tupla !=null){
            $this->id = $tupla[0];
            return true;
        }else{
            return false;
        }
        
    }
    public function consultarPorId()
    {
        $conexion = new Conexion();
        $pasajeroDao = new PasajeroDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($pasajeroDao->consultarPorId());
        $tupla = $conexion->registro();
        $this->nombre = $tupla[0];
        $this->apellido = $tupla[1];
        $this->correo = $tupla[2];
        $conexion->cerrar();
    }

    public function registrar(){
        $conexion = new Conexion();
        $conexion -> abrir();
        $pasajeroDAO = new PasajeroDAO($this -> id, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> estado, $this -> fechaActivacion);        
        $conexion -> ejecutar($pasajeroDAO -> registrar());
        $conexion -> cerrar();
    }

    public function activar($correo){
        $conexion = new Conexion();
        $conexion -> abrir();
        $pasajeroDAO = new PasajeroDAO();
        $conexion -> ejecutar($pasajeroDAO -> activar($correo));
        $conexion -> cerrar();
    }
}
?>