<?php

require_once('conectar.php');
require_once('Elemento.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsElemento();
        $obj=$api->getElemento();
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsElemento();
        $vector=$api->getElemento();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $codigo_elemento=$data['codigo_elemento'];    
    $nombre=$data['nombre'];     
    $api=new ClsElemento();
    $json=$api->setElemento($codigo_elemento,$nombre);
    echo $json;
}   
if ($method=="PUT"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);  
    $id_elemento=$data['id_elemento'];   
    $nombre=$data['nombre'];  
    $api=new ClsElemento();
    $json=$api->EditarElemento($id_elemento,$nombre);
    echo $json;
}   