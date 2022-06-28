<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// INCLUYO MODELO
include_once("modelo.php");
$modelo = new Modelo();

if (isset($_POST['cantidad'])) {
    $cantidad = $_POST['cantidad'];
    
    // Insertar Glosario
    $nombre_tema = $_POST['nombre_tema'];
    $lenguaje = $_POST['lenguaje'];
    $id_usuario = $_SESSION['id_usuario'];

    $id_glosario = $modelo->insertGlosario($id_usuario, $nombre_tema, $lenguaje);

    // Insertar palabras
    for ($i = 1; $i < $cantidad+1; $i++) {
        $concepto = $_POST['palabra_' . $i];
        $definicion = $_POST['definicion_' . $i];
        $modelo->insertPalabra($id_glosario, $concepto, $definicion);
    }

    header("Location: ../profile.php");
}
else{
    header('Location: ../index.php');
}