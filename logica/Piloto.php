<?php 
require_once("persistencia/Conexion.php");
require_once("persistencia/PilotoDAO.php");
class Piloto extends Persona{
    private $imagen;
    public function __construct($id = '', $nombre = '', $apellido = '', $correo = '', $clave = '',$imagen=''){
        parent::__construct($id,$nombre,$apellido,$correo,$clave);
        $this->imagen = $imagen;
    }

    public function autenticar(){
        $pilotoDAO = new PilotoDAO("","","",$this->correo, $this->clave );
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->autenticar());
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