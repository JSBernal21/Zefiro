<?php 
require_once("persistencia/Conexion.php");
require_once("persistencia/AdminDAO.php");
class Administrador extends Persona{
    public function __construct($id = '', $nombre = '', $apellido = '', $correo = '', $clave = '',$imagen=''){
        parent::__construct($id,$nombre,$apellido,$correo,$clave,$imagen);
    }
    public function autenticar(){
        $adminDAO = new AdminDAO("","","",$this->correo, $this->clave );
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($adminDAO->autenticar());
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
        $adminDao = new AdminDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($adminDao->consultarPorId());
        $tupla = $conexion->registro();
        $this->nombre = $tupla[0];
        $this->apellido = $tupla[1];
        $this->correo = $tupla[2];
        $this->imagen = $tupla[3];
        $conexion->cerrar();
    }
    
}
?>