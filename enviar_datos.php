<?php 
include ("sitio/conectar_bd.php");
include ("cabecera_index.php");

$email_destino = $_POST["email"];  //enviado desde recordar_contrasena.php

$con = conectar_base_datos();
//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuarios WHERE (EMAIL='$email_destino')"; 
$rs = mysqli_query($con,$ssql); 
$usr = mysqli_fetch_array($rs);
if ($usr)
{
		$datos = "Usuario: " . $usr['ALIAS'] . "<br />" . utf8_encode("Contrase�a: ") . $usr['CLAVE'] ;
		$datos=utf8_decode($datos);

		//compongo el email con esos datos
		$nombre='Administrador';
		$email=$email_admin;

		$cabeceras = "MIME-Version: 1.0"."\r\n";
		$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
		$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";

		$mensaje = "Este mensaje fue enviado por M�laga Com�n."."<br />";
		$mensaje .= "En referencia al recordatorio del nombre de usuario y contrase�a."."<br />"."<br />";
		$mensaje .=  $datos ."<br />"."<br />";

		$mensaje .= "Enviado el " . date('d/m/Y', time());
		$para = $email_destino;
		$asunto = 'Recordatorio de datos desde M�laga Com�n';

		mail($para, $asunto, $mensaje, $cabeceras);

		echo '<br>';
		echo '<br>';
		echo '<center>'.'Su mensaje ha sido enviado correctamente.<br> Guarde en lugar seguro su nombre de usuario y contrase&ntilde;a'.'</center>';
		echo '<br>';
		echo '<a class="button" href="index.php" >Haz click aqu&iacute; para volver</a>';
		echo '<br>';
		echo '<br>';
}
else 
{
		echo '<center>';
		echo '<br>';
		echo 'No existe esa direcci�n de email en la base de datos';
		echo '<br>';
		echo '<a class="button" href="recordar_contrasena.php">Pulsa aqu&iacute; para volver a intentarlo</a> ';
		echo '<br>';
		echo '<br>';
		echo '</center>';
}
include ("pie_index.php");
mysqli_close($con);
?>