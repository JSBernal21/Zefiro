<?php
class AvionDAO{
    private $id;
    private $nombre;
    private $capacidad;
    private $ubicacionActual;
    public function __construct($id="", $nombre="", $capacidad="",$ubicacionActual=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> capacidad= $capacidad;
        $this -> ubicacionActual = $ubicacionActual;
    }
    public function consultarPorId(){
        return "select idAviones, nombre, capacidad, P3UbicacionActual
            from P3Avion
            where idAviones=" . $this->id;
    }
}

?>