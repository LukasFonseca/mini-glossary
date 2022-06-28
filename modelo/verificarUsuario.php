<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// INCLUYO MODELO
include_once("modelo.php");
$modelo = new Modelo();

if (isset($_POST['email']) &&
    isset($_POST['clave'])) {

    $usuario = $modelo->verificarUsuario($_POST['email'], $_POST['clave']);
    if (mysqli_num_rows($usuario) > 0){
        $reg = mysqli_fetch_array($usuario);
        $_SESSION['id_usuario'] = $reg['id_usuario'];
        ?>
        <script>
            alert("Log in successful");
            location.href = "../index.php";
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert("Email or password incorrect");
            location.href = "../login.php";
        </script>
        <?php
    }
}
else{
    header('Location: ../index.php');
}