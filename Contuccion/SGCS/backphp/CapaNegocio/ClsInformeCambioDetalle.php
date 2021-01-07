<?php
//require_once('../CapaDatos/ClsLibre.php');
require_once('../CapaDatos/conectar.php');


class ClsInformeCambioDetalle
{
       
    public function Agregar($id_informecambio,$cronogramaelemetoId,$descripcion,$fechainicio,$fechatermino,$porcentajeavance){
      
        $conexion=new Conexion();        
       
        $db=$conexion->getConexion();
        $sql="INSERT INTO informecambiodetalle (id_informecambio,cronogramaelemetoId,descripcion,fechainicio,fechatermino,porcentajeavance) 
         VALUES (:id_informecambio,:cronogramaelemetoId,:descripcion,:fechainicio,:fechatermino,:porcentajeavance)";
        $avance=0;
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':id_informecambio',$id_informecambio);
        $consulta->bindParam(':cronogramaelemetoId',$cronogramaelemetoId);     
        $consulta->bindParam(':descripcion',$descripcion);
        $consulta->bindParam(':fechainicio',$fechainicio);
        $consulta->bindParam(':fechatermino',$fechatermino);
        $consulta->bindParam(':porcentajeavance',$porcentajeavance);  
        $consulta->execute();     
       
        return "Agregado ";    			
    }

    

}

