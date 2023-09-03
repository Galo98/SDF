 <?php

    $facturas = ControladorFormularios::ctrTraerFacturas(null,null);

?>

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
                $cuenta = $factura['factMonto'] * $factura['intePorce'];
                ($cuenta == 0) ? $total = $factura['factMonto'] : $total = $cuenta;
            ?>
             <tr>
                 <td class="text-center" scope="row"><?php echo $factura['factFecIni']; ?></td>
                 <td class="text-center" scope="row"><?php echo $factura['factMonto']; ?></td>
                 <td class="text-center" scope="row"><?php echo $factura['factFecVen']; ?></td>
                 <td class="text-center" scope="row"><?php echo $factura['intePorce']; ?></td>
                 <td class="text-center" scope="row"><?php echo $total; ?></td>
                 <td class="text-center" scope="row">
                     <div class="btn-group">
                         <a class="btn btn-warning" href="index.php?pagina=ediFact&factID=<?php echo $factura['factID'] ?>"><i class="fa-solid fa-pencil" style="color: #1e3050;"></i></a>
                         <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                     </div>
                 </td>
             </tr>
         <?php endforeach; ?>

     </tbody>
 </table>