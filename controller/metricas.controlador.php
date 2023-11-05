<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

    #region ExtraerEXCEL
    static public function ctrExtraerAexcl()
    {
        $spreadsheet = new Spreadsheet();

        $sheetClientes = $spreadsheet->createSheet();
        $sheetClientes->setTitle('Clientes');

        // Agregar los datos de la tabla clientes
        $conexion = new mysqli("localhost", "root", "1234", "SDF");
        $queryClientes = "SELECT * FROM clientes";
        $resultadoClientes = $conexion->query($queryClientes);

        $row = 1;
        while ($fila = $resultadoClientes->fetch_assoc()) {
            $col = 1;
            foreach ($fila as $valor) {
                $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
                $sheetClientes->setCellValue($cellAddress, $valor);
                $col++;
            }
            $row++;
        }

        $sheetFacturas = $spreadsheet->createSheet();
        $sheetFacturas->setTitle('Facturas');

        // Agregar los datos de la tabla facturas
        $queryFacturas = "SELECT * FROM facturas";
        $resultadoFacturas = $conexion->query($queryFacturas);

        $row = 1;
        while ($fila = $resultadoFacturas->fetch_assoc()) {
            $col = 1;
            foreach ($fila as $valor) {
                $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
                $sheetFacturas->setCellValue($cellAddress, $valor);
                $col++;
            }
            $row++;
        }

        $sheetIntereses = $spreadsheet->createSheet();
        $sheetIntereses->setTitle('Intereses');

        // Agregar los datos de la tabla intereses
        $queryIntereses = "SELECT * FROM intereses";
        $resultadoIntereses = $conexion->query($queryIntereses);

        $row = 1;
        while ($fila = $resultadoIntereses->fetch_assoc()) {
            $col = 1;
            foreach ($fila as $valor) {
                $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
                $sheetIntereses->setCellValue($cellAddress, $valor);
                $col++;
            }
            $row++;
        }


        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = "info.xlsx";
        $writer->save($nombreArchivo);

        // Descargar el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        readfile($nombreArchivo);

        // Cerrar la conexión a la base de datos
        $conexion->close();
    }

    #endregion
}

?>