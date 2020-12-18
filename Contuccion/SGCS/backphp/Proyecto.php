<?php
require_once('Cronograma.php');
require_once('Miembro.php');
require_once('CronogramaFase.php');
require_once('CronogramaElemento.php');
require_once('clase.php');
class ClsProyecto{

    public function getProyectos(){
        $vector=array();
        $options =array();  
        $series=[];
        $contador=0;
        $datos= array("Nuevo", "Proceso", "Terminado");
        $charOptions= new Foo();
        $charOptions->labels=$datos; 
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
                "nombre_metodologia"=>$fila['nombre'],
                "labels"=>$options, 
                "series"=>$series,
                "index"=>$contador,
                "charOptions"=>$charOptions );  
                $contador++;              
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

    public function getElementosFaseProyecto($id_proyecto,$id_fase){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT p.id_proyecto , p.nombre_proyecto,cf.nombre, cf.id_cronograma_fase,cf.id_fase,ce.id_cronograma_elemento,ce.nombre_elemento,ce.id_elemento 
        FROM proyecto AS p 
        INNER  JOIN cronograma AS c
        ON p.id_proyecto= c.id_proyecto
        INNER JOIN cronogramafase AS cf
        ON c.id_cronograma=cf.coronogramaId
        INNER JOIN cronograma_elemento AS ce
        ON ce.coronogramaId = cf.id_fase
        WHERE p.id_proyecto=".$id_proyecto." AND id_fase =".$id_fase;
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(   
                "id_cronograma_elemento"=>$fila["id_cronograma_elemento"],
                "id_elemento"=>$fila['id_elemento'],       
                "nombre_elemento"=>$fila['nombre_elemento']);            
        }
        return $vector;
    }

    public function setProyecto($codigo,$nombre,$fechaini,$fechater,$descripcion,$estado,$metodologia,$usuariojefeId,$ListaFases,$ListaElementos){
      
        $conexion=new Conexion();
        $cronograma=new ClsCronograma();        
        $miembro=new ClsMiembro();
      
        $vector=array(); 
        $db=$conexion->getConexion();
        $sql="INSERT INTO proyecto (codigo_proyecto,nombre_proyecto,fecha_inicio,fecha_termino,descripcion,estado,metodologiaId,usuariojefeId)  VALUES (:codigo,:nombre,:fechaini,:fechater,:descripcion,:estado,:metodologia,:usuariojefeId)";
       
        $consulta=$db->prepare($sql);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':fechaini',$fechaini);
        $consulta->bindParam(':fechater',$fechater);
        $consulta->bindParam(':descripcion',$descripcion);
        $consulta->bindParam(':estado',$estado);
        $consulta->bindParam(':metodologia',$metodologia);
        $consulta->bindParam(':usuariojefeId',$usuariojefeId);
        $consulta->execute();
        $retunidproyecto = $db->lastInsertId();

        $id_cronograma=$cronograma->setCronograma($retunidproyecto,$fechaini,$fechater);   
        $rolId="1";
        $dato=$miembro->setMiembro($usuariojefeId,$rolId,$retunidproyecto);

        foreach ($ListaFases as $item)    {   
           $cronogramafase=new ClsCronogramaFase();            
           $id_cronogra_fase= $cronogramafase->setCronogramaFase($id_cronograma,$item['nombre'],$item['id_fase']);   

                 
         }  

        foreach($ListaElementos as $item1){
            $cronogramaelemento=new ClsCronogramaElemento();
           // $cronogramaelemento->setCronogramaElemento($item1['id'],$item1['nombre'],$id_cronogra_fase); 
           $cronogramaelemento->setCronogramaElemento($item1['id'],$item1['nombre'],$item1['id_fase']); 
        }   
         //arreglar aqui we 
        
      
        return '{"msg":"Agreado"}' ;
      
			
    }


    public function GetPrueba(){
        $vector=array();
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT *  FROM prueba";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
              $vector[]=array(
                "id"=>$fila['id'],
                "nombreproyecto"=>$fila['nombreproyecto'],
                "tarea1"=>$fila['tarea1'],
                "tarea2"=>$fila['tarea2'],
                "tarea3"=>$fila['tarea3'] );      
        }
        return $vector;
    } 
}