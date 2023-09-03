 <?php
    $AIPV = ControladorFormularios::ctrAIPV();
    $facturas = ControladorFormularios::ctrTraerFacturas(null, null);
    if(isset($AIPV)){
        echo '<pre class="d-flex justify-content-center mb-3">'; print_r($AIPV); echo '</pre>';
    }
    ?>
 <div class="d-flex justify-content-center mb-3">
     <a class="btn btn-warning" href="index.php?pagina=inicio&AIPV=0">Actualizar intereses</a>
 </div>

 <table class="table">
     <thead>
         <tr>
             <th class="text-center" scope="col">Fecha</th>
             <th class="text-center" scope="col">Monto</th>
             <th class="text-center" scope="col">Vencimiento</th>
             <th class="text-center" scope="col">Interes</th>
             <th class="text-center" scope="col">Total</th>
             <th class="text-center" scope="col">Acciones</th>
         </tr>
     </thead>
     <tbody>
         <?php foreach ($facturas as $factura) :
                $aumento = ($factura['factMonto'] * $factura['intePorce']) / 100;
                $cuenta = $factura['factMonto'] + $aumento;
                ($cuenta == 0) ? $total = $factura['factMonto'] : $total = $cuenta;
            ?>
             <tr>
                 <td class="text-center" scope="row"><?php echo $factura['factFecIni']; ?></td>
                 <td class="text-center" scope="row"><?php echo $factura['factMonto']; ?></td>
                 <td class="text-center" scope="row"><?php echo $factura['factFecVen']; ?></td>
                 <td class="text-center" scope="row"><?php echo $factura['intePorce']. "%"; ?></td>
                 <td class="text-center" scope="row"><?php echo $total; ?></td>
                 <td class="text-center" scope="row">
                     <div class="btn-group">
                         <div class="px-1">
                             <a class="btn btn-warning" href="index.php?pagina=ediFact&factID=<?php echo $factura['factID'] ?>"><i class="fa-solid fa-pencil" style="color: #1e3050;"></i></a>
                         </div>
                         <form method="POST">
                             <input type="hidden" name="eliFact" value="<?php echo $factura['factID'] ?>">
                             <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                             <?php
                                $eliminar = new ControladorFormularios();
                                $eliminar->ctrEliminarFactura();
                                ?>
                         </form>
                     </div>
                 </td>
             </tr>
         <?php endforeach; ?>

     </tbody>
 </table>