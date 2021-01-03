<?php
//require_once('../CapaDatos/ClsLibre.php');
require_once('../CapaDatos/conectar.php');
require_once('ClsInformeCambioDetalle.php');

class ClsInformeCambio
{   
    
    public function Agregar($codigo,$solicitudcambioId,$descripcion,$tiempo,$costo,$impactoproblema,$fecha,$miembrojefeId,$estado,$detalle){
      
        $conexion=new Conexion();
         
        $vector=array(); 
        $db=$conexion->getConexion();
        $sql="INSERT INTO informecambio (codigo,solicitudcambioId,descripcion,tiempo,costo,impactoproblema,fecha,miembrojefeId,estado) 
         VALUES (:codigo,:solicitudcambioId,:descripcion,:tiempo,:costo,:impactoproblema,:fecha,:miembrojefeId,:estado)";
       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':solicitudcambioId',$solicitudcambioId);
        $consulta->bindParam(':descripcion',$descripcion);
        $consulta->bindParam(':tiempo',$tiempo);
        $consulta->bindParam(':costo',$costo);
        $consulta->bindParam(':fecha',$fecha);
        $consulta->bindParam(':miembrojefeId',$miembrojefeId);
        $consulta->bindParam(':estado',$estado);
        $consulta->execute();
        $retunidproyecto = $db->lastInsertId();
     
   
        foreach ($detalle as $item)    {   
           $obj=new ClsInformeCambioDetalle();            
           $id_cronograma_fase= $obj->Agregar($retunidproyecto,$item['cronogramaelemetoId'],$item['miembroresponsableId'],$item['descripcion'],$item['fechainicio'],$item['fechatermino'],$item['porcentajeavance'],$item['predecesota']);   
         
          }  
        return "Agrregadgp";    			
    }

    

}

