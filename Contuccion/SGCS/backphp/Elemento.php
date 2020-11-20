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

}