<?php

class ClsLogin{
  
    public function GetLogin($correo_usuario,$password){      
        $vector=array();      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
    
        $sql="SELECT usu.nombre,usu.apellido,usu.tiposusuarioId,usu.correo,ti.id_tipo from usuario  as usu
         INNER JOIN  tipousuario AS ti
         ON usu.tiposusuarioId =ti.id_tipo
         where usu.correo ='$correo_usuario' and usu.password='$password'";
         $consulta=$db->prepare($sql);
         $consulta->execute();
     
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "nombre"=>$fila['nombre'],
                "correo"=>$fila['correo'],
                "id_tipo"=>$fila['id_tipo']               
             );            
        }
        return $vector;
    }

    public function nada(){
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

}