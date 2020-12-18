<?php

require_once('clase.php');
class ClsConsulta{

    public function getTotalTareas(){
        $vector=array();         
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  pro.id_proyecto, ta.estado ,COUNT(ta.estado) AS cantidad FROM tarea_ecs AS ta
        INNER JOIN version AS ve
        ON ta.verionID =ve.id_version
        INNER JOIN cronograma_elemento AS cro
        ON ve.elemntoconfiguracionID=cro.id_cronograma_elemento
        INNER JOIN cronogramafase AS cro1
        ON cro.coronogramaId =cro1.id_fase
        INNER JOIN cronograma AS cro2 
        ON cro1.coronogramaId=cro2.id_cronograma 
        INNER JOIN proyecto AS pro
        on cro2.id_proyecto=pro.id_proyecto
        GROUP BY pro.id_proyecto ,ta.estado
        ORDER BY ta.estado";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "estado_tarea"=>$fila['estado'],
                "cantidad"=>$fila['cantidad'],);           
         }
        return $vector;
    }      
    
    public function getTareasPorFase($id_proyecto){
        $vector=array();         
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  pro.id_proyecto,pro.nombre_proyecto, cro1.id_fase,cro1.nombre, ta.estado ,COUNT(ta.estado) AS cantidad FROM tarea_ecs AS ta
        INNER JOIN version AS ve
        ON ta.verionID =ve.id_version
        INNER JOIN cronograma_elemento AS cro
        ON ve.elemntoconfiguracionID=cro.id_cronograma_elemento
        INNER JOIN cronogramafase AS cro1
        ON cro.coronogramaId =cro1.id_fase
        INNER JOIN cronograma AS cro2 
        ON cro1.coronogramaId=cro2.id_cronograma 
        INNER JOIN proyecto AS pro
        on cro2.id_proyecto=pro.id_proyecto
        WHERE pro.id_proyecto=".$id_proyecto." GROUP BY cro1.nombre, ta.estado  ORDER BY ta.estado ";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "id_fase"=>$fila['id_fase'],
                "nombre_fase"=>$fila['nombre'],
                "estado_tarea"=>$fila['estado'],
                "cantidad"=>$fila['cantidad'],);           
         }
        return $vector;
    }      
    
     
    
}