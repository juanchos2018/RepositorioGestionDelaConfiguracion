<?php

class ClsMetodologia{

    public function getMetodologias(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM metodologia ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id"=>$fila['id_metodologia'],
                "nombre"=>$fila['nombre']);           
        }
        return $vector;
    }
   

    public function addMetodologia($nombre){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO  metodologia (nombre) VALUES (:nombre)";
        $consulta=$db->prepare($sql);         
        $consulta->bindParam(':nombre',$nombre); 
        $consulta->execute();      
        return '{"msg":"Agreado Metodologia"}';
    }

}