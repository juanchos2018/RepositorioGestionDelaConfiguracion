<?php
require_once('../CapaDatos/ClsLibre.php');
class ClsSolicitudCambio
{
    public $id_solicitud; 
	public $codigo; 
	public $id_proyecto;  
    public $miembrojefeId; 
	public $miembrosolicitanteId; 
    public $fecha;
    public $objetivo; 
	public $descripcion; 
    public $respuesta;
    public $estado;

    function Agregar($solicitud)
    {
        $sql1 = new tablalibre();
        $con="SELECT * FROM solicitudcambio";
        $filas=$sql1->consulta($con);
        $cantidafilas=0;
     //   $cantidafilas = mysqli_num_rows($filas);
        while($datos = $filas->recordset->fetch(PDO::FETCH_ASSOC)){
           $cantidafilas++;
         }      
        $solicitud->codigo= "SC-".$cantidafilas;
        $sql = new tablalibre();
        $consulta ="INSERT INTO solicitudcambio (codigo,id_proyecto,miembrojefeId,miembrosolicitanteId,fecha,objetivo,descripcion,respuesta,estado) 
        values ('$solicitud->codigo', '$solicitud->id_proyecto','$solicitud->miembrojefeId', '$solicitud->miembrosolicitanteId','$solicitud->fecha', '$solicitud->objetivo', '$solicitud->descripcion', '$solicitud->respuesta', '$solicitud->estado')";
        $rs=$sql->consulta($consulta);
        return $rs;
    }
    public function Listar(){
        $sql = new tablalibre();
        $consulta ="SELECT  soli.id_solicitud, soli.codigo,pro.id_proyecto, pro.nombre_proyecto, usu.nombre ,soli.estado,soli.fecha FROM solicitudcambio AS soli
        INNER JOIN proyecto AS pro
        on soli.id_proyecto=pro.id_proyecto
        INNER JOIN miembroproyecto AS mi  
        ON soli.miembrosolicitanteId=mi.id
        INNER JOIN usuario  AS usu
        on mi.usuario_miembroid=usu.id_usuario";
        $rs=$sql->consulta($consulta);
        $vector = array();
        $contador=1;
        while($datos = $rs->recordset->fetch(PDO::FETCH_ASSOC)){
              $temp = new ClsSolicitudCambio;
              $temp->numero          =$contador;
              $temp->codigo          = $datos["codigo"];
              $temp->id_proyecto     = $datos["id_proyecto"];
              $temp->nombre_proyecto = $datos["nombre_proyecto"];
              $temp->nombre          = $datos["nombre"];   
              $temp->estado          = $datos["estado"]; 
              $temp->fecha           = $datos["fecha"];           	
              array_push($vector,$temp);
              $contador++;
        }
        return $vector;
    } 
   
}

