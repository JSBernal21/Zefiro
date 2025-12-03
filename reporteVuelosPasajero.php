<?php 
require ("fpdf/fpdf.php");
require ("logica/Persona.php");
require ("logica/Pasajero.php");
require ("logica/Vuelo.php");
include ("phpqrcode/qrlib.php");

$vuelo = new Vuelo();
$vuelos = $vuelo -> consultar();

QRcode::png('http://p3.itiud.org//reporteVuelosPasajero.php', 'imagenes/pasajero/qr.png');

$pdf = new FPDF("P", "mm", "Letter");
$pdf -> AddPage();
$pdf -> SetFont("Times", "B", 20);
$pdf -> Cell(196, 10, "Reporte", 0, 0, "C");

$pdf -> Image("img/logo.png", 10, 10, 60);
$pdf -> Image("imagenes/qr.png", 166, 10, 40);

$pdf -> Ln(50);
$pdf -> SetFont("Times", "B", 16);
$pdf -> Cell(80, 10, "Tiquete", 1, 0, "C");
$pdf -> Cell(30, 10, "Precio", 1, 0, "C");
$pdf -> Cell(56, 10, "Numero del asiento", 1, 1, "C");


$pdf -> Output("I", "reporte_vuelos.pdf", true);
?>