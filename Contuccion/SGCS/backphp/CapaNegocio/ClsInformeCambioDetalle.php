<?php
//require_once('../CapaDatos/ClsLibre.php');
require_once('../CapaDatos/conectar.php');


class ClsInformeCambioDetalle
{
       
    public function Agregar($id_informecambio,$cronogramaelemetoId,$miembroresponsableId,$descripcion,$fechainicio,$fechatermino,$porcentajeavance,$predecesota){
      
        $conexion=new Conexion();        
       
        $db=$conexion->getConexion();
        $sql="INSERT INTO informecambiodetalle (id_informecambio,cronogramaelemetoId,miembroresponsableId,descripcion,fechainicio,fechatermino,porcentajeavance,predecesota) 
         VALUES (:id_informecambio,:cronogramaelemetoId,:miembroresponsableId,:descripcion,:fechainicio,:fechatermino,:porcentajeavance,:predecesota)";
       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':id_informecambio',$id_informecambio);
        $consulta->bindParam(':cronogramaelemetoId',$cronogramaelemetoId);
        $consulta->bindParam(':miembroresponsableId',$miembroresponsableId);
        $consulta->bindParam(':descripcion',$descripcion);
        $consulta->bindParam(':fechainicio',$fechainicio);
        $consulta->bindParam(':fechatermino',$fechatermino);
        $consulta->bindParam(':porcentajeavance',$porcentajeavance);
        $consulta->bindParam(':predecesota',$predecesota);
        $consulta->execute();
      
       
        return "Agregado ";    			
    }

    

}

