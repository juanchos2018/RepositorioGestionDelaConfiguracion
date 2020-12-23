<?php

require_once('conectar.php');
require_once('Usuario.php');
require_once('cors.php');
$method=$_SERVER['REQUEST_METHOD'];

if($method=="GET"){
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
        $api=new ClsUsuario();
        $obj=$api->getMetodologia($id);
        $json=json_encode($obj);
        echo $json;
    }
    if(!empty($_GET['usuario_miembroid'])){
        $id=$_GET['usuario_miembroid'];
        $api=new ClsUsuario();
        $obj=$api->get_proyectosusuario($id);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $vector=array();
        $api=new ClsUsuario();
        $vector=$api->getUsuarios();
        $json=json_encode($vector);
        echo $json;
    }
}
if ($method=="POST"){
    $json=null;
    $data=json_decode(file_get_contents("php://input"),true);    
    $nombre=$data['nombre'];   
    $apellido=$data['apellido'];   
    $correo=$data['correo'];   
    $password=$data['password'];   
    $id_tipo_usuario=$data['id_tipo_usuario'];
    $api=new ClsUsuario();
    $json=$api->setUsuario($nombre,$apellido,$correo,$password,$id_tipo_usuario);
    echo $json;
}   