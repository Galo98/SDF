<div class="d-flex justify-content-center">

    <form method="POST" class="p-5 bg-light">

        <div class="input-group mb-3">
            <span class="input-group-text">Dias</span>
            <input type="text" name="dias" class="form-control" pattern="[0-9-]+$" aria-label="Dollar amount (with dot and two decimal places)">
            <span class="input-group-text">Ejemplo 1-5 o 1</span>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">%</span>
            <input type="text" name="interes" class="form-control" pattern="[0-9.]+$" aria-label="Dollar amount (with dot and two decimal places)" min="1" max="100" step="1" required>
            <span class="input-group-text">Ejemplo 15</span>
        </div>

        <?php

        $Mensaje = ControladorFormularios::ctrIngresarInteres();
        if (isset($Mensaje)) {
            echo '<pre>'; print_r($Mensaje); echo '</pre>';
        }
        ?>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></button>
    </form>


</div>