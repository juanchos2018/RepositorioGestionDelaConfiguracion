<?php

class ClsVersion{     

    public function SetVersion($elemntoconfiguracionID,$version,$fecha_inicio,$fecha_termino,$miembroresponsableID){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO  version (elemntoconfiguracionID,version,fecha_inicio,fecha_termino,miembroresponsableID) VALUES   (:elemntoconfiguracionID,:version,:fecha_inicio,:fecha_termino,:miembroresponsableID)";
        $consulta=$db->prepare($sql);         
        $consulta->bindParam(':elemntoconfiguracionID',$elemntoconfiguracionID); 
        $consulta->bindParam(':version',$version);
        $consulta->bindParam(':fecha_inicio',$fecha_inicio);
        $consulta->bindParam(':fecha_termino',$fecha_termino);
        $consulta->bindParam(':miembroresponsableID',$miembroresponsableID );
        $consulta->execute();      
        return '{"msg":"Agreado Version"}';
    }
    public function getVersion($id_elemento){      
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();       
      
        $sql="SELECT v.miembroresponsableID, v.id_version,v.elemntoconfiguracionID,v.version,v.fecha_inicio,v.fecha_termino FROM version AS v
        WHERE v.elemntoconfiguracionID =".$id_elemento;
        $consulta=$db->prepare($sql);
        $consulta->execute();
     
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_version"=>$fila['id_version'],
                "miembroresponsableID"=>$fila['miembroresponsableID'],
                "elemntoconfiguracionID"=>$fila['elemntoconfiguracionID'],
                "version"=>$fila['version'],
                "fecha_inicio"=>$fila['fecha_inicio'],
                "fecha_termino"=>$fila['fecha_termino']);            
        }
        return $vector;
    }

}