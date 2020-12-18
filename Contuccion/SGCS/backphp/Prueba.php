<?php
require_once('CronogramaFase.php');
require_once('clase.php');
class ClsPrueba{

    public function getPrueba(){
        $vector=array();   
      
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="SELECT  t.id_proyecto, t.estado_tarea, COUNT(t.estado_tarea)AS cantidad  FROM tareas2 AS t
        GROUP BY t.estado_tarea, t.id_proyecto
        ORDER BY t.estado_tarea";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "estado_tarea"=>$fila['estado_tarea'],
                "cantidad"=>$fila['cantidad']     ,
                     
               );           
        }
        return $vector;
    }      
    public function getAgrupäProyecto(){
        $vector=array();       
        $options =array(
        );  
        $series=[];
        $contador=0;
        $datos= array("Nuevo", "Proceso", "Terminado");
        $charOptions= new Foo();
        $charOptions->labels=$datos; 
        $conexion=new Conexion();
        $db=$conexion->getConexion();
        $sql="  SELECT t.id_proyecto ,p.nombre_proyecto FROM tareas2 AS t
        INNER JOIN proyecto AS p
        ON t.id_proyecto=p.id_proyecto
        GROUP BY t.id_proyecto";
        $consulta=$db->prepare($sql);
        $consulta->execute();
        while($fila=$consulta->fetch()){
            $vector[]=array(
                "id_proyecto"=>$fila['id_proyecto'],
                "nombre_proyecto"=>$fila['nombre_proyecto'],
                "labels"=>$options   , 
                "series"=>$series   ,
                "index"=>$contador   ,
                "charOptions"=>$charOptions  ,
               
               );  
               $contador++;         
        }
        return $vector;
    }   

    public function SetLista($lista){
        $vector=array();   
      
        $conexion=new Conexion();
     
        $db=$conexion->getConexion();
      //  $sql="INSERT INTO proyecto (codigo_proyecto)  VALUES (:codigo)";
       
     //   $consulta=$db->prepare($sql);
       foreach ($lista as $item)    {         
          $vector[]=array(
            "fase"=>$item['nombre']           
           ); 
        }   
        $cronogramafase=new ClsCronogramaFase();
        $cronogramafase->setCronogramaFase("1","hola");    
        foreach ($lista as $item)    {   
          
          // $aa= $cronogramafase->setCronogramaFase("1",$item['nombre'] );            
          }  
     //  $cant= count($lista);
     //   $consulta->bindParam(':codigo',$lista);            
        return $vector;
    } 
    function get_combinations(&$lists,&$result,$stack=array(),$pos=0)
            {
              $list=$lists[$pos];
                if(is_array($list))
                foreach($list as $word)
                {
                array_push($stack,$word);
                if(count($lists)==count($stack))
                    $result[]=$stack;
                else
                get_combinations($lists,$result,$stack,$pos+1);
                array_pop($stack);
            }
}
}