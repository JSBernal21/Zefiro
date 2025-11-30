<?php
class PilotoDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo; 
    private $clave;
    private $imagen; 
    private $estado;
    private $ciudad;
    public function __construct($id="",$nombre="",$apellido="",$correo="",$clave="",$imagen="",$estado="",$ciudad=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> imagen = $imagen;
        $this -> estado = $estado;
        $this -> ciudad = $ciudad;
    }
    public function autenticar(){
        return "select idPiloto
            from P3Piloto
            where correo='".$this->correo."' and clave=md5('".$this -> clave."')";
    }
    public function consultarPorId()
    {
        return "select nombre, apellido, correo, foto, P3UbicacionActual
            from P3P3Piloto
            where idPiloto=" . $this->id;
    }
    public function registrar()
    {
        return "insert into P3Piloto (nombre, apellido, correo, clave, foto, estado, P3UbicacionActual) 
                values ('" . $this->nombre . "', '" . $this->apellido . "', '" . $this->correo . "', md5('" . $this->clave . "'), '" . $this->imagen . "', 0, " . $this->ciudad . ")";
    }
    public function activar($correo)
    {
        return "update P3Piloto 
                set estado = '1' 
                where correo = '" . $correo . "'";
    }
    public function consultar()
    {
        return "select idPiloto, nombre, apellido, correo, foto, estado, P3UbicacionActual
            from P3Piloto";
    }
    public function cambiarEstado()
    {
        return "update P3Piloto 
                set estado = " . $this->estado . " 
                where idPiloto = " . $this->id;
    }
    public function actualizar()
    {
        return "update P3Piloto 
                set nombre = '" . $this->nombre . "',
                    apellido = '" . $this->apellido . "',
                    foto = '" . $this->imagen . "',
                    P3UbicacionActual = " . $this->ciudad . "
                where idPiloto = " . $this->id;
    }
}
?>