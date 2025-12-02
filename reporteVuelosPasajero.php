<?php 
require ("fpdf/fpdf.php");
require ("logica/Persona.php");
require ("logica/Pasajero.php");
require ("logica/Vuelo.php");
include ("phpqrcode/qrlib.php");

$vuelo = new Vuelo();
$vuelos = $vuelo -> consultar();

QRcode::png('http://p3.itiud.org//reporteVuelosPasajero.php', 'imagenes/qr.png');

$pdf = new FPDF("P", "mm", "Letter");
$pdf -> AddPage();
$pdf -> SetFont("Times", "B", 20);
$pdf -> Cell(196, 10, "Reporte", 0, 0, "C");

$pdf -> Image("imagenes/qr.png", 166, 10, 40);

$pdf -> Output("I", "reporte_vuelos.pdf", true);
?>