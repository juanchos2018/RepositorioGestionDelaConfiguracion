<?PHP

//	$documento = $_POST["documento"];
//	$nombre    = $_POST["nombre"];
//	$profesion = $_POST["profesion"];
//	$imagen    = $_POST["imagen"];//
//	$path = "imagenes/$nombre.jpg";

$destino="jcarlossenati@gmail.com";
$nombre=$_POST["nombre"];
$correo=$_POST["correo"];
$telefeno=$_POST["telefono"];
$mensaje=$_POST["mensaje"];
$contenido="Nombre ". $nombre ."\nCorreo:  ". $correo ."\ntelefono " . $telefono . "\nMensaje :" . $mensaje;

//mail($destino,"contacto",$contenido);
if(mail($destino,"contacto",$contenido)){
    echo "registra";
}else{
    echo "noRegistra";
}
	
	
?>

