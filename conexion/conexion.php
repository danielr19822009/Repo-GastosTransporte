<?php 

// DATOS PARA CONECTARME A LA BASE DE DATOS
$servidorbd = "localhost";
$usuariobd = "root";
$clavebd = "root";
$basedatos = "transporte";

// Establecer la conexión
$conectarbd = new mysqli($servidorbd, $usuariobd, $clavebd, $basedatos);

// Verificar la conexión
if ($conectarbd->connect_error) {
    die("Error de conexión: " . $conectarbd->connect_error);
}

// Establecer el conjunto de caracteres
mysqli_set_charset($conectarbd, "utf8");

?>