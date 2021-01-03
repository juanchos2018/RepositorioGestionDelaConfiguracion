<?php
require_once('../CapaDatos/ClsLibre.php');
class ClsConsulta
{
    public $id_proyecto; 
	public $estado_tarea; 
	public $cantidad;  
    public $index; 
 
    public function ListaTotalTareas(){
        $sql = new tablalibre();
        $consulta ="SELECT pro.id_proyecto, pro.nombre_proyecto,  ta.estado ,COUNT(ta.estado) AS cantidad FROM tarea_ecs AS ta
        INNER JOIN version AS ve
        ON ta.verionID =ve.id_version
        INNER JOIN cronograma_elemento AS cro
        ON ve.elemntoconfiguracionID=cro.id_cronograma_elemento
        INNER JOIN cronogramafase AS cro1
        ON cro.id_cronograma_fase =cro1.id_cronograma_fase
        INNER JOIN cronograma AS cro2 
        ON cro1.coronogramaId=cro2.id_cronograma          
        INNER JOIN proyecto AS pro
        on cro2.id_proyecto=pro.id_proyecto
        GROUP BY pro.id_proyecto ,ta.estado
        ORDER BY ta.estado";
        $rs=$sql->consulta($consulta);
        $vector = array();
        while($datos = $rs->recordset->fetch(PDO::FETCH_ASSOC)){
              $temp = new ClsConsulta;
              $temp->id_proyecto    = $datos["id_proyecto"];
              $temp->estado_tarea   = $datos["estado"];
              $temp->cantidad       = $datos["cantidad"];             	
              array_push($vector,$temp);
        }
        return $vector;
    } 
    public function BuscarTotalTareas($id_proyecto){
        $sql = new tablalibre();
        $consulta = "SELECT pro.id_proyecto, pro.nombre_proyecto,  ta.estado ,COUNT(ta.estado) AS cantidad FROM tarea_ecs AS ta
        INNER JOIN version AS ve
        ON ta.verionID =ve.id_version
        INNER JOIN cronograma_elemento AS cro
        ON ve.elemntoconfiguracionID=cro.id_cronograma_elemento
        INNER JOIN cronogramafase AS cro1
        ON cro.id_cronograma_fase =cro1.id_cronograma_fase
        INNER JOIN cronograma AS cro2 
        ON cro1.coronogramaId=cro2.id_cronograma          
        INNER JOIN proyecto AS pro
        on cro2.id_proyecto=pro.id_proyecto
        WHERE pro.id_proyecto=".$id_proyecto."
        GROUP BY pro.id_proyecto ,ta.estado
        ORDER BY ta.estado";
        $rs=$sql->consulta($consulta);
        $vector = array();
        while($datos = $rs->recordset->fetch(PDO::FETCH_ASSOC)){
            $temp = new ClsConsulta;
            $temp->id_proyecto      = $datos["id_proyecto"];
            $temp->estado_tarea     = $datos["estado"];
            $temp->cantidad         = $datos["cantidad"];             	
            array_push($vector,$temp);
      }
       
        return $vector;
    }
    public function BuscarTototalTareasFase($id_proyecto){
        $sql = new tablalibre();
        $contador=0;
        $lista=array();
        $consulta = "SELECT  pro.id_proyecto,pro.nombre_proyecto,cro1.id_fase, cro1.nombre, ta.estado ,COUNT(ta.estado) AS cantidad FROM tarea_ecs AS ta
        INNER JOIN version AS ve
        ON ta.verionID =ve.id_version
        INNER JOIN cronograma_elemento AS cro
        ON ve.elemntoconfiguracionID=cro.id_cronograma_elemento
        INNER JOIN cronogramafase AS cro1
        ON cro.id_cronograma_fase =cro1.id_cronograma_fase
        INNER JOIN cronograma AS cro2 
        ON cro1.coronogramaId=cro2.id_cronograma 
        INNER JOIN proyecto AS pro
        on cro2.id_proyecto=pro.id_proyecto
        WHERE pro.id_proyecto=".$id_proyecto."
        GROUP BY cro1.nombre ,ta.estado
        ORDER BY cro1.nombre";
        $rs=$sql->consulta($consulta);
        $vector = array();
        while($datos = $rs->recordset->fetch(PDO::FETCH_ASSOC)){
            $temp = new ClsConsulta;
            $temp->nombre_proyecto      = $datos["nombre_proyecto"];
            $temp->id_fase              = $datos["id_fase"];
            $temp->nombre               = $datos["nombre"];  
            $temp->estado               = $datos["estado"];     
            $temp->cantidad             = $datos["cantidad"]; 
            $temp->index                = $contador;   
            $temp->lista                = $lista;         	
            array_push($vector,$temp);

            $contador++;
      }
       
        return $vector;
    }

}

