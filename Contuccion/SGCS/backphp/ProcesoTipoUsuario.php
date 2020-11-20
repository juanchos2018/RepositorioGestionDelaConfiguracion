<?php

require_once('conectar.php');
require_once('TipoUsuario.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsTipoUsuario();
        $obj=$api->getMetodologia($id);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsTipoUsuario();
        $vector=$api->getTipoUsuarios();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $nombre=$data['nombre'];   
   
    $api=new ClsTipoUsuario();
    $json=$api->setUsuario($nombre);
    echo $json;
}   