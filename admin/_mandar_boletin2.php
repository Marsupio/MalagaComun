<?php
include ("cabecera_administrador2.php");
include ('funciones.php');
include ('config_local.php');

$fecha_inicio = $_GET['fecha_inicio'];
$fecha_fin = $_GET['fecha_fin'];

$fecha_inicio=str_replace('/','-',$fecha_inicio);
$fecha_inicio=strtotime($fecha_inicio);

$fecha_fin=str_replace('/','-',$fecha_fin);
$fecha_fin=strtotime($fecha_fin);

//construyo el boletin 
$conexion=conectar_base_datos();

//Ofertas 
$cuerpo_mensaje = '<hr>';
$cuerpo_mensaje .= '<h1>Boletín de Ofertas y Demandas de Málaga Común<h1/>';	
$cuerpo_mensaje .= '<hr>';
$cuerpo_mensaje .= '<h2>LISTADO DE OFERTAS: </h2>';
$cuerpo_mensaje .= '<hr>';

$rs=mysqli_query ($conexion,"SELECT * FROM  ofertas  ORDER BY ID");
while ($oferta=mysqli_fetch_array ($rs)) 
{
	$id=$oferta['ID'];
	$titulo=$oferta['TITULO'];
	$cuerpo=$oferta['CUERPO'];
	$categoria=$oferta['CATEGORIA'];
	$email=$oferta['EMAIL'];
	$localizacion=$oferta['LOCALIZACION'];

	$fecha=$oferta['FECHA'];
	$fecha2=str_replace('/','-',$fecha);	
	$fecha3=strtotime($fecha2);	


	if  (($fecha3>=$fecha_inicio) && ($fecha3<=$fecha_fin) )
	{
			$cuerpo_mensaje .= "Numero Oferta: " . $id . " <br />";
			$cuerpo_mensaje .= "Titulo:  <b>" . $titulo . "</b> <br />";
			$cuerpo_mensaje .= "Descripcion: " . $cuerpo . " <br />";
			$cuerpo_mensaje .= "Categoria: " . $categoria. " <br />";
			$cuerpo_mensaje .= "Email: " . $email. " <br />";
			$cuerpo_mensaje .= "Fecha: " . $fecha. " <br />";
			$cuerpo_mensaje .= "Localidad: " . $localizacion. " <br />";
			$cuerpo_mensaje .= '<hr>';
	}
}

//Demandas
$cuerpo_mensaje .= "<br />";	
$cuerpo_mensaje .= "<h2>LISTADO DE DEMANDAS: </h2>";
$cuerpo_mensaje .= '<hr>';

$rs=mysqli_query ($conexion,"SELECT * FROM  demandas ORDER BY ID");
while ($demanda=mysqli_fetch_array ($rs)) 
{
	$id=$demanda['ID'];
	$titulo=$demanda['TITULO'];
	$cuerpo=$demanda['CUERPO'];
	$categoria=$demanda['CATEGORIA'];
	$email=$demanda['EMAIL'];

	$fecha=$demanda['FECHA'];
	$fecha2=str_replace('/','-',$fecha);
	$fecha3=strtotime($fecha2);	

	$localizacion=$demanda['LOCALIZACION'];

	if  (($fecha3>=$fecha_inicio) && ($fecha3<=$fecha_fin) )
	{
			$cuerpo_mensaje .= "Numero Demanda: " . $id . " <br />";
			$cuerpo_mensaje .= "Titulo: <b>" . $titulo . "</b> <br />";
			$cuerpo_mensaje .= "Descripcion: " . $cuerpo . " <br />";
			$cuerpo_mensaje .= "Categoria: " . $categoria. " <br />";
			$cuerpo_mensaje .= "Email: " . $email. " <br />";
			$cuerpo_mensaje .= "Fecha: " . $fecha. " <br />";
			$cuerpo_mensaje .= "Localidad: " . $localizacion. " <br />";
			$cuerpo_mensaje .= '<hr>';			
	}
}
echo '<h3>Se está enviando el boletín de ofertas y demandas a los usuarios. <br>Por favor, espere un momento. <br />Compruebe el final de página para comprobar que el proceso ha terminado correctaamente.</h3>';
echo '<br />';

$nombre = 'Administrador de Malaga Comun';
$email = $email_admin;
$asunto = '[Málaga Común] Nuevas Ofertas y Demandas';

$resp=mysqli_query ($conexion,"SELECT * FROM  usuarios WHERE ROL='activo'");
$total=0;

while ($fila=mysqli_fetch_array ($resp)) 
{
	$para=$fila['EMAIL'];

	mandar_email($nombre,$email,utf8_encode($asunto),$cuerpo_mensaje,$para);	
	$total++;			
}

echo '<h2>Proceso terminado. Se han mandado '.$total.' boletines.</h2>';

mysqli_close ($conexion);

include("pie.php");
?>