<?php
include ("cabecera_administrador2.php");
include ('admin_conectar_bd.php');

$cantidad_anuncios = $_POST['cantidad_anuncios'];
$tipo_anuncios = $_POST['tipo'];

$nombre = 'Administrador de Malaga Comun';
$email = 'administrador@malagacomun.org';
$asunto = '[Málaga Común] Nuevas '.$tipo_anuncios;

//Demandas
$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";

$cuerpo_mensaje = '<hr>';
$cuerpo_mensaje .= '<h1>Boletín de nuevas '.$tipo_anuncios.'<h1/>';	
$cuerpo_mensaje .= '<hr>';
if ($tipo_anuncios == 'demandas') $cuerpo_mensaje .= "<h2>Los usuarios de Málaga Común necesitan: </h2>";
else $cuerpo_mensaje .= "<h2>Los usuarios de Málaga Común ofrecen: </h2>";

$conexion= admin_conectar_bd();
$rs = mysqli_query ($conexion, 'SELECT * FROM '.$tipo_anuncios.' ORDER BY ID DESC');
$i=0;
while ($i < $cantidad_anuncios) 
{
	$i++;
	$anuncio = mysqli_fetch_array ($rs);

	$cuerpo_mensaje .= "<b>" . $anuncio['TITULO'] . "</b> <br />";
	$cuerpo_mensaje .= $anuncio['CUERPO'] . " <br />";
	$cuerpo_mensaje .= "Email: " .$anuncio['EMAIL']. " <br />";
	$cuerpo_mensaje .= "Fecha: " . $anuncio['FECHA']. " <br />";
	$cuerpo_mensaje .= "Localidad: " .$anuncio['LOCALIZACION']. " <br />";
	$cuerpo_mensaje .= '<hr>';			
}

echo '<h3>Envío iniciado. <br>Por favor, espera un momento. <br />Comprueba el final de página para comprobar que el proceso ha terminado correctamente.</h3>';
echo '<br />';

$resp=mysqli_query ($conexion,"SELECT * FROM  usuarios WHERE ROL='activo' OR ROL='nuevo'");
$total=0;

while ($usr = mysqli_fetch_array ($resp)) 
{
	$para = $usr['EMAIL'];
	mail($para, $asunto, $cuerpo_mensaje, $cabeceras);
	$total++;			
}
echo '<h2>Proceso terminado. Se han mandado '.$total.' mensajes.</h2>';

mysqli_close ($conexion);
include("pie.php");
?>