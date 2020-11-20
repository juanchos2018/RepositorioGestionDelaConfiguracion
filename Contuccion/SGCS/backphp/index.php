<?php

require_once('conectar.php');
require_once('api.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new Api();
        $obj=$api->getUsuario($id);
        $json=json_encode($obj);
        echo $json;

    }
    else{
        $vector=array();
        $api=new Api();
        $vector=$api->getUsuarios();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);
    $codigo=$data['codigo'];
    $nombre=$data['nombre'];
    $contra=$data['contra'];
    $estado=$data['estado'];
    $api=new Api();
    $json=$api->addUsuario($codigo,$nombre,$contra,$estado);
    echo $json;
}   