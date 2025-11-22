<?php 
require_once("persistencia/Conexion.php");
require_once("persistencia/PasajeroDAO.php");
class pasajero extends Persona{
    private $imagen;
    public function __construct($id = '', $nombre = '', $apellido = '', $correo = '', $clave = ''){
        parent::__construct($id,$nombre,$apellido,$correo,$clave);
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
}
?>