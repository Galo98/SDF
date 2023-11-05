<?php 

require_once "conexion.php";

class ModelosMetricas{

    #region CantidadTotalVentas
    static public function mdlCTV(){
        $stmt = Conexion::contectar()->prepare("select count(factID) as VentasTotales from facturas;");
        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }
    #endregion

    #region MontoTotalVendido
    static public function mdlMTV(){
        $stmt = Conexion::contectar()->prepare("select sum(factMonto) as MontoTotal from facturas;");
        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }
    #endregion

    #region ProcentajeVentasPorCliente
    static public function mdlPVPC(){
        $stmt = Conexion::contectar()->prepare("CALL CalculaPorcentajeMontoTotal();");
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }
    #endregion

}

?>