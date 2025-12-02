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
    public function registrar()
    {
        return "insert into P3Avion (nombre, capacidad, P3UbicacionActual) 
                values ('" . $this->nombre . "', " . $this->capacidad . ", " . $this->ubicacionActual . ")";
    }
    public function consultar(){
        return "select idAviones, nombre, capacidad, P3UbicacionActual
                from P3Avion
                order by nombre";
    }
    public function actualizar(){
        return "update P3Avion
                set nombre='" . $this->nombre . "',
                    capacidad=" . $this->capacidad . ",
                    P3UbicacionActual=" . $this->ubicacionActual . "
                where idAviones=" . $this->id;
    }
}

?>