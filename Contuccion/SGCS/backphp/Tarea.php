<?php

class ClsTarea{

     
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
    public function getTareaVersion($id_version){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT t.id_tarea,t.verionID, t.fecha_inicio,t.fecha_termino,t.descripcion,t.urlevidencia,t.estado FROM tarea_ecs AS t
        WHERE t.verionID=".$id_version;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_tarea"=>$fila['id_tarea'],
                "verionID"=>$fila['verionID'],
                "fecha_inicio"=>$fila['fecha_inicio'],
                "fecha_termino"=>$fila['fecha_termino'],
                "descripcion"=>$fila['descripcion'],
                "urlevidencia"=>$fila['urlevidencia'],  
                "estado"=>$fila['estado'],   );           
        }
        return $vector;
    }   
   
    public function setTareas($verionID,$miembroresponsableID,$fecha_inicio,$fecha_termino,$descripcion,$porcentajeavance,$urlevidencia,$estado){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO tarea_ecs (verionID,miembroresponsableID,fecha_inicio,fecha_termino,descripcion,porcentajeavance,urlevidencia,estado)  VALUES (:verionID,:miembroresponsableID,:fecha_inicio,:fecha_termino,:descripcion,:porcentajeavance,:urlevidencia,:estado)";
       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':verionID',$verionID);
        $consulta->bindParam(':miembroresponsableID',$miembroresponsableID);
        $consulta->bindParam(':fecha_inicio',$fecha_inicio);   
        $consulta->bindParam(':fecha_termino',$fecha_termino);   
        $consulta->bindParam(':descripcion',$descripcion);    
        $consulta->bindParam(':porcentajeavance',$porcentajeavance);    
        $consulta->bindParam(':urlevidencia',$urlevidencia);   
        $consulta->bindParam(':estado',$estado); 
        $consulta->execute();
        return '{"msg":"Agreado proyecto"}';     
			
    }

}