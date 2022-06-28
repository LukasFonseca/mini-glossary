<?php
// INCLUYO MODELO 
include_once 'modelo.php';
$modelo = new Modelo();

$buscar = $_POST['buscar'];
$busqueda = $modelo->selectBusqueda($buscar);

$where = "";
$mayor_1 = 0;
if (mysqli_num_rows($busqueda) > 1){
    $mayor_1 = 1;
    while ($reg_busca = mysqli_fetch_array($busqueda)){

        $where .= "glosarios.id_glosario = " . $reg_busca['id_glosario'] . " OR ";

    }
}
else if (mysqli_num_rows($busqueda) == 1){
    while ($reg_busca = mysqli_fetch_array($busqueda)){

        $where .= "glosarios.id_glosario = " . $reg_busca['id_glosario'];

    }
}
else{
    $mayor_1 = 1;
    while ($reg_busca = mysqli_fetch_array($busqueda)){

        $where .= "glosarios.id_glosario = " . $reg_busca['id_glosario'] . " OR ";
   
    }
}

if ($mayor_1 == 1){
    $where = substr($where, 0, -3);
}

// echo $where;

$glosarios = $modelo->selectGlosariosBusqueda($where);

// RESPONSE
if (mysqli_num_rows($glosarios) > 0){
    while ($reg_glosario = mysqli_fetch_array($glosarios)){
        ?>
        <div class="p-2 mb-4" style="border: solid 1px black;">
            <?php
                echo $reg_glosario['nombre'] . "'s glossary: ";
                echo  $reg_glosario['nombre_tema'] . ' (' . $reg_glosario['lenguaje'] .  ')' . '<br>';

                include_once 'modelo/modelo.php';
                $modelo = new Modelo();
                $palabras = $modelo->selectPalabras($reg_glosario['id_glosario']);

                while ($reg_palabra = mysqli_fetch_array($palabras)){
                    echo $reg_palabra['concepto'] . ' -> ' . $reg_palabra['definicion'] . '<br>';
                }
            ?>
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
    echo "The word is not found in any glossary";
}

