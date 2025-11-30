<?php
$permitidas = ["patoActivarCuenta.png"];

$img = $_GET["img"] ?? "";

if(!in_array($img, $permitidas)){
    http_response_code(404);
    exit;
}

header("Content-Type: image/png");
readfile("img/" . $img);
