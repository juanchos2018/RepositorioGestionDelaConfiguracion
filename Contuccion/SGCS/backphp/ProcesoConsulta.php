<?php

require_once('conectar.php');
require_once('Consulta.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['nada'])){
        $id=$_GET['nada'];
        $api=new ClsConsulta();
        $obj=$api->getTotalTareas();
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsConsulta();
        $vector=$api->getTotalTareas();
        $json=json_encode($vector);
        echo $json;
    }
}
