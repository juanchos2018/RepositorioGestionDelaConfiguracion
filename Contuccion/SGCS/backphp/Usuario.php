<?php

class ClsUsuario{

    public function getUsuarios(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  * from usuario";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_usuario"=>$fila['id_usuario'],
                "nombre"=>$fila['nombre'],
                "apellido"=>$fila['apellido'],
                "correo"=>$fila['correo']);           
        }
        return $vector;
    }   
   

    public function setUsuario($nombre,$apellido,$correo,$password,$tiposusuarioId){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO usuario (nombre,apellido,correo,password,tiposusuarioId)  VALUES (:nombre,:apellido,:correo,:password,:tiposusuarioId)";
       
        $consulta=$db->prepare($sql);       
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':apellido',$apellido);
        $consulta->bindParam(':correo',$correo);
        $consulta->bindParam(':password',$password);
        $consulta->bindParam(':tiposusuarioId',$tiposusuarioId);      
        $consulta->execute();
        return '{"msg":"Agreado usuario"}';    
    }

    public function get_proyectosusuario($usuario_miembroid){
      
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  mi.id ,ro.nombre,pro.id_proyecto, pro.nombre_proyecto FROM miembroproyecto AS mi 
        INNER JOIN rol AS ro
        ON ro.id_rol =mi.rolId 
        INNER JOIN proyecto AS pro
        ON mi.proyectoId=pro.id_proyecto
        WHERE mi.usuario_miembroid=".$usuario_miembroid;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id"=>$fila['id'],
                "nombre"=>$fila['nombre'],
                "id_proyecto"=>$fila['id_proyecto'],
                "nombre_proyecto"=>$fila['nombre_proyecto'],
                );           
        }
        return $vector;
    }
}