<?php 

    class ControladorFormularios{

        #region ingresarFactura

       static public function ctrFactura(){
            
            if(isset($_POST['f-Monto']) && isset($_POST['f-Fecha'])){
                $tabla = "facturas";
                $datos = array("factMonto" => $_POST['f-Monto'],
                                "factFecIni" => $_POST['f-Fecha']);
                $codMsj = ModelosFormularios::mdlFacturar($tabla,$datos);
            }
            return $codMsj;
        }

        #endregion

    }









?>