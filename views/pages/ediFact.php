<?php

$Mensaje = ControladorFormularios::ctrActualizarFactura();

if (isset($_GET['factID'])) {

    $item = "factID";
    $valor = $_GET['factID'];

    $factura = ControladorFormularios::ctrTraerFacturas($item, $valor);
}

?>

<div class="d-flex justify-content-center">

    <form method="POST" class="p-5 bg-light">

        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" name="editF-Monto" class="form-control" pattern="[0-9.]+$" aria-label="Dollar amount (with dot and two decimal places)" required value="<?php echo $factura['factMonto'] ?>">
            <span class="input-group-text">Ejemplo 0.00</span>
        </div>


        <div class="input-group mb-3">
            <input type="date" name="editF-Fecha" class="form-control custom-date-input" value="<?php echo $factura['factFecIni']; ?>">
        </div>
        <input type="hidden" name="editF-ID" value="<?php echo $factura['factID']; ?>">

        <div class="input-group mb-3">
            <span class="input-group-text">Cliente</span>
            <input type="text" class="form-control" aria-label="Nombre del cliente" readonly value="<?php echo $factura['cliNombre'] ?>">
        </div>
        <?php


        if (isset($Mensaje)) {
            switch ($Mensaje) {
                case 1:
                    echo "<div class='alert alert-success'>Factura Actualizada</div>";
                    break;
                default:
                    echo "<div class='alert alert-success'>No se pudo actualizar la factura " . $Mensaje . "</div>";
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