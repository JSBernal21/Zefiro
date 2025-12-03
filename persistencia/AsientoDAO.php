<?php
class AsientoDAO{
    private $id;
    private $precio;
    private $vuelo;

    public function __construct($id="",$precio="", $vuelo=""){
        $this->id=$id;
        $this -> precio= $precio;
        $this -> vuelo= $vuelo;
    }

    public function consultar(){
        return "select idAsiento, precio, P3Vuelo_idVuelo
            from P3Asiento order by precio";
    }
    public function consultarPorId(){
        return "select idAsiento, precio, P3Vuelo_idVuelo
            from P3Asiento where idAsiento= ".$this->id."";
    }
    public function consultarPorVuelo($idVuelo){
        return "select idAsiento, precio, P3Vuelo_idVuelo
                from P3Asiento
                where P3Vuelo_idVuelo = $idVuelo
                order by precio";
    }
}