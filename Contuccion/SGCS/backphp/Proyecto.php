<?php

class ClsProyecto{

    public function getProyectos(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT p.id_proyecto,p.codigo_proyecto,p.nombre_proyecto,p.fecha_inicio,p.fecha_termino,p.descripcion,p.estado ,
        m.nombre FROM proyecto AS p
        INNER JOIN metodologia AS m
        ON p.metodologiaId=m.id_metodologia";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "codigo_proyecto"=>$fila['codigo_proyecto'],
                "nombre_proyecto"=>$fila['nombre_proyecto'],
                "fecha_inicio"=>$fila['fecha_inicio'],
                "fecha_termino"=>$fila['fecha_termino'],
                "descripcion"=>$fila['descripcion'],
                "estado"=>$fila['estado'],
                "nombre_metodologia"=>$fila['nombre']);           
        }
        return $vector;
    }   
    public function getProyecto($id_proyecto){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT p.id_proyecto,p.codigo_proyecto,p.nombre_proyecto,p.fecha_inicio,p.fecha_termino,p.descripcion,p.estado ,
        m.nombre FROM proyecto AS p
        INNER JOIN metodologia AS m
        ON p.metodologiaId=m.id_metodologia
        WHERE p.id_proyecto=".$id_proyecto;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "codigo_proyecto"=>$fila['codigo_proyecto'],
                "nombre_proyecto"=>$fila['nombre_proyecto'],
                "fecha_inicio"=>$fila['fecha_inicio'],
                "fecha_termino"=>$fila['fecha_termino'],
                "descripcion"=>$fila['descripcion'],
                "estado"=>$fila['estado'],
                "nombre_metodologia"=>$fila['nombre']);           
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

    public function setProyecto($codigo,$nombre,$fechaini,$fechater,$descripcion,$estado,$metodologia){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO proyecto (codigo_proyecto,nombre_proyecto,fecha_inicio,fecha_termino,descripcion,estado,metodologiaId)  VALUES (:codigo,:nombre,:fechaini,:fechater,:descripcion,:estado,:metodologia)";
       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':fechaini',$fechaini);
        $consulta->bindParam(':fechater',$fechater);
        $consulta->bindParam(':descripcion',$descripcion);
        $consulta->bindParam(':estado',$estado);
        $consulta->bindParam(':metodologia',$metodologia);
        $consulta->execute();

        return '{"msg":"Agreado proyecto"}';
      
			
    }

}