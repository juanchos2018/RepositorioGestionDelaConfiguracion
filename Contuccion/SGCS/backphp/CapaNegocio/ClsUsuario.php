<?php
require_once('../CapaDatos/ClsLibre.php');
class ClsUsuario
{
    public $id_usuario; 
	public $nombre; 
    public $apellido;  
    public $correo;  
    public $password; 
    public $tiposusuarioId;  

    function Agregar($usuario)
    {
        $sql = new tablalibre();
        $consulta =" INSERT INTO  usuario (nombre,apellido,correo,password,tiposusuarioId) 
        values ('$usuario->nombre', '$usuario->apellido','$usuario->correo','$usuario->password','$usuario->tiposusuarioId')";
        $rs=$sql->consulta($consulta);
        return $rs;
    }
    public function Listar(){
        $sql = new tablalibre();   
        $consulta ="SELECT * FROM  usuario";
        $rs=$sql->consulta($consulta);
        $vector = array();
        while($datos = $rs->recordset->fetch(PDO::FETCH_ASSOC)){
              $temp = new ClsUsuario;
              $temp->id_usuario = $datos["id_usuario"];
              $temp->nombre = $datos["nombre"];
              $temp->apellido = $datos["apellido"]; 
              $temp->correo = $datos["correo"];            	
              array_push($vector,$temp);
        }
        return $vector;
    } 
    public function get_proyectosusuario($usuario_miembroid){
        $sql = new tablalibre();         
        $vector=array();      
        $sql="SELECT  mi.id ,ro.nombre,pro.id_proyecto, pro.nombre_proyecto FROM miembroproyecto AS mi 
        INNER JOIN rol AS ro
        ON ro.id_rol =mi.rolId 
        INNER JOIN proyecto AS pro
        ON mi.proyectoId=pro.id_proyecto
        WHERE mi.usuario_miembroid=".$usuario_miembroid;
        $rs=$sql->consulta($consulta);
        while($datos = $rs->recordset->fetch(PDO::FETCH_ASSOC)){
                $temp = new ClsUsuario;
                $temp->id = $datos["id"];
                $temp->nombre = $datos["nombre"];
                $temp->id_proyecto = $datos["id_proyecto"]; 
                $temp->nombre_proyecto = $datos["nombre_proyecto"];            	
                array_push($vector,$temp);                     
        }
        return $vector;
    }

}

