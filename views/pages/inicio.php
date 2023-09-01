 <?php

    $facturas = ControladorFormularios::ctrTraerFacturas();

?>

 <table class="table">
     <thead>
         <tr>
             <th scope="col">NroFactura</th>
             <th scope="col">Fecha</th>
             <th scope="col">Monto</th>
             <th scope="col">Vencimiento</th>
             <th scope="col">Interes</th>
             <th scope="col">Total</th>
             <th scope="col">Acciones</th>
         </tr>
     </thead>
     <tbody>
         <?php foreach ($facturas as $factura) :
                $cuenta = $factura['factMonto'] * $factura['intePorce'];
                ($cuenta == 0) ? $total = $factura['factMonto'] : $total = $cuenta;
            ?>
             <tr>
                 <td scope="row"><?php echo $factura['factID']; ?></td>
                 <td scope="row"><?php echo $factura['factFecIni']; ?></td>
                 <td scope="row"><?php echo $factura['factMonto']; ?></td>
                 <td scope="row"><?php echo $factura['factFecVen']; ?></td>
                 <td scope="row"><?php echo $factura['intePorce']; ?></td>
                 <td scope="row"><?php echo $total; ?></td>
                 <td scope="row">
                     <div class="btn-group">
                         <button class="btn btn-warning"><i class="fa-solid fa-pencil" style="color: #1e3050;"></i></button>
                         <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                     </div>
                 </td>
             </tr>
         <?php endforeach; ?>

     </tbody>
 </table>