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
    public function registrar()
    {
        return "insert into P3Ruta(descripcion, P3CiudadOrigen, P3CiudadDestino)
            values ('" . $this->descripcion . "', " . $this->origen . ", " . $this->destino . ")";
    }
    public function consultar(){
        return "select idRuta, descripcion, P3CiudadOrigen, P3CiudadDestino
            from P3Ruta order by descripcion";
    }
    public function consultarRuta($filtro){
        return "select idRuta, descripcion, P3CiudadOrigen, P3CiudadDestino
            from P3Ruta
            where descripcion like '%" . $filtro . "%' order by descripcion";
    }
}

?>