<?php 
include ("funciones.php");
include ("cabecera_contactar.php");

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";

//comprobamos si todos los campos fueron completados
if ($nombre!='' && $email!='' && $asunto!='' && $mensaje!='') 
{
// si es asi armamos el mensaje
$cuerpo_mensaje = "Este mensaje fue enviado por: " . $nombre ."<br>";
$cuerpo_mensaje .= "En referencia a: " . $asunto . "<br>";
$cuerpo_mensaje .= "Su e-mail es: " . $email . "<br><br>";
$cuerpo_mensaje .= "Mensaje: " . " \r\n" . " \r\n" . nl2br($mensaje) . "<br><br>";
$cuerpo_mensaje .= "Enviado el " . date('d/m/Y', time());

$asunto = 'Consulta desde Málaga Común';

$para = 'chapmanbright@googlemail.com';					//cambiar esto despues: email de destino...


// si todos los campos fueron completados enviamos el mail
$flag='ok';
mail($para, $asunto, $cuerpo_mensaje, $cabeceras);
echo '<br>';
echo '<center>Su mensaje ha sido enviado correctamente.<br>Nos pondremos en contacto con usted lo antes posible.</center>';
echo '<br>';
echo '<center> <a href="inicio.php"> <br><button>Haz click aqu&iacute; para volver</button></a> </center>';
echo '<br>';
echo '<br>';

} else {
//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
$flag='err';
echo '<br>';
echo '<center>Por favor, rellene todos los campos antes de enviar su mensaje. Gracias.</center>';
echo '<br>';
echo '<center> <a href="contactar.php"> <br>Pulse aqu&iacute; para volver a intentarlo</a> </center>';
echo '<br>';
echo '<br>';

}

include("pie.php");

?>