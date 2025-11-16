<?php 
require_once("persistencia/Conexion.php");
require_once("persistencia/AdminDAO.php");
class Administrador extends Persona{
    private $imagen;
    public function __construct($id = '', $nombre = '', $apellido = '', $correo = '', $clave = '',$imagen=''){
        parent::__construct($id,$nombre,$apellido,$correo,$clave);
        $this->imagen = $imagen;
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
    /**
     * @return mixed
     */
    public function getImagen(){
        return $this -> imagen;
    }
}
?>