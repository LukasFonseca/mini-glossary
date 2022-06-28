<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("modelo/modelo.php");
$modelo = new Modelo();

include_once("vista/vista.php");
$vista = new Vista();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-Glossary</title>
    
    <!-- BOOTSTRAP - JQUERY NO SLIM - POPPER -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP - JQUERY NO SLIM - POPPER -->

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- DESHABILITAR EL MENSAJE DEL SERVIDOR -->
    <!-- <style>
        .disclaimer{
            display: none;
        }
    </style> -->

    <?php
    $vista->printMenu();
    if (isset($_GET['out']) && isset($_SESSION['id_usuario'])){
        $_SESSION = [];
        // header("Location: login.php");
        ?>
        <script>
            location.href = "login.php";
        </script>
        <?php
    }
    else{
        $vista->printIniciarSesion();
    }
    
    ?>
</body>
</html>
