<?php    // OBSOLETA: A ELIMINAR


include ("cabecera_index.php");
include ('sitio/config_local.php');

$nombre = $_POST['nombre'];
$asunto = $_POST['asunto'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=UTF-8"."\r\n";
$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";

$cuerpo_mensaje = "Este mensaje fue enviado por: " . $nombre ."<br>";
$cuerpo_mensaje .= "En referencia a: " . $asunto . "<br>";
$cuerpo_mensaje .= "Su e-mail es: " . $email . "<br><br>";
$cuerpo_mensaje .= "Mensaje: " . " \r\n" . " \r\n" . nl2br($mensaje) . "<br><br>";
$cuerpo_mensaje .= "Enviado el " . date('d/m/Y', time());

$asunto = 'Consulta desde Málaga Común';

$para = $email_admin;  //EMAIL DEL ADMINISTRADOR ACTUAL					

mail($para, utf8_encode($asunto), $cuerpo_mensaje, $cabeceras);

echo '<br>';
echo '<center>Tu mensaje ha sido enviado correctamente.<br>Nos pondremos en contacto contigo lo antes posible.</center>';
echo '<br>';
echo '<a class="button" href="index.php">Haz click aqu&iacute; para volver</button></a>';
echo '<br>';
echo '<br>';

include("pie_index.php");
?>