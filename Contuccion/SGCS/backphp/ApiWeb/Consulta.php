<?php
require_once('../includes/encabezado.php');
require_once('../CapaNegocio/ClsConsulta.php');
$method=$_SERVER['REQUEST_METHOD'];


if($method=="GET"){
    if(!empty($_GET['id_proyecto'])){
       $id_proyecto=$_GET['id_proyecto'];
       $api=new ClsConsulta();
       $obj=$api->BuscarTotalTareas($id_proyecto);
       $json=json_encode($obj);
       echo $json;
    }
    else if(!empty($_GET['id'])){
        $id_proyecto=$_GET['id'];
        $api=new ClsConsulta();
        $obj=$api->BuscarTototalTareasFase($id_proyecto);
        $json=json_encode($obj);
        echo $json;
    }
    else{
        $consulta = new ClsConsulta();           
        $resul=$consulta->ListaTotalTareas();
        if(count($resul)>0){
                http_response_code(200);
                $msg->mensaje = "Listar consulta";
                $msg->cantidad = count($resul);
                $msg->error = false;
                $msg->data = $resul; 
                echo json_encode($msg, JSON_UNESCAPED_UNICODE); 
            }else{
                http_response_code(200);
                $msg->mensaje = "No se encontraron Resultados";
                $msg->cantidad = count($resul);
                $msg->error = true;                
                $msg->data = $resul; 
                echo json_encode($msg, JSON_UNESCAPED_UNICODE); 
            }
    
    }
}
  
?>
