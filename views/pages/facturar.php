<div class="d-flex justify-content-center">

    <form method="POST" class="p-5 bg-light">

        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" name="f-Monto" class="form-control" pattern="[0-9.]+$" aria-label="Dollar amount (with dot and two decimal places)" required>
            <span class="input-group-text">Ejemplo 0.00</span>
        </div>


        <div class="input-group mb-3">
            <input type="date" name="f-Fecha" class="form-control custom-date-input" required>
        </div>

        <?php $clientes = ControladorFormularios::ctrTraerClientes(); ?>

        <div class="input-group mb-3">
            <select class="form-select" name="f-Clie" aria-label="Default select example" required>
                <option selected>Seleccione una opcion</option>
                <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?php echo $cliente['cliID']; ?>"><?php echo $cliente['cliNombre'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php

        $Mensaje = ControladorFormularios::ctrIngresarFactura();
        if (isset($Mensaje)) {
            switch ($Mensaje) {
                case 1:
                    echo "<div class='alert alert-success'>Factura guardada</div>";
                    break;
            }
            echo '<script>
                        
                            if(window.history.replaceState){
                                window.history.replaceState(null,null,window.location.href );
                            }
                        </script>';
        }
        ?>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></button>

    </form>
</div>