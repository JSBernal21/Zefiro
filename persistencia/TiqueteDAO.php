<?php
class TiqueteDAO{
    private $id;
    private $precio;
    private $reserva;
    private $asiento;
    public function __construct($id="", $precio="", $reserva="", $asiento=""){
        $this->id=$id;
        $this -> precio= $precio;
        $this -> reserva= $reserva;
        $this -> asiento= $asiento;
    }
    public function graficaPaisesVisitados($idPasajero){
        return "select p.nombre AS pais, COUNT(*) AS cantidadVuelos
                FROM p3tiquete t
                JOIN p3reservaasiento ra
                    ON t.P3ReservaAsiento_P3Reserva_idReserva = ra.P3Reserva_idReserva
                AND t.P3ReservaAsiento_P3Asiento_idP3Asiento = ra.P3Asiento_idAsiento
                JOIN p3reserva rsv ON ra.P3Reserva_idReserva = rsv.idReserva
                JOIN p3asiento a ON ra.P3Asiento_idAsiento = a.idAsiento
                JOIN p3vuelo v ON a.P3Vuelo_idVuelo = v.idVuelo
                JOIN p3ruta r ON v.P3Ruta_idRuta = r.idRuta
                JOIN p3ciudad cd ON r.P3CiudadDestino = cd.idCiudad
                JOIN p3pais p ON cd.P3Pais_idPais = p.idPais
                WHERE rsv.P3Pasajero_NroCedula = " . $idPasajero . "
                GROUP BY p.nombre
                ORDER BY cantidadVuelos DESC";
    }
    public function graficaCiudadesVisitadas($idPasajero){
        return "select cd.nombre AS ciudad, p.nombre AS pais, COUNT(*) AS cantidadVuelos
                FROM p3tiquete t
                JOIN p3reservaasiento ra
                    ON t.P3ReservaAsiento_P3Reserva_idReserva = ra.P3Reserva_idReserva
                    AND t.P3ReservaAsiento_P3Asiento_idP3Asiento = ra.P3Asiento_idAsiento
                JOIN p3reserva rsv ON ra.P3Reserva_idReserva = rsv.idReserva
                JOIN p3asiento a ON ra.P3Asiento_idAsiento = a.idAsiento
                JOIN p3vuelo v ON a.P3Vuelo_idVuelo = v.idVuelo
                JOIN p3ruta r ON v.P3Ruta_idRuta = r.idRuta
                JOIN p3ciudad cd ON r.P3CiudadDestino = cd.idCiudad
                JOIN p3pais p ON cd.P3Pais_idPais = p.idPais
                WHERE rsv.P3Pasajero_NroCedula = $idPasajero
                GROUP BY cd.nombre, p.nombre
                ORDER BY cantidadVuelos DESC";
    }

}
?>