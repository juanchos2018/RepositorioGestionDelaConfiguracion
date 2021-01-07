<?php
require_once('../includes/cors.php');
require_once('../CapaNegocio/ClsInformeCambio.php');

$method=$_SERVER['REQUEST_METHOD'];

if ($method=="POST"){  
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $codigo=$data['codigo'];
    $solicitudcambioId=$data['solicitudcambioId'];
    $descripcion=$data['descripcion'];
    $impactoproblema=$data['impactoproblema'];
    $tiempo=$data['tiempo'];
    $costo=$data['costo'];
    $fecha=$data['fecha'];
    $miembrojefeId=$data['miembrojefeId'];
    $estado=$data['estado'];
    $detalle=$data['ListaDetalle'];
    $api=new ClsInformeCambio();
    $obj=$api->Agregar($codigo,$solicitudcambioId,$descripcion,$tiempo,$costo,$impactoproblema,$fecha,$miembrojefeId,$estado,$detalle);
    $json=json_encode($obj);      
    echo $json;
}


   
?>
