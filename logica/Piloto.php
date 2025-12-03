<?php 
require_once(__DIR__."/../persistencia/Conexion.php");
require_once(__DIR__."/../persistencia/PilotoDAO.php");
class Piloto extends Persona{
    private $estado;
    private $ciudad;
    public function __construct($id = '', $nombre = '', $apellido = '', $correo = '', $clave = '',$imagen='', $estado='', $ciudad=''){
        parent::__construct($id,$nombre,$apellido,$correo,$clave,$imagen);
        $this->estado = $estado;
        $this->ciudad = $ciudad;
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
    public function consultarPorId()
    {
        $conexion = new Conexion();
        $pilotoDao = new PilotoDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($pilotoDao->consultarPorId());
        $tupla = $conexion->registro();
        $this->nombre = $tupla[0];
        $this->apellido = $tupla[1];
        $this->correo = $tupla[2];
        $this->imagen = $tupla[3];
        $this->ciudad = new Ciudad($tupla[4]);
        $this->ciudad->consultarPorId();
        $conexion->cerrar();
    }
    public function consultar()
    {
        $conexion = new Conexion();
        $pilotoDAO = new PilotoDAO();
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->consultar());
        $pilotos = array();
        while (($tupla = $conexion->registro())!= null) {
            $Ciudad=new Ciudad($tupla[6]);
            $Ciudad->consultarPorId();
            $piloto = new Piloto($tupla[0], $tupla[1], $tupla[2], $tupla[3], "", $tupla[4], $tupla[5], $Ciudad);
            array_push($pilotos, $piloto);
        }
        $conexion->cerrar();
        return $pilotos;
    }
    public function registrar()
    {
        $pilotoDAO = new PilotoDAO("", $this->nombre, $this->apellido, $this->correo, $this->clave, $this->imagen,"", $this->ciudad);
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->registrar());
        $conexion->cerrar();
    }
    public function activar($correo)
    {
        $conexion = new Conexion();
        $pilotoDAO = new PilotoDAO();
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->activar($correo));
        $conexion->cerrar();
    }
    public function cambiarEstado($estado)
    {
        $conexion = new Conexion();
        $pilotoDAO = new PilotoDAO($this->id, "", "", "", "", "", $estado, "");
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->cambiarEstado());
        $conexion->cerrar();
    }
    public function actualizar()
    {
        $pilotoDAO = new PilotoDAO($this->id, $this->nombre, $this->apellido, "", "", $this->imagen, "", $this->ciudad);
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->actualizar());
        $conexion->cerrar();
    }
    public function consultarPilotoPorCiudad($ciudadOrigenId)
    {
        $conexion = new Conexion();
        $pilotoDAO = new PilotoDAO();
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->consultarPilotoPorCiudad($ciudadOrigenId));
        $pilotos = array();
        while (($tupla = $conexion->registro())!= null) {
            $Ciudad=new Ciudad($tupla[6]);
            $Ciudad->consultarPorId();
            $piloto = new Piloto($tupla[0], $tupla[1], $tupla[2], $tupla[3], "", $tupla[4], $tupla[5], $Ciudad);
            array_push($pilotos, $piloto);
        }
        $conexion->cerrar();
        return $pilotos;
    }
    public function consultarCopilotoPorCiudad($ciudadOrigenId)
    {
        $conexion = new Conexion();
        $pilotoDAO = new PilotoDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($pilotoDAO->consultarCopilotoPorCiudad($ciudadOrigenId));
        $pilotos = array();
        while (($tupla = $conexion->registro())!= null) {
            $Ciudad=new Ciudad($tupla[6]);
            $Ciudad->consultarPorId();
            $piloto = new Piloto($tupla[0], $tupla[1], $tupla[2], $tupla[3], "", $tupla[4], $tupla[5], $Ciudad);
            array_push($pilotos, $piloto);
        }
        $conexion->cerrar();
        return $pilotos;
    }
    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }  
    /**
     * @return mixed
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }
}
?>