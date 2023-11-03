<div class="d-flex justify-content-center">

    <form method="POST" class="p-5 bg-light">

        <div class="input-group mb-3">
            <span class="input-group-text">Nombre del cliente</span>
            <input type="text" name="Cli" class="form-control" pattern="^[A-Za-z\s\-']{2,100}$" aria-label="Nombre del cliente" required>
            <!-- <span class="input-group-text">Ejemplo 0.00</span> -->
        </div>

        <?php

        $Mensaje = ControladorFormularios::ctrIngresarClientes();
        if (isset($Mensaje)) {
            switch ($Mensaje) {
                case 1:
                    echo "<div class='alert alert-success'>Cliente guardado</div>";
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