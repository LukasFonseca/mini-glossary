<?php

class Vista
{
    public function printMenu(){
        ?>
        <!-- MENU DARK -->
        <div class="">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">Mini-Glossary</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php 
                            if (isset($_SESSION['id_usuario'])){
                                ?>
                                <a class="nav-link" href="profile.php">My profile</a>
                                <?php
                            }
                            else{
                                ?>
                                <a class="nav-link" href="login.php">Login</a>
                                <?php
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php 
                            if (isset($_SESSION['id_usuario'])){
                                ?>
                                <a class="nav-link" href="login.php?out">Sign off</a>
                                <?php
                            }
                            else{
                                ?>
                                <a class="nav-link" href="registro.php">Register</a>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- MENU -->
        <?php
    }

    public function printIniciarSesion(){
        ?>
        
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class="row">
                <div class="col-0 col-md-3 col-lg-4">

                </div>
                <div class="col-12 col-md-6 col-lg-4 text-center">
                    <!-- LOGIN DARK -->
                    <form class="text-center border border-light p-2 py-5" action="modelo/verificarUsuario.php" method="post">
                        <p class="h4 mb-4">Log in</p>
                        <input type="text" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="Email">
                        <input type="password" id="defaultLoginFormPassword" name="clave" class="form-control mb-4" placeholder="Password">
                        <button class="btn btn-info btn-block my-4" type="submit">Log In</button>
                        <!-- Si no tienes cuenta registrate aqui -->
                        <p>You do not have an account? <a href="registro.php">Register (Free)</a></p>
                    </form>
                    <!-- LOGIN -->
                </div>
                <div class="col-0 col-md-3 col-lg-4">

                </div>
            </div>
        </div>

        <?php
    }

    public function printRegistro(){
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class="row">
                <div class="col-0 col-md-3 col-lg-4">

                </div>
                <div class="col-12 col-md-6 col-lg-4 text-center">
                    <!-- REGISTRARSE DARK -->
                    <form class="text-center border border-light p-2 py-5" action="modelo/insertRegistro.php" method="post">
                        <p class="h4 mb-4">Registrarse</p>
                        <input type="text" id="defaultLoginFormEmail" name="nombre" class="form-control mb-4" placeholder="Name">
                        <input type="text" id="defaultLoginFormEmail" name="apellido" class="form-control mb-4" placeholder="Surname">
                        <input type="number" id="defaultLoginFormEmail" name="edad" class="form-control mb-4" placeholder="Age">
                        <input type="email" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="Email"  >
                        <input type="password" id="defaultLoginFormPassword" name="clave" class="form-control mb-4" placeholder="Password">
                        <input type="password" id="defaultLoginFormPassword" name="clave2" class="form-control mb-4" placeholder="Repeat Password">
                        <button class="btn btn-success btn-block my-4" type="submit">Register</button>
                    </form>
                    <!-- REGISTRARSE -->
                </div>
                <div class="col-0 col-md-3 col-lg-4">

                </div>
            </div>
        </div>
        <?php
    }

    // PERFIL DE USUARIO
    public function printPerfil($usuario, $glosarios){
        $reg_usuario = mysqli_fetch_array($usuario);
        ?>

        <!-- SCRIPT -->
        <script>
            // CARGAR INPUTS EN resultado_palabras
            function cargarInputPalabras(cantidad){
                $("#cantidad").val(cantidad);

                $.ajax({
                    type: "POST",
                    url: "vista/cargarInputs.php",
                    data: {
                        cantidad : cantidad
                    },
                    success: function (response) {
                        console.log(response);
                        $("#resultado_palabras").html(response);
                        $("#add").removeAttr('disabled', 'false');
                    }
                });
            }

            function enviarTraduccion(id_glosario){
                traduccion = $("#traduccion_"+id_glosario).val();
                $.ajax({
                    type: "POST",
                    url: "modelo/insertTraduccion.php",
                    data: {
                        traduccion : traduccion,
                        id_glosario : id_glosario
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response == 1){
                            alert("Translate added");
                            location.reload();

                        }
                        if (response == 0){
                            alert("Some error occurred");
                        }
                    }
                });
            }

        </script>

        <div class="container">
            <div class="row">
                <div class="col-12 p-2 text-center">
                    <!-- FOTO PREDETERMINADA PERFIL -->
                    <h2>Profile: <?php echo $reg_usuario['nombre'] . ' ' . $reg_usuario['apellido'] ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- CARGAR NUEVO GLOSARIO -->
                    <form class="text-center border border-light p-2 py-5" action="modelo/insertGlosario.php" method="post">
                        <p class="h4 mb-4">New Glossary</p>
                        <input type="text" id="defaultLoginFormEmail" name="nombre_tema" class="form-control mb-4" placeholder="Topic name" required>
                        <input type="text" id="defaultLoginFormEmail" name="lenguaje" class="form-control mb-4" placeholder="Language of glossary" required>
                        <div class="row mb-4">
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" type="button" onclick="cargarInputPalabras(3)" >3 words</button>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" type="button"onclick="cargarInputPalabras(4)" >4 words</button>

                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" type="button" onclick="cargarInputPalabras(5)" >5 words</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="resultado_palabras">
                                
                            </div>
                        </div>
                        <input type="hidden" id="cantidad" name="cantidad" value="">
                        <button class="btn btn-success btn-block my-4" type="submit" id="add" disabled>Add</button>
                    </form>
                    <!-- CARGAR NUEVO GLOSARIO -->

                </div>
                <div class="col-12 col-md-6 col-lg-8 text-center p-2 py-5">
                    <p class="h4 mb-4">My Glossaries</p>
                    <?php
                    if (mysqli_num_rows($glosarios) > 0){
                        while ($reg_glosario = mysqli_fetch_array($glosarios)){
                            ?>
                            <div class="p-2 mb-4" style="border: solid 1px black;">
                                <div class="text-center">
                                    <?php 
                                    echo '<b class="text-left">' . $reg_glosario['nombre'] . "'s glossary: </b>";
                                    echo  $reg_glosario['nombre_tema'] . ' (' . $reg_glosario['lenguaje'] .  ')' . '<br>';
                                    ?>
                                </div>
                                <?php
                                    include_once 'modelo/modelo.php';
                                    $modelo = new Modelo();
                                    $palabras = $modelo->selectPalabras($reg_glosario['id_glosario']);
                                ?>
                                <div class="text-left">
                                <?php
                                    while ($reg_palabra = mysqli_fetch_array($palabras)){
                                        echo "<b>" . $reg_palabra['concepto'] . '</b> -> ' . $reg_palabra['definicion'] . '<br>';
                                    }
                                ?>
                                </div>
                                <!-- AGREGAR TRADUCCION -->
                                <div class="row pt-2">
                                    <div class="col-10">
                                        <input class="w-100 h-100" type="text" id="traduccion_<?php echo $reg_glosario['id_glosario'] ?>" placeholder="Write a translation...">
                                        <input type="hidden" id="id_glosario" value="<?php echo $reg_glosario['id_glosario'] ?>">
                                    </div>
                                    <div class="col-2 pl-0">
                                        <button class="btn btn-success btn-block" type="button" onclick="enviarTraduccion('<?php echo $reg_glosario['id_glosario'] ?>')">Send</button>
                                    </div>
                                </div>

                                <!-- TRADUCCIONES -->
                                <?php
                                    $traducciones = $modelo->selectTraducciones($reg_glosario['id_glosario']);
                                    if (mysqli_num_rows($traducciones) > 0){
                                        ?>
                                        <div class="text-left p-2 mt-2" style="border: solid 1px black; background: #e9ecef;">
                                            <?php
                                                while ($reg_traduccion = mysqli_fetch_array($traducciones)){
                                                    echo $reg_traduccion['nombre'] . ' suggests: <br>';
                                                    ?>
                                                    <div class="pl-3 pb-2 mb-2" style="border-bottom: solid 1px #28a745;"><?php echo '&nbsp;&nbsp;"' . $reg_traduccion['traduccion']; ?>"</div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <div class="text-left pl-3 p-2 mt-2" style="border: solid 1px black; background: #e9ecef;">
                                            <div class="pl-3 pb-2 mb-2" style="border-bottom: solid 1px #28a745;">No translations yet</div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    else{
                        echo "No glossaries yet";
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <?php
    }

    // MOSTRAR TODOS LOS GLOSARIOS
    public function printGlosarios($glosarios){
        ?>

        <!-- SCRIPT -->
        <script>
            function busquedaGlosarios(){
                buscar = $("#input_buscar").val();
                $.ajax({
                    type: "POST",
                    url: "modelo/buscarGlosarios.php",
                    data: {
                        buscar : buscar
                    },
                    success: function (response) {
                        console.log(response);
                        $("#busqueda").html(response);
                    }
                });
            }

            function enviarTraduccion(id_glosario){
                traduccion = $("#traduccion_"+id_glosario).val();
                $.ajax({
                    type: "POST",
                    url: "modelo/insertTraduccion.php",
                    data: {
                        traduccion : traduccion,
                        id_glosario : id_glosario
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response == 1){
                            alert("Translate added");
                            busquedaGlosarios();

                        }
                        if (response == 0){
                            alert("Some error occurred");
                        }
                    }
                });
            }

        </script>

        <div class="container">
            <div class="row">
                <div class="col-12 p-2">
                    <h2>Glossaries</h2>
                </div>
            </div>

            <!-- BUSCADOR -->
            <div class="row">
                <div class="col-2">
                    
                </div>
                <div class="col-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="input_buscar" placeholder="Search word" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="busquedaGlosarios()">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    
                </div>
            </div>

            <!-- GLOSARIOS -->
            <div class="row">
                <div class="col-0 col-md-3">

                </div>
                <div class="col-12 col-md-6 text-center" id="busqueda">
                    <?php
                    if (mysqli_num_rows($glosarios) > 0){
                        while ($reg_glosario = mysqli_fetch_array($glosarios)){
                            ?>
                            <div class="p-2 mb-4" style="border: solid 1px black;">
                                <div class="text-center">
                                    <?php 
                                    echo '<b class="text-left">' . $reg_glosario['nombre'] . "'s glossary: </b>";
                                    echo  $reg_glosario['nombre_tema'] . ' (' . $reg_glosario['lenguaje'] .  ')' . '<br>';
                                    ?>
                                </div>
                                <?php
                                    include_once 'modelo/modelo.php';
                                    $modelo = new Modelo();
                                    $palabras = $modelo->selectPalabras($reg_glosario['id_glosario']);
                                ?>
                                <div class="text-left">
                                <?php
                                    while ($reg_palabra = mysqli_fetch_array($palabras)){
                                        echo "<b>" . $reg_palabra['concepto'] . '</b> -> ' . $reg_palabra['definicion'] . '<br>';
                                    }
                                ?>
                                </div>
                                <!-- AGREGAR TRADUCCION -->
                                <div class="row pt-2">
                                    <div class="col-10">
                                        <input class="w-100 h-100" type="text" id="traduccion_<?php echo $reg_glosario['id_glosario'] ?>" placeholder="Write a translation...">
                                        <input type="hidden" id="id_glosario" value="<?php echo $reg_glosario['id_glosario'] ?>">
                                    </div>
                                    <div class="col-2 pl-0">
                                        <button class="btn btn-success btn-block" type="button" onclick="enviarTraduccion('<?php echo $reg_glosario['id_glosario'] ?>')">Send</button>
                                    </div>
                                </div>

                                <!-- TRADUCCIONES -->
                                <?php
                                    $traducciones = $modelo->selectTraducciones($reg_glosario['id_glosario']);
                                    if (mysqli_num_rows($traducciones) > 0){
                                        ?>
                                        <div class="text-left p-2 mt-2" style="border: solid 1px black; background: #e9ecef;">
                                            <?php
                                                while ($reg_traduccion = mysqli_fetch_array($traducciones)){
                                                    echo $reg_traduccion['nombre'] . ' suggests: <br>';
                                                    ?>
                                                    <div class="pl-3 pb-2 mb-2" style="border-bottom: solid 1px #28a745;"><?php echo '&nbsp;&nbsp;"' . $reg_traduccion['traduccion']; ?>"</div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <div class="text-left pl-3 p-2 mt-2" style="border: solid 1px black; background: #e9ecef;">
                                            <div class="pl-3 pb-2 mb-2" style="border-bottom: solid 1px #28a745;">No translations yet</div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    else{
                        echo "No glossaries yet";
                    }
                    ?>
                </div>
                <div class="col-0 col-md-3">

                </div>
            </div>
        </div>  
        
        <?php
    }
}