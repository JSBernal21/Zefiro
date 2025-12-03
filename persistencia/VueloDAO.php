<?php
class VueloDAO{
    private $id;
    private $precioAsiento;
    private $fechaHoraLlegada;
    private $fechaHoraSalida;
    private $ruta;
    private $avion;
    private $copiloto;
    private $piloto;
    private $estado;

    public function __construct($id="", $precioAsiento="", $fechaHoraLlegada="", $fechaHoraSalida="", $ruta="", $avion="", $copiloto="", $piloto="", $estado=""){
        $this->id = $id;
        $this->precioAsiento = $precioAsiento;
        $this->fechaHoraLlegada = $fechaHoraLlegada;
        $this->fechaHoraSalida = $fechaHoraSalida;
        $this->ruta = $ruta;
        $this->avion = $avion;
        $this->copiloto = $copiloto;
        $this->piloto = $piloto;
        $this->estado = $estado;
    
    }
    public function consultar(){
        return "select idVuelo, fechaHoraLlegada, fechaHoraSalida, P3Ruta_idRuta, P3Aviones_idAviones, P3Copiloto, P3Piloto, Estado_idEstado
            from P3Vuelo";
    }
    public function consultarDisponiblesPasajero($origen, $destino, $fecha){
        return "select v.idVuelo, a.idAsiento, a.precio, v.fechaHoraLlegada, v.fechaHoraSalida, r.idRuta, v.P3Aviones_idAviones, v.P3Copiloto, v.P3Piloto, v.Estado_idEstado
            from P3Vuelo v
            join P3Ruta r on P3Ruta_idRuta = r.idRuta
            join P3Ciudad co on r.P3CiudadOrigen = co.idCiudad
            join P3Ciudad cd on r.P3CiudadDestino = cd.idCiudad
            join P3Asiento a on a.P3Vuelo_idVuelo = v.idVuelo
            where Estado_idEstado = 1
            and co.nombre = '" . $origen . "' and cd.nombre = '" . $destino . "'
            AND DATE(v.fechaHoraSalida) = '". $fecha ."'";
    }
    public function consultarDisponiblesPorFecha($origen, $destino, $fecha){
        return "select v.idVuelo, v.fechaHoraLlegada, v.fechaHoraSalida, 
                r.idRuta, v.P3Aviones_idAviones, v.P3Copiloto, v.P3Piloto, v.Estado_idEstado
                from P3Vuelo v
                join P3Ruta r ON P3Ruta_idRuta = r.idRuta
                join P3Ciudad co ON r.P3CiudadOrigen = co.idCiudad
                join P3Ciudad cd ON r.P3CiudadDestino = cd.idCiudad
                where Estado_idEstado = 1
                and co.nombre = '". $origen ."' and cd.nombre = '". $destino ."'
                and DATE(v.fechaHoraSalida) = '". $fecha ."'";
    }

    public function consultarDisponiblesVuelta($origen, $destino, $fecha){
        return "select v.idVuelo, v.fechaHoraLlegada, v.fechaHoraSalida, 
                r.idRuta, v.P3Aviones_idAviones, v.P3Copiloto, v.P3Piloto, v.Estado_idEstado
                from P3Vuelo v
                join P3Ruta r ON P3Ruta_idRuta = r.idRuta
                join P3Ciudad co ON r.P3CiudadOrigen = co.idCiudad
                join P3Ciudad cd ON r.P3CiudadDestino = cd.idCiudad
                where Estado_idEstado = 1
                and co.nombre = '". $destino ."' and cd.nombre = '". $origen ."'
                and DATE(v.fechaHoraSalida) = '". $fecha ."'";
    }

    public function consultarPorId(){
        return "select idVuelo, fechaHoraLlegada, fechaHoraSalida, P3Ruta_idRuta, P3Aviones_idAviones, P3Copiloto, P3Piloto, Estado_idEstado
            from P3Vuelo
            where idVuelo=" . $this->id;
    }
}
?>