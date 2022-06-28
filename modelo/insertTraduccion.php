<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// INCLUYO MODELO
include_once("modelo.php");
$modelo = new Modelo();

if (isset($_POST['traduccion']) && isset($_POST['id_glosario'])) {
    $traduccion = $_POST['traduccion'];
    $id_glosario = $_POST['id_glosario'];
    $id_usuario = $_SESSION['id_usuario'];
    $insert = $modelo->insertTraduccion($id_glosario, $id_usuario, $traduccion);
    if ($insert == 1){
        echo "1";
    }
    else{
        echo "0";
    }
}
else{
    echo "0";
}