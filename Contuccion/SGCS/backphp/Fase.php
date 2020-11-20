<?php

class ClsFase{

    public function getFases(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM fase ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_fase"=>$fila['id_fase'],
                "nombre_fase"=>$fila['nombre_fase']);         
        }
        return $vector;
    }
   
    public function getFaseMetodologia($id){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $int = (int)$id;
        $code=18;
        $sql="SELECT * FROM fase where metodologiaId=".$id;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        $page="page1";
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_fase"=>$fila['id_fase'],
                "nombre_fase"=>$fila['nombre_fase'],
                "metodologiaId"=>$fila['metodologiaId'],
                "slot"=>$page,
                "label"=>$fila['nombre_fase']);            
        }
        return $vector;
    }

    public function SetFase($nombre_fase,$metodologiaid){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO  fase (nombre_fase,metodologiaId) VALUES (:nombre_fase,:metodologiaid)";
        $consulta=$db->prepare($sql);         
        $consulta->bindParam(':nombre_fase',$nombre_fase); 
        $consulta->bindParam(':metodologiaid',$metodologiaid);
        $consulta->execute();      
        return '{"msg":"Agreado Fase"}';
    }
    public function EditarFase($id_fase, $nombre_fase){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
       // $sql="UPDATE fase SET    nombre_fase=.$nombre_fase.' '.   WHERE id_fase=".$id_fase;
        $sql = "UPDATE fase SET nombre_fase=:nombre_fase WHERE id_fase=:id_fase";
        $consulta=$db->prepare($sql);         
        $consulta->bindParam(':nombre_fase',$nombre_fase); 
        $consulta->bindParam(':id_fase',$id_fase);
        $consulta->execute();      
        return '{"msg":"editado Fase"}';
    }

}