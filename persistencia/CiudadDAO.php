<?php
class CiudadDAO{
    private $id;
    private $nombre;
    private $pais;
    public function __construct($id="",$nombre="",$pais=""){
        $this->id=$id;
        $this -> nombre= $nombre;
        $this -> pais = $pais;
    }
    public function consultarPorPais(){
        return "select idCiudad, nombre
            from P3Ciudad where P3pais_idPais=".$this->pais." order by nombre";
    }
    public function consultarPorId(){
        return "select nombre, P3Pais_idPais
            from P3Ciudad where idCiudad=".$this->id. " order by nombre";
    }
    public function registrar()
    {
        return "insert into P3Ciudad (nombre, P3pais_idPais) 
                values ('" . $this->nombre . "', " . $this->pais . ")";
    }
    public function buscar($busqueda){
        return "select idCiudad, nombre, P3pais_idPais
                from P3Ciudad
                where nombre like '%" . $busqueda . /*"%' or apellido like '%" . $busqueda .*/ "%'";
    }
}