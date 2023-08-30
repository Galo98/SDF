<?php 

    class ControladorFormularios{

        #region ingresarFactura

        public function ctrFactura(){
            if(isset($_POST['f-Monto'])){
                echo $_POST['f-Monto'];
            }
        }

        #endregion

    }









?>