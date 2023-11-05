<?php

$CTV = ControladorMetricas::ctrCTV();
$MTV = ControladorMetricas::ctrMTV();
$PVPC = ControladorMetricas::ctrPVPC();
if(isset($_POST['descarga'])){
    ControladorMetricas::ctrExtraerAexcl();
    echo "ENTRO A LA DESCARGA";
}

?>
<div class="container">
    <div class="row d-flex">
        <div class="col card">
            <div class="card-body ">
                Cantidad Total de Ventas
                <?php echo $CTV['VentasTotales']; ?>
            </div>
        </div>
        <div class="col">
            <form method="POST">
                <input type="hidden" name="descarga">
                <button type="submit">Descargar EXCEL</button>
            </form>
        </div>
        <div class="col card">
            <div class="card-body ">
                Monto Total Vendido
                <?php echo "$". $MTV['MontoTotal']; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Cliente</th>
                        <th class="text-center" scope="col">Facturas Totales</th>
                        <th class="text-center" scope="col">Monto</th>
                        <th class="text-center" scope="col">Porcentaje</th>
                        <th class="text-center" scope="col">Facturas Vencidas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($PVPC as $procentaje) :
                    ?>
                        <td class="text-center" scope="row"><?php echo $procentaje['cliNombre']; ?></td>
                        <td class="text-center" scope="row"><?php echo $procentaje['factTot']; ?></td>
                        <td class="text-center" scope="row"><?php echo "$" . $procentaje['mTotClie']; ?></td>
                        <td class="text-center" scope="row"><?php echo "% " . round($procentaje['porcentaje'], 2); ?></td>
                        <td class="text-center" scope="row"><?php echo $procentaje['factVen']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>