<?php

require_once "conexion.php";


class ModelosFormularios{

    #region Facturar

    static public function mdlFacturar($tabla,$datos){
        /* stmt = statement = declaracion 
            prepare() prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia sql puede contener cero o mas marcadores de parametros con nombre (:name) o signos de interrogacion (?) por los cuales los valores reales seran sustituidos cuando sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente parametros
        */

        $stmt = Conexion::contectar() -> prepare("insert into $tabla (factMonto,factFecIni,interes) values (:factMonto,:factFecIni,1);");

        /* bindParam() Vincula una variable de php a un parametro de substitucion con nombre o de signo de interrogacion correspondiente de la sentencia SQL que fue usada para preparar la sentencia */

        $stmt -> bindParam(":factMonto",$datos['factMonto'], PDO::PARAM_STR);
        $stmt -> bindParam(":factFecIni", $datos['factFecIni'], PDO::PARAM_STR);

        if($stmt->execute()){
            $err = 1;
        }else{
            $err = 2;
        }
        
        $stmt->closeCursor();
        $stmt = null;
        return $err;
    }

    #endregion


    #region SeleccionarFacturas

    public static function mdlSeleccionarFacturas($tabla){
        $stmt = Conexion::contectar()->prepare("select facturas.*, intereses.intePorce, DATE_FORMAT(factFecIni,'%d/%m/%Y') as factFecIni, DATE_FORMAT(factFecVen,'%d/%m/%Y') as factFecVen from facturas inner join intereses on facturas.interes = intereses.inteID order by factID ASC;");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }
}

$con = Conexion::contectar();


?>