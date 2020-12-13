<?php

require_once('conectar.php');
require_once('Metodologia.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsMetodologia();
        $obj=$api->getMetodologia($id);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsMetodologia();
        $vector=$api->getMetodologias();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $nombre=$data['nombre'];   
    $api=new ClsMetodologia();
    $json=$api->addMetodologia($nombre);
    echo $json;
}   