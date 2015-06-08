<?php
include ("funciones.php");
include ("cabecera_administrador2.php");

if (!$_POST)
{	
	echo '<p align="center">Por favor, rellene correctamente todos los campos.</p>';
}


if ($_POST)
{	
//inserto el evento en la tabla de eventos
	$evento=$_POST["evento"];
	$lugar=$_POST["lugar"];
	$fecha=$_POST["fecha"];
	$hora=$_POST["hora"];
	$notas=$_POST["notas"];

	if (($evento=='') or ($lugar=='') or ($fecha==''))
	{
		echo '<h2>Rellene correctamente todos los datos.</h2>';
		echo '<a class="button" href="crear_evento.php">Volver a intentarlo</a>';
	}
	else
	{
	// me conecto a la base de datos
	$conexion=conectar_base_datos();
	mysql_query("insert into eventos (EVENTO, LUGAR, FECHA, INICIO, NOTAS) values ('$evento', '$lugar', '$fecha', '$hora', '$notas')");
	mysql_close($conexion);	
	
	echo'<p align="center" style=" font-weight:bold; font-size:17px; color:#57036C;">Se ha includo el evento a la fecha y hora indicadas.</p>';
	}
	
}

include ("pie.php");
?>