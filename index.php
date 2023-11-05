<?php 


    require_once "./controller/plantilla.controlador.php";
    require_once "./controller/formularios.controlador.php";
    require_once "./controller/metricas.controlador.php";
    require_once "./models/formularios.modelos.php";
    require_once "./models/metricas.modelos.php";


    $ctr = new ControladorPlantilla();
    $ctr -> ctrTraerPlantilla();

?>