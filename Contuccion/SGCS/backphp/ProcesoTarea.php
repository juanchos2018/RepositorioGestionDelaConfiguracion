<?php

require_once('conectar.php');
require_once('Tarea.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id_tarea'])){
        $id=$_GET['id_tarea'];
        $api=new ClsTarea();
        $obj=$api->getTareaVersion($id);
        $json=json_encode($obj);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $verionID=$data['verionID'];    
    $miembroresponsableID=$data['miembroresponsableID']; 
    $fecha_inicio=$data['fecha_inicio']; 
    $fecha_termino=$data['fecha_termino']; 
    $descripcion=$data['descripcion']; 
    $porcentajeavance=$data['porcentajeavance']; 
    $urlevidencia=$data['urlevidencia'];   
    $estado=$data['estado'];  

    $api=new ClsTarea();
    $json=$api->setTareas($verionID,$miembroresponsableID,$fecha_inicio,$fecha_termino,$descripcion,$porcentajeavance,$urlevidencia,$estado);
    echo $json;
}   