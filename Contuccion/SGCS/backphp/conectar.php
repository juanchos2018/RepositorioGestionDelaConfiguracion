<?php   

class Conexion{

    public function getConexion(){
        $hostname="localhost";
        $database="sgcs";
        $username="root";
        $password="";

        $db=new PDO("mysql:host=$hostname;dbname=$database;",$username,$password);
        return $db;
    }
}


?>