<?php

require_once('conectar.php');
require_once('PlantillaElemento.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id_fase'])){
        $id_fase=$_GET['id_fase'];
        $api=new ClsPlantilla();
        $obj=$api->getElementosFase($id_fase);
        $json=json_encode($obj);
        echo $json;
    }
    else if(!empty($_GET['id_proyecto'])){
            $id_proyecto=$_GET['id_proyecto'];
            $api=new ClsPlantilla();
            $obj=$api->getFaseMetodologiaProyecto($id_proyecto);
            $json=json_encode($obj);
            echo $json;
    }
    else{
        $vector=array();
        $api=new ClsPlantilla();
        $vector=$api->getPlantilla();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $faseId=$data['faseId'];    
    $elementoId=$data['elementoId'];   
    $api=new ClsPlantilla();
    $json=$api->setPlantilla($faseId,$elementoId);
    echo $json;
}   