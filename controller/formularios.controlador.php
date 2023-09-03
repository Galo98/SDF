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

        static public function ctrTraerFacturas($item,$valor){
            $tabla = "facturas";
            $respuesta = ModelosFormularios::mdlSeleccionarFacturas($tabla,$item,$valor);

            return $respuesta;
        }

    #endregion

    #region ActualizarFacturas

        static public function ctrActualizarFactura(){
        if (isset($_POST['editF-ID'])) {
            $tabla = "facturas";
            $datos = array(
                "factMonto" => $_POST['editF-Monto'],
                "factFecIni" => $_POST['editF-Fecha'],
                "factID" => $_POST['editF-ID'],
            );
            $codMsj = ModelosFormularios::mdlActualizarFactura($tabla, $datos);
        }

        return $codMsj;
        }

    #endregion

    #region ingresarInteres
        static public function ctrIngresarInteres(){
            if (isset($_POST['interes']) && isset($_POST['dias']) && $_POST['dias'] != null) {
                $tabla = "intereses";
                $genDias = array(); // Define $genDias fuera de los bloques condicionales

                if (is_array($_POST['dias'])) {
                    foreach ($_POST['dias'] as $dia) {
                        $genDias["inteDia"][] = $dia;
                        $genDias["intePorce"][] = $_POST['interes'];
                    }
                    echo '<pre>'; print_r($genDias); echo '</pre>';
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
        static public function ctrTraerIntereses(){
            $tabla = "intereses";
            $respuesta = ModelosFormularios::mdlSeleccionarIntereses($tabla);

            return $respuesta;
        }
    #endregion

    #region ActualizarIntereses
        static public function ctrActualizarIntereses(){
            if(isset($_POST['interes'])){
                $tabla = "intereses";
                $dias = $_POST['ediDias'];
                $porce = $_POST['interes'];
                $codMsj = ModelosFormularios::mdlActualizarIntereses($tabla, $porce,$dias);
                return $codMsj;
            }
        }

    #endregion

    }

?>