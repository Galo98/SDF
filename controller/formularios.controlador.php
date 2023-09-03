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

    #region EliminarFactura
        public function ctrEliminarFactura(){
            if(isset($_POST['eliFact'])){
                $tabla = "facturas";
                $datos = $_POST['eliFact'];

                $codMsj = ModelosFormularios::mdlEliminarFactura($tabla,$datos);

                if($codMsj == 1){
                    echo "<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null,null,window.location.href);
                        }

                        window.location = 'index.php?pagina=inicio';
                    </script>";
                }else{
                    echo "<div class='alert alert-success'>No se pudo eliminar, " .$codMsj ."</div>";
                }
            }
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
                } else if (strpos($_POST['dias'], '-')) {
                    $diasSeparados = explode("-", $_POST['dias']);
                    $inicio = $diasSeparados[0];
                    $fin = $diasSeparados[1];
                    while ($inicio <= $fin) {
                        $genDias["inteDia"][] = $inicio;
                        $genDias["intePorce"][] = $_POST['interes'];
                        $inicio++;
                    }
                } else {
                    $genDias['inteDia'][] = $_POST['dias'];
                    $genDias["intePorce"][] = $_POST['interes'];
                }
                echo '<pre>'; print_r($genDias); echo '</pre>';
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
            if(isset($_POST['ediDias']) && $_POST['ediDias'] != null){
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