<?php

require_once('conectar.php');
require_once('Miembro.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['miembro_id'])){
        $miembro_id=$_GET['miembro_id'];
        $api=new ClsMiembro();
        $obj=$api->getMiembro($miembro_id);
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
    else{
        $vector=array();
        $api=new ClsMiembro();
        $vector=$api->getProyectos();
        $json=json_encode($vector);
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
    $json=$api->setMiembro($usuario_miembroid,$rolId,$proyectoId);
    echo $json;
}   