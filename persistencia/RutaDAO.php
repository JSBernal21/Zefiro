<?php
class RutaDAO{
    private $id;
    private $descripcion;
    private $origen;
    private $destino;
    public function __construct($id="", $descripcion="", $origen="",$destino=""){
        $this->id=$id;
        $this -> descripcion= $descripcion;
        $this -> origen= $origen;
        $this -> destino = $destino;
    }
    public function consultarPorId(){
        return "select idRuta, descripcion, P3CiudadOrigen, P3CiudadDestino
            from P3Ruta
            where idRuta=" . $this->id;
    }
}

?>