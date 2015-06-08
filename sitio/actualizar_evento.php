<?php
include ("funciones.php");
include ("cabecera_administrador2.php");

$conexion=conectar_base_datos();

if ($_POST)
{
	//inserto el evento modificado en la tabla de demandas deacuerdo a su ID

	$id=$_GET["id"];
		
	$evento=$_POST["evento"];
	$lugar=$_POST["lugar"];
	$fecha=$_POST["fecha"];
	$inicio=$_POST["inicio"];
	$fin=$_POST["fin"];
	$notas=$_POST["notas"];

	mysql_query("update eventos set EVENTO='$evento', LUGAR='$lugar', FECHA='$fecha', INICIO='$inicio', FIN='$fin', NOTAS='$notas' where ID='$id' ");
	

echo'<h2>Se ha modificado correctamente el evento.</h2>';
echo '<p align="center"><br /><a class="button"  href="administrar_eventos.php">Pulse aquí para volver</a></p>';


}
else
{
	echo '<p align="center" style="font-size:16px;">No ha efectuado ningún cambio.</p>';	
}

mysql_close($conexion);
include ("pie.php");
?>