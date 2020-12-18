<?php

require_once('conectar.php');
require_once('CronogramaElemento.php');
require_once('cors.php');

$method=$_SERVER['REQUEST_METHOD'];


if($method=="GET"){
    if(!empty($_GET['id_proyecto'])){
        $id=$_GET['id_proyecto'];
        $api=new ClsCronogramaElemento();
        $obj=$api->Get_Elementos($id);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsCronogramaElemento();
        $vector=$api->getUsuarios();
        $json=json_encode($vector);
        echo $json;
    }
}