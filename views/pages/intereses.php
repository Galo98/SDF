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

        $actualizar = ControladorFormularios::ctrActualizarIntereses();
        $Mensaje = ControladorFormularios::ctrIngresarInteres();
        if (isset($Mensaje)) {
            if($Mensaje == 1){
                echo "<div class='alert alert-success'>Intereses guardados</div>";
            }else{
                echo "<div class='alert alert-success'>No se pudo guardar los intereses" . $Mensaje . "</div>";
            }
            echo '<script>
                        
                            if(window.history.replaceState){
                                window.history.replaceState(null,null,window.location.href );
                            }
                        </script>';
        }
        if (isset($actualizar)) {
            if($actualizar == 1){
                echo "<div class='alert alert-success'>Intereses actualizados</div>";
            }else{
                echo "<div class='alert alert-success'>No se pudo actualizar los intereses</div>";
            }
            echo '<script>
                        
                            if(window.history.replaceState){
                                window.history.replaceState(null,null,window.location.href );
                            }
                        </script>';
        }

        ?>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></button>

        <?php $intereses = ControladorFormularios::ctrTraerIntereses();?>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Seleccion</th>
                    <th class="text-center" scope="col">Cantidad Dias</th>
                    <th class="text-center" scope="col">Interes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($intereses as $interes) :
                ?>
                    <tr>
                        <td class="text-center" scope="row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="ediDias[]" class="form-check-input" value=" <?php echo $interes['inteDia'] ?> ">
                                </label>
                            </div>
                        </td>
                        <td class="text-center" scope="row"><?php echo $interes['inteDia']; ?></td>
                        <td class="text-center" scope="row"><?php echo $interes['intePorce'] . "%"; ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </form>


</div>