<?php
class PilotoDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo; 
    private $clave;
    private $imagen; 
    public function __construct($id="",$nombre="",$apellido="",$correo="",$clave="",$imagen=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> imagen = $imagen;
    }
    public function autenticar(){
        return "select idPiloto
            from piloto
            where correo='".$this->correo."' and clave=md5('".$this -> clave."')";
    }
    public function consultarPorId()
    {
        return "select nombre, apellido, correo
            from Piloto
            where idPiloto=" . $this->id;
    }
}
?>