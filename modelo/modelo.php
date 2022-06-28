<?php

@include 'constantes.php';
@include '../constantes.php';
date_default_timezone_set('America/Buenos_Aires');

class Modelo
{
    public $conexion;

    public function conectar()
    {
        if ($this->conexion === NULL) {
            $this->conexion = mysqli_connect(HOST, USUARIO, PASS);
        }
        mysqli_select_db($this->conexion, DB) or die("error al conectar" . mysqli_error($this->conexion));
        mysqli_query($this->conexion, "SET time_zone = '" . date('P') . "'");
        mysqli_query($this->conexion, "SET NAMES utf8");
        return $this->conexion;
    }

    public function selectUsuarios(){
        $this->conectar();

        $sql = "SELECT * FROM usuarios";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));
        
        return $select;
    }

    // INSERTAR USUARIO
    public function insertUsuario($nombre, $apellido, $edad, $email, $clave)
    {
        $this->conectar();

        $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `edad`, `email`, `clave`)
                VALUES ('$nombre', '$apellido', '$edad', '$email', '$clave')";

        mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert usuario');
        $id_usuario = mysqli_insert_id($this->conexion);
        
        return $id_usuario;
    }

    // VERIFICA USUARIO
    public function verificarUsuario($email, $clave)
    {
        $this->conectar();

        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND clave = '$clave'";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));

        return $select;
    }

    // TRAER DATOS DE UN USUARIO
    public function selectUsuarioID($id_usuario)
    {
        $this->conectar();

        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));

        return $select;
    }

    // INSERTAR GLOSARIO
    public function insertGlosario($id_usuario, $nombre_tema, $lenguaje)
    {
        $this->conectar();

        $sql = "INSERT INTO `glosarios`(`id_usuario`, `nombre_tema`, `lenguaje`) 
                VALUES ('$id_usuario', '$nombre_tema', '$lenguaje')";

        $insert = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert glosario');
        $id_glosario = mysqli_insert_id($this->conexion);
        
        return $id_glosario;
    }

    // INSERTAR PALABRAS
    public function insertPalabra($id_glosario, $concepto, $definicion)
    {
        $this->conectar();

        $sql = "INSERT INTO `palabras_glosario`(`id_glosario`, `concepto`, `definicion`) 
                VALUES ('$id_glosario', '$concepto', '$definicion')";

        $insert = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert palabra');
        
        return $insert;
    }

    // MOSTRAR TODOS LOS GLOSARIOS
    public function selectGlosarios()
    {
        $this->conectar();

        $sql = "SELECT glosarios.id_glosario, usuarios.id_usuario, glosarios.nombre_tema, glosarios.lenguaje, usuarios.nombre, usuarios.apellido
                FROM glosarios
                left join usuarios on glosarios.id_usuario = usuarios.id_usuario
                where glosarios.activo = 1
                ORDER BY glosarios.id_glosario DESC";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));
        
        return $select;
    }

    // MOSTRAR TODAS LAS PALABRAS DE UN GLOSARIO
    public function selectPalabras($id_glosario)
    {
        $this->conectar();

        $sql = "SELECT * FROM palabras_glosario 
                WHERE palabras_glosario.id_glosario = '$id_glosario'
                ORDER BY palabras_glosario.concepto";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));
        
        return $select;
    }

    // BUSCAR GLOSARIO POR TEMA O PALABRA
    public function selectBusqueda($busca){
        $this->conectar();

        // SQL 1
        $sql = "SELECT * FROM `palabras_glosario`
                WHERE palabras_glosario.concepto LIKE '%$busca%'
                GROUP by palabras_glosario.id_glosario";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));

        // SQL 2
        $sql_2 = "SELECT * FROM `palabras_glosario`
                WHERE palabras_glosario.definicion LIKE '%$busca%'
                GROUP by palabras_glosario.id_glosario";

        $select_2 = mysqli_query($this->conexion, $sql_2) or die("error al consultar" . mysqli_error($this->conexion));


        if (mysqli_num_rows($select) > 0){
            return $select;
        }
        else{
            return $select_2;
        }
    }

    // GLOSARIOS DE BUSQUEDA
    public function selectGlosariosBusqueda($where){
        $this->conectar();

        if ($where != ''){
            $sql = "SELECT glosarios.id_glosario, usuarios.id_usuario, glosarios.nombre_tema, glosarios.lenguaje, usuarios.nombre, usuarios.apellido
                    FROM glosarios
                    left join usuarios on glosarios.id_usuario = usuarios.id_usuario
                    where glosarios.activo = 1 and ($where)
                    ORDER BY glosarios.id_glosario DESC";
        }
        else{
            $sql = "SELECT glosarios.id_glosario, usuarios.id_usuario, glosarios.nombre_tema, glosarios.lenguaje, usuarios.nombre, usuarios.apellido
                    FROM glosarios
                    left join usuarios on glosarios.id_usuario = usuarios.id_usuario
                    LIMIT 0";
        }

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar 2" . mysqli_error($this->conexion));

        return $select;
    }

    // TRADUCCIONES DE UN GLOSARIO
    public function selectTraducciones($id_glosario){
        $this->conectar();

        $sql = "SELECT traducciones.id_traduccion, usuarios.id_usuario, traducciones.traduccion, usuarios.nombre, usuarios.apellido
                FROM `traducciones`
                left join usuarios on traducciones.id_usuario = usuarios.id_usuario
                WHERE traducciones.id_glosario = $id_glosario
                ORDER BY traducciones.id_traduccion DESC";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));

        return $select;
    }

    // INSERTAR TRADUCCION DE UN GLOSARIO
    public function insertTraduccion($id_glosario, $id_usuario, $traduccion){
        $this->conectar();

        $sql = "INSERT INTO `traducciones`(`id_glosario`, `id_usuario`, `traduccion`) 
                VALUES ('$id_glosario', '$id_usuario', '$traduccion')";

        $insert = mysqli_query($this->conexion, $sql) or die(mysqli_error($this->conexion) . ' error en insert traduccion');
        
        return $insert;
    }

    // MIS GLOSARIOS
    public function selectMisGlosarios($id_usuario){
        $this->conectar();

        $sql = "SELECT glosarios.id_glosario, usuarios.id_usuario, glosarios.nombre_tema, glosarios.lenguaje, usuarios.nombre, usuarios.apellido
                FROM glosarios
                left join usuarios on glosarios.id_usuario = usuarios.id_usuario
                where glosarios.activo = 1 and glosarios.id_usuario = $id_usuario
                ORDER BY glosarios.id_glosario DESC";

        $select = mysqli_query($this->conexion, $sql) or die("error al consultar" . mysqli_error($this->conexion));
        
        return $select;
    }
}