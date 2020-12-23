<?php
require_once('../includes/encabezado.php');
require_once('../CapaNegocio/ClsPlantillaElemento.php');
$method=$_SERVER['REQUEST_METHOD'];

if ($method=="POST"){  
    $datos = json_decode(file_get_contents("php://input"));  
    $plantilla = new ClsPlantillaElemento();
    if(empty($datos->faseId) &&  empty($datos->elementoId) ){
        http_response_code(503);
        $msg->mensaje = "Error al registrar plantilla";
        $msg->error = true;
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }else{
        $plantilla->faseId = $datos->faseId;
        $plantilla->elementoId = $datos->elementoId; 
        $resul=$plantilla->Agregar($plantilla);
        if($resul->nroregistros>0){
            http_response_code(200);
            $msg->mensaje = "fase plantilla";
            $msg->error = false;
            echo json_encode($msg, JSON_UNESCAPED_UNICODE); 
        }else{
            http_response_code(500);
            $msg->mensaje = "Error al registrar plantilla";
            $msg->error = true;
            echo json_encode($msg, JSON_UNESCAPED_UNICODE); 
        }
    }
}
if($method=="GET"){
    if(!empty($_GET['faseId'])){
     
            $faseId=$_GET['faseId'];
            $api=new ClsPlantillaElemento();
            $obj=$api->getElementosFase($faseId);
            $json=json_encode($obj);
            echo $json;
        
    }
    else{
        $vector=array();
        $api=new ClsPlantillaElemento();
        $vector=$api->Lista();
        $json=json_encode($vector);
        echo $json;
    }
  
} 

?>
