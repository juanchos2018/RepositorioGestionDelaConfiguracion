<?php


class ClsCronogramaFase{

   public function setCronogramaFase($cronogramaId,$nombre,$id_fase){      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO cronogramafase (coronogramaId,nombre,id_fase)  VALUES (:cronogramaId,:nombre,:id_fase)";       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':cronogramaId',$cronogramaId);
        $consulta->bindParam(':nombre',$nombre);      
        $consulta->bindParam(':id_fase',$id_fase);      
        $consulta->execute();
        $id_deveulve = $db->lastInsertId();
        return   $id_deveulve;
      
    }
}