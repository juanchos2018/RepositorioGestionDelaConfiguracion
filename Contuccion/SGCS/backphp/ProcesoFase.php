<?php

require_once('conectar.php');
require_once('Fase.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['metodologiaId'])){
        $id=$_GET['metodologiaId'];
        $api=new ClsFase();
        $obj=$api->getFaseMetodologia($id);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsFase();
        $vector=$api->getFases();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $nombre_fase=$data['nombre_fase'];
    $metodologiaid=$data['metodologiaid']; 
    $api=new ClsFase();
    $json=$api->SetFase($nombre_fase,$metodologiaid);
    echo $json;
}   
if ($method=="PUT"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);   
    $id_fase=$data['id_fase'];  
    $nombre_fase=$data['nombre_fase'];   
    $api=new ClsFase();
    $json=$api->EditarFase($id_fase,$nombre_fase);
    echo $json;
}   