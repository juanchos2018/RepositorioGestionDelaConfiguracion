<?php

class ClsPlantilla{

    public function getPlantilla(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  ele.id_elemento, ele.nombre,fa.id_fase,fa.nombre_fase  FROM plantillaelementoconfiguracion AS pla
        INNER JOIN elementoconfiguracion AS ele
        ON pla.elementoId=ele.id_elemento
        INNER JOIN fase AS fa
        ON pla.faseId=fa.id_fase";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_elemento"=>$fila['id_elemento'],
                "nombre"=>$fila['nombre'],
                "id_fase"=>$fila['id_fase'],
                "nombre_fase"=>$fila['nombre_fase'],
                "title"=>$fila['nombre'],
               );           
        }
        return $vector;
    }   
    public function getElementosFase($id_fase){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  fa.id_fase,fa.nombre_fase,el.id_elemento,el.nombre  FROM  plantillaelementoconfiguracion AS pla
        INNER JOIN fase AS fa 
        ON pla.faseId=fa.id_fase
        INNER JOIN elementoconfiguracion AS el
        ON pla.elementoId=el.id_elemento
        WHERE fa.id_fase=".$id_fase;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(   
                "id_fase"=>$fila['id_fase'],       
                "nombre_fase"=>$fila['nombre_fase'],   
                "id_elemento"=>$fila['id_elemento'],              
                "nombre"=>$fila['nombre']);            
        }
        return $vector;
    }

    public function setPlantilla($faseId,$elementoId){

        $conexion=new Conexion();
        $db=$conexion->getConexion();     
        $sql="INSERT INTO plantillaelementoconfiguracion (faseId,elementoId)  VALUES (:faseId,:elementoId)";       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':faseId',$faseId);
        $consulta->bindParam(':elementoId',$elementoId);       
        $consulta->execute();

        return '{"msg":"Agreado proyecto"}';
      
			
    }

}