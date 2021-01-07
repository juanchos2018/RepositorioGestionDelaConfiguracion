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
        $consulta->bindParam(':impactoproblema',$impactoproblema);
        $consulta->bindParam(':descripcion',$descripcion);
        $consulta->bindParam(':tiempo',$tiempo);
        $consulta->bindParam(':costo',$costo);
        $consulta->bindParam(':fecha',$fecha);
        $consulta->bindParam(':miembrojefeId',$miembrojefeId);
        $consulta->bindParam(':estado',$estado);
        $consulta->execute();
        
        $id_informecambio = $db->lastInsertId();
     
    //  $id_informecambio=2;
    //  $consulta->bindParam(':id_informecambio',$id_informecambio);
    //  $consulta->bindParam(':cronogramaelemetoId',$cronogramaelemetoId);     
    //  $consulta->bindParam(':descripcion',$descripcion);
    //  $consulta->bindParam(':fechainicio',$fechainicio);
    //  $consulta->bindParam(':fechatermino',$fechatermino);
     // $consulta->bindParam(':porcentajeavance',$//);  

   foreach ($detalle as $item)    {   
        $obj=new ClsInformeCambioDetalle();            
       $obj->Agregar($id_informecambio,$item['cronogramaelemetoId'],$item['descripcion'],$item['fechainicio'],$item['fechatermino'],$item['porcentajeavance']);   
      
    }  
        return "Agrregadgp";    			
    }

    

}

