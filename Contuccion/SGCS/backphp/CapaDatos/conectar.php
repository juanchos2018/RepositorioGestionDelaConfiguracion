<?php   

class Conexion{

    public function getConexion(){
      //  $hostname="localhost";
      //  $database="edsyscom_bdmoviles";
      //  $username="edsyscom";
      //  $password="HxhCyVR9k7;5(5";

        $hostname="localhost";
        $database="sistemagc";
        $username="root";
        $password="";
        $db=new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);
        return $db;
    }
}


?>