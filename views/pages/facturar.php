<div class="d-flex justify-content-center">

    <form method="POST" class="p-5 bg-light">

        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" name="f-Monto" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" required>
            <span class="input-group-text">Ejemplo 0.00</span>
        </div>


        <div class="input-group mb-3">
            <input type="date" name="f-Fecha" class="form-control custom-date-input" required>
        </div>

        <?php 
        
            $Mensaje = ControladorFormularios::ctrFactura();
            if(isset($Mensaje)){
                switch($Mensaje){
                    case 1:

                        echo '<script>
                        
                            if(window.history.replaceState){
                                window.history.replaceState(null,null,window.location.href );
                            }
                        </script>';

                        echo "<div class='alert alert-success'>Factura guardada</div>";
                        break;
                }
            }
        ?>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></button>

    </form>
</div>