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
}