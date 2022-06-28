<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// INCLUYO MODELO
include_once("modelo.php");
$modelo = new Modelo();

if (isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['edad']) &&
    isset($_POST['email']) &&
    isset($_POST['clave']) &&
    isset($_POST['clave2'])) {

    $usuarios = $modelo->selectUsuarios();
    while ($reg = mysqli_fetch_array($usuarios)){
        if ($reg['email'] == $_POST['email']){
            ?>
            <script>
                alert("The email is already registered");
                location.href = "../login.php";
            </script>
            <?php
            exit;
        }
    }
    
    if ($_POST['clave'] == $_POST['clave2']) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $id_usuario = $modelo->insertUsuario($nombre, $apellido, $edad, $email, $clave);
        ?>
        <script>
            alert("Register successful! Please log in.");
            location.href = "../login.php";
        </script>
        <?php
    } else {
        header('Location: ../registro.php?error');
    }
}
else{
    header('Location: ../index.php');
}