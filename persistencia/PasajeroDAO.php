<?php
class PasajeroDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo; 
    private $clave;
    public function __construct($id="",$nombre="",$apellido="",$correo="",$clave=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }
    public function autenticar(){
        return "select NroCedula
            from P3Pasajero
            where correo='".$this->correo."' and clave=md5('".$this -> clave."')";
    }
    public function consultarPorId()
    {
        return "select nombre, apellido, correo
            from P3Pasajero
            where idPasajero=" . $this->id;
    }
}
?>