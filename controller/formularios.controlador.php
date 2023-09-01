<?php 

    class ControladorFormularios{

        #region ingresarFactura

       static public function ctrIngresarFactura(){
            
            if(isset($_POST['f-Monto']) && isset($_POST['f-Fecha'])){
                $tabla = "facturas";
                $datos = array("factMonto" => $_POST['f-Monto'],
                                "factFecIni" => $_POST['f-Fecha']);
                $codMsj = ModelosFormularios::mdlFacturar($tabla,$datos);
            }
            return $codMsj;
        }

        #endregion


        #region TraerFacturas

        static public function ctrTraerFacturas(){
            $tabla = "facturas";
            $respuesta = ModelosFormularios::mdlSeleccionarFacturas($tabla);

            return $respuesta;
        }

        #endregion
    }









?>