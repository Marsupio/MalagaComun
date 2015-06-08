<?php 
include ("funciones.php");
include ("cabecera_inicio.php");
/********************************************************/

$nombre = $_SESSION['NOMBRE'];
$email = $_SESSION['EMAIL'];
$asunto = 'Mensaje de un usuario de Málaga Común';
$mensaje = $_POST['mensaje'];
$para=$_GET['para'];

$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";

//comprobamos si todos los campos fueron completados
if ($mensaje!='') 
{
// si es asi armamos el mensaje
$cuerpo_mensaje = "Este mensaje fue enviado por: " . $nombre ."<br>";
$cuerpo_mensaje .= "En referencia a: " . $asunto . "<br>";
$cuerpo_mensaje .= "Su e-mail es: " . $email . "<br><br>";
$cuerpo_mensaje .= "Mensaje: " . " \r\n" . " \r\n" . $mensaje . "<br><br>";
$cuerpo_mensaje .= "Enviado el " . date('d/m/Y', time());

$asunto = '[Malaga Comun] A alguien le interesa tu anuncio';

// si todos los campos fueron completados enviamos el mail
mail($para, $asunto, $cuerpo_mensaje, $cabeceras);
 
echo 'Tu mensaje ha sido enviado correctamente<br>';
// echo '<a class="button" href="anuncios.php">Haz click aquí para volver</a>';

} 

/********************************************************/
include("pie.php");
?>