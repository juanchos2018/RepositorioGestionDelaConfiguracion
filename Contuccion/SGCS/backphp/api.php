<?php

class Api{
    public function getUsuarios(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM t_usuario ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id"=>$fila['usu_codigo'],
                "nombre"=>$fila['usu_nombre']);
           
        }
        return $vector;
    }
    public function getUsuario($id){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM t_usuario whrer usu_codigo="+$id;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id"=>$fila['usu_codigo'],
                "nombre"=>$fila['usu_nombre']);
            
        }
        return $vector;
    }


    public function addUsuario($codigo,$nombre,$contra,$estado){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO  t_usuario (usu_codigo,usu_nombre,usu_contra,usu_estado) VALUES(:codigo,:nombre,:contra,:estado)";
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':contra',$contra);
        $consulta->bindParam(':estado',$estado);
        $consulta->execute();
      
        return '{"msg":"Agreado Usuario"}';
    }

}