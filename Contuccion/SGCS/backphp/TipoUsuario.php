<?php

class ClsTipoUsuario{

    public function getTipoUsuarios(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM tipousuario ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_tipo"=>$fila['id_tipo'],
                "nombre"=>$fila['nombre']);           
        }
        return $vector;
    }  

    public function addTipoUsuario($nombre){      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO  tipousuario (nombre) VALUES (:nombre)";
        $consulta=$db->prepare($sql);         
        $consulta->bindParam(':nombre',$nombre); 
        $consulta->execute();      
        return '{"msg":"Agreado Metodologia"}';
    }

}