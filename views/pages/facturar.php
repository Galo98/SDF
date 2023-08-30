<div class="d-flex justify-content-center">

    <form method="POST" class="p-5 bg-light">

        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" name="f-Monto" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            <span class="input-group-text">Ejemplo 0.00</span>
        </div>


        <div class="input-group mb-3">
            <input type="date" name="f-Fecha" class="form-control custom-date-input">
        </div>

        <?php 
        
            $facturar = new ControladorFormularios();
            $facturar -> ctrFactura();
        
        ?>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></button>

    </form>
</div>