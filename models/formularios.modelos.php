<?php

require_once "conexion.php";


class ModelosFormularios{

    #region Facturar

    static public function mdlFacturar($tabla,$datos){
        /* stmt = statement = declaracion 
            prepare() prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia sql puede contener cero o mas marcadores de parametros con nombre (:name) o signos de interrogacion (?) por los cuales los valores reales seran sustituidos cuando sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente parametros
        */
        $factFecVen = date('Y-m-d', strtotime($datos['factFecIni'] . ' +30 days'));

        $stmt = Conexion::contectar() -> prepare("insert into $tabla (factMonto,factFecIni,factFecVen,interes) values (:factMonto,:factFecIni,:factFecVen,0);");

        /* bindParam() Vincula una variable de php a un parametro de substitucion con nombre o de signo de interrogacion correspondiente de la sentencia SQL que fue usada para preparar la sentencia */

        $stmt -> bindParam(":factMonto",$datos['factMonto'], PDO::PARAM_STR);
        $stmt -> bindParam(":factFecIni", $datos['factFecIni'], PDO::PARAM_STR);
        $stmt->bindParam(":factFecVen", $factFecVen, PDO::PARAM_STR);
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

    public static function mdlSeleccionarFacturas($tabla,$item,$valor){

        if($item == null && $valor == null){

            $stmt = Conexion::contectar()->prepare("select facturas.*, intereses.intePorce, DATE_FORMAT(factFecIni,'%d/%m/%Y') as factFecIni, DATE_FORMAT(factFecVen,'%d/%m/%Y') as factFecVen from $tabla inner join intereses on facturas.interes = intereses.inteDia order by factID ASC;");

            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = null;
        }else{
            $stmt = Conexion::contectar()->prepare("select facturas.*, intereses.intePorce from $tabla inner join intereses on facturas.interes = intereses.inteDia where $item = $valor;");

            $stmt->execute();
            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        }

    }
    #endregion

    #region ActualizarFacturas
    static public function mdlActualizarFactura($tabla, $datos){
        $factFecVen = date('Y-m-d', strtotime($datos['factFecIni'] . ' +30 days'));

        $stmt = Conexion::contectar()->prepare("update $tabla set factMonto =:factMonto , factFecIni=:factFecIni ,factFecVen=:factFecVen where factID = :factID");

        $stmt->bindParam(":factMonto",$datos['factMonto']);
        $stmt->bindParam(":factFecIni", $datos['factFecIni']);
        $stmt->bindParam(":factFecVen", $factFecVen);
        $stmt->bindParam(":factID", $datos['factID']);
        
        if ($stmt->execute()) {
            $err = 1;
        } else {
            $err = 2;
        }

        $stmt->closeCursor();
        $stmt = null;
        return $err;

    }
    #endregion

    #region ingresoDeIntereses

    static public function mdlIngresoDeIntereses($tabla, $datos){
        $stmt = Conexion::contectar()->prepare("INSERT INTO $tabla (inteDia, intePorce) VALUES (:inteDia, :intePorce);");

        if ($stmt) {
            foreach ($datos["inteDia"] as $key => $dia) {
                $stmt->bindParam(":inteDia", $datos["inteDia"][$key], PDO::PARAM_STR);
                $stmt->bindParam(":intePorce", $datos["intePorce"][$key], PDO::PARAM_STR);
                $stmt->execute();
            }

            $stmt->closeCursor();
            $stmt = null;
            return 1; // Éxito
        } else {
            return 2; // Error
        }
    }
    #endregion

    #region SeleccionarIntereses

    static public function mdlSeleccionarIntereses($tabla){

        $stmt = Conexion::contectar()->prepare("select * from $tabla;");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    #endregion

    #region ActualizarIntereses
    static public function mdlActualizarIntereses($tabla,$porce,$dias){

        $inteDia = implode(",",$dias);
        
        $stmt = Conexion::contectar()->prepare("UPDATE $tabla SET intePorce = :intePorce WHERE inteDia IN ($inteDia)");

        $stmt->bindParam(":intePorce", $porce);

        if ($stmt->execute()) {
            $err = 1;
        } else {
            $err = 2;
        }

        return $err;
    }
    #endregion
}




?>