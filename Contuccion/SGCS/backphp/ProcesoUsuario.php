<?php

require_once('conectar.php');
require_once('Usuario.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsUsuario();
        $obj=$api->getMetodologia($id);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsUsuario();
        $vector=$api->getUsuarios();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $nombre=$data['nombre'];   
    $nombre=$data['nombre'];   
    $nombre=$data['nombre'];   
    $nombre=$data['nombre'];   
    $nombre=$data['nombre'];
    $api=new ClsUsuario();
    $json=$api->setUsuario($nombre);
    echo $json;
}   