<?php

class ClsMiembro{

    public function getMiembro($miemdro_id){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  mi.usuario_miembroid,  u.nombre,u.apellido,r.nombre AS nombre_rol, u.id_usuario  FROM miembroproyecto AS mi
        INNER JOIN usuario AS u
        ON mi.usuario_miembroid =u.id_usuario
        INNER JOIN rol AS r
        ON mi.rolId=r.id_rol WHERE mi.usuario_miembroid=".$miemdro_id;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "usuario_miembroid"=>$fila['usuario_miembroid'],
                "apellido"=>$fila['apellido'],
                "nombre"=>$fila['nombre'],
                "nombre_rol"=>$fila['nombre_rol'],
                "id_usuario"=>$fila['id_usuario'] );           
        }
        return $vector;
    }
   
    public function getMiembrosProyecto($id_proyecto){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT   mi.id,u.nombre,u.apellido,u.correo,r.nombre  as nombre_rol,mi.proyectoId,mi.usuario_miembroid FROM miembroproyecto  AS mi
        INNER JOIN proyecto AS p
        ON mi.proyectoId =p.id_proyecto
        INNER JOIN usuario AS u
        ON mi.usuario_miembroid=u.id_usuario
        INNER JOIN rol AS r
        ON mi.rolId =r.id_rol
        WHERE p.id_proyecto=".$id_proyecto;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id"=>$fila['id'],
                "nombre"=>$fila['nombre'],
                "apellido"=>$fila['apellido'],
                "correo"=>$fila['correo'],
                "nombre_rol"=>$fila['nombre_rol'],
                "proyectoId"=>$fila['proyectoId'],
                "usuario_miembroid"=>$fila['usuario_miembroid']);           
        }
        return $vector;
    }
// const obj={usuario_miembroid:usuario_miembroid,rolId:rolId,proyectoId:proyectoId};
    public function setMiembro($usuario_miembroid,$rolId,$proyectoId){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO  miembroproyecto (usuario_miembroid,rolId,proyectoId) VALUES (:usuario_miembroid,:rolId,:proyectoId)";
        $consulta=$db->prepare($sql);         
        $consulta->bindParam(':usuario_miembroid',$usuario_miembroid); 
        $consulta->bindParam(':rolId',$rolId); 
        $consulta->bindParam(':proyectoId',$proyectoId); 
        $consulta->execute();      
        return '{"msg":"Agreado Miembro"}';
    }

}