<?php 
include ("cabecera_inicio.php");

$email_dest = $_GET["para"];
$anuncio = $_GET['anuncio'];

if (!$_POST)
{
	$anuncio = '';
	$destinatario=$_GET["nombre_completo"];
	echo "<h2 align='left'>Enviar mensaje a $destinatario</h2>";
?>
<form action="responder_anuncio.php?para=<?php echo $email_dest ?>" method="POST"  accept-charset="UTF-8">

	<br/>
	<textarea id="formulario" name="mensaje"  rows="4" required ></textarea><br />
	<button class="button" type="submit">Enviar</button>

</form>
<?php
}
else
{
	$nombre = $_SESSION['NOMBRE'];
	$apellidos = $_SESSION['APELLIDOS'];
	$email = $_SESSION['EMAIL'];
	$mensaje = $_POST['mensaje'];

	$cabeceras = "MIME-Version: 1.0"."\r\n";
	$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
	$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";
	$cabeceras .= "Sender: no-reply@malagacomun.org"."\r\n";
	
	$cuerpo_mensaje = "[Este mensaje fue enviado por ".$nombre." ".$apellidos." <".$email."> desde la web de Málaga Común]<br><br>";
	$cuerpo_mensaje .= "<b>Mensaje: </b><br>" . " \r\n" . " \r\n" . $mensaje . "<br><br>";
	$cuerpo_mensaje .= "Enviado el " . date('d/m/Y', time());

	$asunto = '[Malaga Comun] A alguien le interesa tu anuncio '.$anuncio;

	mail($email_dest, $asunto, $cuerpo_mensaje, $cabeceras);
	
	echo 'Tu mensaje ha sido enviado correctamente<br>';
	echo '<a class="button" href="tablon_anuncios.php">Haz click aquí para volver</a>';
} 
include("pie.php"); ?>