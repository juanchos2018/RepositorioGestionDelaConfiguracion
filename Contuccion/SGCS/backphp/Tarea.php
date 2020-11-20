<?php

class ClsTarea{

    public function getProyectos(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM proyecto ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "codigo_proyecto"=>$fila['codigo_proyecto'],
                "nombre_proyecto"=>$fila['nombre_proyecto'],
                );           
        }
        return $vector;
    }   
    public function getFaseMetodologiaProyecto($id_proyecto){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT f.id_fase,f.nombre_fase,m.nombre,m.id_metodologia FROM proyecto AS p
        INNER JOIN metodologia AS m
        ON m.id_metodologia=p.metodologiaId
        INNER JOIN fase AS f
        ON f.metodologiaId=m.id_metodologia
        WHERE p.id_proyecto =".$id_proyecto;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(   
                "id_fase"=>$fila['id_fase'],       
                "nombre_fase"=>$fila['nombre_fase'],
                "metodologiaId"=>$fila['id_metodologia'],
                "title"=>$fila['nombre_fase']);            
        }
        return $vector;
    }

    public function setTarea($nombre_tarea,$estado,$fecha){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO tareas1 (nombre_tarea,estado,fecha)  VALUES (:nombre_tarea,:estado,:fecha)";
       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':nombre_tarea',$nombre_tarea);
        $consulta->bindParam(':estado',$estado);
        $consulta->bindParam(':fecha',$fecha);      
        $consulta->execute();

        return '{"msg":"Agreado proyecto"}';
      
			
    }

}