<?php

require_once('conectar.php');
require_once('Login.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['correo'])){
        $correo_usuario=$_GET['correo'];
        $password=$_GET['password'];
        $api=new ClsLogin();
        $obj=$api->GetLogin($correo_usuario,$password);
        $json=json_encode($obj);
        echo $json;
    }

    else{
        $vector=array();
        $api=new ClsLogin();
        $vector=$api->getUsuarios();
        $json=json_encode($vector);
        echo $json;
    }
}

if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);   
    $correo_usuario=$data['correo'];   
    $api=new ClsLogin();
    $obj=$api->GetLogin($correo_usuario);
    $json=json_encode($obj);
   
    echo $json;
}   
