<?php
class PasajeroDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo; 
    private $clave;
    private $foto;
    private $estado;
    private $fechaActivacion;
    public function __construct($id="",$nombre="",$apellido="",$correo="",$clave="", $foto="", $estado="", $fechaActivacion=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> fechaActivacion = $fechaActivacion;
    }
    public function autenticar(){
        return "select idPasajero
            from P3Pasajero
            where correo='".$this->correo."' and clave=md5('".$this -> clave."')";
    }
    public function consultarPorId()
    {
        return "select nombre, apellido, correo
            from P3Pasajero
            where idPasajero=" . $this->id;
    }
    public function registrar(){
        return "insert into P3Pasajero(NroCedula, nombre, apellido, correo, clave, foto, estado, fechaActivacion)
                values (" . $this -> id . ", '" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', md5('" . $this -> clave . "'), '" . $this -> foto . "', " . $this -> estado . ", NULL)";
    }
    public function activar($correo){
        return "update P3Pasajero
                set estado = '1', fechaActivacion = CURDATE()
                where correo = '" . $correo . "'";
    }
}
?>