<?php
class PaisDAO{
    private $id;
    private $nombre;
    public function __construct($id="",$nombre=""){
        $this->id=$id;
        $this -> nombre= $nombre;
    }
    public function consultar(){
        return "select idPais, nombre
            from P3Pais order by nombre";
    }
    public function consultarPorId(){
        return "select nombre
            from P3Pais where idPais=".$this->id." order by nombre";
    }

    public function consultarVuelosPorPais(){
        return "select p.nombre AS Pais, COUNT(v.idVuelo) AS CantidadVuelos 
            from P3Vuelo v 
            inner join P3Ruta r ON v.P3Ruta_idRuta = r.idRuta 
            inner join P3Ciudad c ON r.P3CiudadDestino = c.idCiudad 
            inner join P3Pais p ON c.P3Pais_idPais = p.idPais 
            group by p.idPais, p.nombre ORDER BY CantidadVuelos DESC";
    }
}