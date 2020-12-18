<?php

class ClsElemento{

    public function getElemento(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT * FROM elementoconfiguracion ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id_elemento"=>$fila['id_elemento'],
                "codigo_elemento"=>$fila['codigo_elemento'],
                "nombre"=>$fila['nombre']  );           
        }
        return $vector;
    }   

    public function setElemento($codigo_elemento,$nombre){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="INSERT INTO elementoconfiguracion(codigo_elemento,nombre)  VALUES (:codigo_elemento,:nombre)";       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':codigo_elemento',$codigo_elemento);
        $consulta->bindParam(':nombre',$nombre);   
        $consulta->execute();
        return '{"msg":"Agreado elemento"}';
      
			
    }
    public function EditarElemento($id_elemento, $nombre){
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();     
        $sql = "UPDATE elementoconfiguracion SET nombre=:nombre WHERE id_elemento=:id_elemento";
        $consulta=$db->prepare($sql);      
        $consulta->bindParam(':id_elemento',$id_elemento);   
        $consulta->bindParam(':nombre',$nombre);         
        $consulta->execute();      
        return '{"msg":"editado Fase"}';
    }
    public function getElemtosFase($id_fase){
        // Esto todavbia no poner we :V
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $int = (int)$id;
        $code=18;
        $sql="SELECT * FROM fase where metodologiaId=".$id;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        $page="page1";
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_fase"=>$fila['id_fase'],
                "nombre_fase"=>$fila['nombre_fase'],
                "metodologiaId"=>$fila['metodologiaId'],
                "slot"=>$page,
                "label"=>$fila['nombre_fase']);            
        }
        return $vector;
    }


}