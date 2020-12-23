<?php
require_once('../CapaNegocio/ClsMiembro.php');
require_once('../includes/cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['miembro_id'])){
        $miembro_id=$_GET['miembro_id'];
        $api=new ClsMiembro();
        $obj=$api->getMiembro($miembro_id);
        $json=json_encode($obj);
        echo $json;
    }
    else if(!empty($_GET['miembroresponsableID'])){
            $miembroresponsableID=$_GET['miembroresponsableID'];
            $api=new ClsMiembro();
            $obj=$api->getTareasMiembro($miembroresponsableID);
            $json=json_encode($obj);
            echo $json;
    }

    else if(!empty($_GET['id_proyecto'])){
        $id_proyecto=$_GET['id_proyecto'];
        $api=new ClsMiembro();
        $obj=$api->getMiembrosProyecto($id_proyecto);
        $json=json_encode($obj);
        echo $json;
    }
    
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $usuario_miembroid=$data['usuario_miembroid'];    
    $rolId=$data['rolId'];   
    $proyectoId=$data['proyectoId'];  
    $api=new ClsMiembro();
    $json=$api->Agregar($usuario_miembroid,$rolId,$proyectoId);
    echo $json;
}   

if ($method=="PUT"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $id=$data['id'];    
    $rolId=$data['rolId'];   
  
    $api=new ClsMiembro();
    $json=$api->EditarRol($id,$rolId);
    echo $json;
}   