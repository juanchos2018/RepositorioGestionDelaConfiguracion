<?php

require_once('conectar.php');
require_once('Proyecto.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsProyecto();
        $obj=$api->getProyectos();
        $json=json_encode($obj);
        echo $json;
    }
    else if(!empty($_GET['id_proyecto'])){
            $id_proyecto=$_GET['id_proyecto'];
            $api=new ClsProyecto();
            $obj=$api->getFaseMetodologiaProyecto($id_proyecto);
            $json=json_encode($obj);
            echo $json;
    }
    else if(!empty($_GET['id_proyect'])){
            $id_proyecto=$_GET['id_proyect'];
            $api=new ClsProyecto();
            $obj=$api->getProyecto($id_proyecto);
            $json=json_encode($obj);
            echo $json;
     }
    else{
        $vector=array();
        $api=new ClsProyecto();
        $vector=$api->getProyectos();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $codigo=$data['codigo'];    
    $nombre=$data['nombre']; 
    $fechaini=$data['fechaini'];
    $fechater=$data['fechater'];
    $descripcion=$data['descripcion'];
    $estado=$data['estado'];
    $metodologia=$data['metodologia'];  
    $api=new ClsProyecto();
    $json=$api->setProyecto($codigo,$nombre,$fechaini,$fechater,$descripcion,$estado,$metodologia);
    echo $json;
}   