<?php 

class ControladorMetricas{

    
    #region CantidadTotalVentas
    static public function ctrCTV(){
        $datos = ModelosMetricas::mdlCTV();

        return $datos;
    }
    #endregion
    
    #region MontoTotalVendido
    static public function ctrMTV(){
        $datos = ModelosMetricas::mdlMTV();

        return $datos;
    }
    #endregion
    
    #region ProcentajeVentasPorCliente
    static public function ctrPVPC(){
        $datos = ModelosMetricas::mdlPVPC();

        return $datos;
    }
    #endregion
    

}

?>