<?php

require_once('conectar.php');
require_once('Version.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id_elemento'])){
        $id=$_GET['id_elemento'];
        $api=new ClsVersion();
        $obj=$api->getVersion($id);
        $json=json_encode($obj);
        echo $json;
    }
}

if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $elemntoconfiguracionID=$data['elemntoconfiguracionID'];
    $version=$data['version']; 
    $fecha_inicio=$data['fecha_inicio']; 
    $fecha_termino=$data['fecha_termino']; 
    $miembroresponsableID=$data['miembroresponsableID']; 
    $api=new ClsVersion();
    $json=$api->SetVersion($elemntoconfiguracionID,$version,$fecha_inicio,$fecha_termino,$miembroresponsableID);
    echo $json;
}   
