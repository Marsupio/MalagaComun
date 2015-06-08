<?php include ("cabecera_inicio.php");

$destinatario = $_GET['dest'];
if (!$_POST)
{
?>
	<form action="contactar.php?dest=<?php echo $destinatario ?>" method="POST" accept-charset="UTF-8" lang="es">

			Asunto
			<input  type="text"  name="asunto" required />
			Mensaje
			<textarea  rows="6" name="mensaje" required /></textarea>

									<div class="row">
										<div class="12u">								
											<button type="submit" class="button">Enviar Mensaje</button>
										</div>
									</div>
	</form>
<?php
}
else
{
	$remitente = $_SESSION['NOMBRE'];
	$email_remitente = $_SESSION['EMAIL'];
	$asunto = $_POST['asunto'];
	$mensaje = $_POST['mensaje'];

	$cabeceras = "MIME-Version: 1.0"."\r\n";
	$cabeceras .= "Content-type: text/html; charset=UTF-8"."\r\n";
	$cabeceras .= "From: ".$remitente."<".$email_remitente.">"."\r\n";

	$cuerpo_mensaje = "Mensaje: " . " \r\n" . " \r\n" . nl2br($mensaje) . "<br><br>";

	if ($destinatario == 'admin') $email_destinatario = 'administrador@malagacomun.org';
	else $email_destinatario = 'soporte@malagacomun.org';

	mail($email_destinatario, $asunto, $cuerpo_mensaje, $cabeceras);

	echo '<br>';
	echo '<center>Tu mensaje ha sido enviado correctamente.<br>Nos pondremos en contacto contigo lo antes posible.</center>';
	echo '<br>';
	echo '<a class="button" href="inicio.php">Haz click aqu&iacute; para volver</button></a>';
}
?>
<?php include ("pie.php");?>