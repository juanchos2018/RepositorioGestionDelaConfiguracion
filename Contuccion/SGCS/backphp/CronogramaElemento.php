<?php


class ClsCronogramaElemento{

   public function setCronogramaElemento($id_elemento,$nombre_elemento,$coronogramaId){      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO cronograma_elemento (id_elemento,nombre_elemento,coronogramaId)  VALUES (:id_elemento,:nombre_elemento,:coronogramaId)";       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':id_elemento',$id_elemento);
        $consulta->bindParam(':nombre_elemento',$nombre_elemento);      
        $consulta->bindParam(':coronogramaId',$coronogramaId);       
        $consulta->execute();      
        return '{"msg":"Agreado" }';
     //   $id_deveulve = $db->lastInsertId();
      //  return   $id_deveulve;      
    }
   
    public function Get_Elementos($id_proyecto){
      $conexion=new Conexion();
      $db=$conexion->getConexion();
      $sql="SELECT p.id_proyecto , p.nombre_proyecto,cf.nombre, cf.id_cronograma_fase,cf.id_fase,ce.nombre_elemento,ce.id_elemento 
      FROM proyecto AS p 
      INNER  JOIN cronograma AS c
      ON p.id_proyecto= c.id_proyecto
      INNER JOIN cronogramafase AS cf
      ON c.id_cronograma=cf.coronogramaId
      INNER JOIN cronograma_elemento AS ce
      ON ce.coronogramaId = cf.id_fase
      WHERE p.id_proyecto=".$id_proyecto;
       $consulta=$db->prepare($sql);
       $consulta->execute();
       while($fila=$consulta->fetch()){
             $vector[]=array(
               "id_proyecto"=>$fila['id_proyecto'],
               "id_fase"=>$fila['id_fase'],
               "nombre_elemento"=>$fila['nombre_elemento']);           
       }
       return $vector;
    
   }
  


}