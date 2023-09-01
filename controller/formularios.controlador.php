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

    #region ingresarInteres
    static public function ctrIngresarInteres()
    {
        if (isset($_POST['interes'])) {
            $tabla = "intereses";
            $genDias = array(); // Define $genDias fuera de los bloques condicionales

            if (is_array($_POST['dias'])) {
                foreach ($_POST['dias'] as $dia) {
                    $genDias["inteDia"][] = $dia;
                    $genDias["intePorce"][] = $_POST['interes'];
                }
            } else {
                $diasSeparados = explode("-", $_POST['dias']);
                $inicio = $diasSeparados[0];
                $fin = $diasSeparados[1];
                while ($inicio <= $fin) {
                    $genDias["inteDia"][] = $inicio;
                    $genDias["intePorce"][] = $_POST['interes'];
                    $inicio++;
                }
            }
            $datos = $genDias;
            $codMsj = ModelosFormularios::mdlIngresoDeIntereses($tabla, $datos);

            return $codMsj;
        }
    }
        #endregion

        #region traerIntereses

        #endregion


    }

?>