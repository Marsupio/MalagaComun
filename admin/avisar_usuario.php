<?php 
include ("funciones.php");
include ('config_local.php');
include ("cabecera_administrador2.php");
/********************************************************/


if ( $_POST )
{
	
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$para=$_GET['para'];


$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$nombre."<".$email_admin.">"."\r\n";

//comprobamos si todos los campos fueron completados
if ($nombre!='' && $email!='' && $asunto!='' && $mensaje!='') 
{
// si es asi armamos el mensaje
$mensaje = '<h2>'.utf8_decode('Aviso importante desde Málaga Común').'</h2>';
$mensaje .= "Este mensaje fue enviado por: " . $nombre . " <br>";
$mensaje .= "En referencia a: " . utf8_decode($asunto) . " <br>";
$mensaje .= "Su e-mail es: " . $email_admin . " <br>";
$mensaje .= "Mensaje: " . " <br><br><b>" . utf8_decode($_POST['mensaje']) . "</b><br><br>";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$asunto= utf8_decode('Mensaje del administrador de Málaga Común');


// si todos los campos fueron completados enviamos el mail
mail($para, $asunto, $mensaje, $cabeceras);
echo '<br>';
echo '<h2>Su mensaje ha sido enviado correctamente. </h2><br>Ahora es el usari@ quien ha de responder si muestra algún interés.';
echo '<br>';
echo '<a class="button" href="gestionar_usuarios.php">Haz click aquí para volver</a> ';
echo '<br>';

} else {
//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
echo '<br>';
echo '<center>"Por favor, rellene todos los campos antes de enviar su mensaje. Gracias."</center>';
echo '<br>';
echo '<center> <a href="gestionar_usuarios.php"> <br><br> <button>Pulse aquí para volver a intentarlo</button></a> <center>';
echo '<br>';

}

}
else
{

$para=$_GET['para'];

?>

<br />
<h2>Escriba al usuario lo que considere oportuno.</h2>

<form action="avisar_usuario.php?para=<?php echo $para ?>" method="POST"  accept-charset="UTF-8">

<input  name="nombre" type="hidden"  size="65%"  maxlength="200" placeholder="Administrador" value="Administrador"  required /> 

Para
<input  type="text"  size="65%" maxlength="200" placeholder="<?php echo $para ?>" readonly /> 

Asunto
<input  name="asunto" type="text"  size="65%" maxlength="200" placeholder="Motivo del E-mail" required /> 

<input  name="email" type="hidden"  size="65%" maxlength="200" placeholder="Málaga Común" value="Málaga Común" required />

<br />
Mensaje
<textarea  name="mensaje" cols="66%" rows="10" placeholder="Escriba aquí los detalles..." required /></textarea>

<br />
<button class="button" type="reset">Borrar</button>	   
<button class="button" type="submit">Enviar email al usuario</button>	

</form>
<br />
<?php
}

/********************************************************/
include("pie.php");
?>