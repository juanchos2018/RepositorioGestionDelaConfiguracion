<?php

require_once('conectar.php');
require_once('CronogramaFase.php');
require_once('cors.php');

$method=$_SERVER['REQUEST_METHOD'];


if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $cronogramaId=$data['cronogramaId'];   
    $nombre=$data['nombre'];   
    $api=new ClsCronogramaFase();
    $json=$api->setCronogramaFase($cronogramaId,$nombre);
    echo $json;
}   