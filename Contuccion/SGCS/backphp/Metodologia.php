<?php

class ClsMetodologia{

    public function getMetodologias(){
        $vector=array();
      //  $children=array();
        $children = array(
            'title' => 'tituooos',
            
         );
         $animales = [];
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM metodologia ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id"=>$fila['id_metodologia'],
                "nombre"=>$fila['nombre'],
                "title"=>$fila['nombre'],
                "key"=>$fila['id_metodologia'],
                "children"=>$animales);           
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

    public function EditarMetodologia($id_metodologia, $nombre){      
        $conexion=new Conexion();
        $db=$conexion->getConexion();     
        $sql = "UPDATE metodologia SET nombre=:nombre WHERE id_metodologia=:id_metodologia";
        $consulta=$db->prepare($sql);      
        $consulta->bindParam(':id_metodologia',$id_metodologia);   
        $consulta->bindParam(':nombre',$nombre);         
        $consulta->execute();      
        return '{"msg":"editado metodlogia"}';
    }

    public function getFaseMetodologia($id_metodologia){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();

        $tabla = [];
      
        $sql="SELECT f.id_fase,f.nombre_fase,me.nombre,me.id_metodologia FROM fase AS f
        INNER JOIN metodologia AS me
        ON f.metodologiaId=me.id_metodologia
        WHERE me.id_metodologia=".$id_metodologia;

        $sql2=" SELECT COUNT(me.id_metodologia) AS cantidad FROM fase AS f
                INNER JOIN metodologia AS me
                ON f.metodologiaId=me.id_metodologia
                WHERE me.id_metodologia=".$id_metodologia;  

        $result = $db->prepare($sql2);
        $result->execute(); 
        $number_of_rows = $result->fetchColumn(); 

        $consulta=$db->prepare($sql);
        $consulta->execute();
        $contador=0;
        while($fila=$consulta->fetch()){
            
            $vector[]=array(   
            "elegir"=>false, 
            "id_fase"=>$fila['id_fase'],       
            "nombre_fase"=>$fila['nombre_fase'],
            "id_metodologia"=>$fila['id_metodologia'],
            "title"=>$fila['nombre_fase'],
            "tabla"=>$tabla,    
            "index"=>$contador,     
           );    
           $contador++; 
         }     
        return $vector;
    }
}