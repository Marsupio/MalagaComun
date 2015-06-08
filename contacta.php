<?php 
include ("cabecera_index.php");
include("captcha/simple-php-captcha.php");
include ('sitio/config_local.php');

session_start();

if (!$_POST)
{
?>
	<form action="contacta.php" method="POST" accept-charset="UTF-8" lang="es">

			Tu nombre
			<input   type="text"  name="nombre"  required />
			Tu email
			<input   type="email"  name="email" required />
			Asunto
			<input  type="text"  name="asunto" required />
			Mensaje
			<textarea  rows="6" name="mensaje" required></textarea>									
			Verificación
			<input name="captcha" type="text" size="10%" maxlength="10" required />
			<?php $_SESSION['captcha'] = simple_php_captcha();
			echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" />';
			?>	
			<button type="submit" class="button">Enviar Mensaje</button>
	</form>
<?php 
}
else
{
$captcha = $_POST['captcha'];
	if ($captcha == $_SESSION['captcha']['code'])
	{
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

		echo '<br><center>Tu mensaje ha sido enviado correctamente.<br>Nos pondremos en contacto contigo lo antes posible.</center><br><a class="button" href="index.php">Haz click aqu&iacute; para volver</button></a><br><br>';	
	}
	else echo 'El código captcha introducido es incorrecto. <a href="www.malagacomun.org" onclick="history.go(-1); return false;"> VOLVER </a>';
session_unset(); // eliminar las variables de sesión
session_destroy(); 
}
include ("pie_index.php");?>