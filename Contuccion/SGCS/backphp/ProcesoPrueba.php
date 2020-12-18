<?php

require_once('conectar.php');
require_once('Prueba.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsPrueba();
        $obj=$api->getAgrupäProyecto();
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsPrueba();
        $vector=$api->getPrueba();
        $json=json_encode($vector);
        echo $json;
    }
}

if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $lista=$data['lista'];
    
    $api=new ClsPrueba();
    $json=$api->SetLista($lista);
    $json=json_encode($json);
    echo $json;
} 