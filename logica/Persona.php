<?php
class Persona{
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $correo; 
    protected $clave; 
    protected $imagen;
    public function __construct($id="",$nombre="",$apellido="",$correo="",$clave="",$imagen=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> imagen = $imagen;
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
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @return mixed
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * @return mixed
     */
    public function getImagen(){
        return $this -> imagen;
    }

    /**
     * @param mixed $nombre
     */
    public function setId($id)
    {
        $this->id= $id;
    }
    
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @param mixed $clave
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function setImagen(){
        $this -> imagen;
    }
}
?>