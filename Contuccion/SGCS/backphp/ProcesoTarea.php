<?php

require_once('conectar.php');
require_once('Tarea.php');
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
    $nombre_tarea=$data['nombre_tarea'];    
    $estado=$data['estado']; 
    $fecha=$data['fecha']; 
    $api=new ClsTarea();
    $json=$api->setTarea($nombre_tarea,$estado,$fecha);
    echo $json;
}   