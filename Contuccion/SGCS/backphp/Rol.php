<?php

class ClsRol{

    public function getRoles(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  * from rol";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_rol"=>$fila['id_rol'],
                "nombre"=>$fila['nombre']);           
        }
        return $vector;
    }   
   
    public function setRol($nombre,$apellido,$correo,$password,$tiposusuarioId){      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO proyecto (nombre,apellido,correo,password,tiposusuarioId)  VALUES (:nombre,:apellido,:correo,:password,:tiposusuarioId)";
       
        $consulta=$db->prepare($sql);       
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':apellido',$apellido);
        $consulta->bindParam(':correo',$correo);
        $consulta->bindParam(':password',$password);
        $consulta->bindParam(':tiposusuarioId',$tiposusuarioId);      
        $consulta->execute();
        return '{"msg":"Agreado usuario"}';
      
			
    }

}