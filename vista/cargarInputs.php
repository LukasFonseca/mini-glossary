<?php

// echo "anda";

$cantidad = $_POST['cantidad'];

for ($i = 1; $i < $cantidad+1; $i++) {
    ?>
    <input type="text" class="form-control mb-2" name="palabra_<?php echo $i ?>" placeholder="Word '<?php echo $i ?>'" required>
    <!-- DEFINICION -->
    <input type="text" class="form-control mb-4" name="definicion_<?php echo $i ?>" placeholder="Definition '<?php echo $i ?>'" required>
    <?php
}
