<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include("config_local.php") ;

$fecha_usuario=$_GET['fecha'];
$fecha_usuario2=str_replace('/','-',$fecha_usuario);
$fecha_usuario3=strtotime($fecha_usuario2);

$con = conectar_base_datos(); 

echo '<h2>Resultado de la operación: </h2><br />';
/***************************************************************************/
$result = mysqli_query($con, "SELECT * FROM ofertas");

$cantidad1=0;
while($row = mysqli_fetch_array($result))
{
	$id_oferta=$row['ID'];
	$ruta_imagen_oferta=$row['FOTO'];
	
	$fecha_oferta=$row['FECHA'];
	$fecha_oferta2=str_replace('/','-',$fecha_oferta);
	$fecha_oferta3=strtotime($fecha_oferta2);
		
	if ($fecha_oferta3 < $fecha_usuario3)
	{

		mysqli_query($con, "DELETE FROM ofertas WHERE (ID='$id_oferta')");	
		if ($ruta_imagen_oferta!='defecto.jpg')
		{		
    	unlink($ruta_imagen_oferta);	
		$ruta_miniatura_oferta=substr($ruta_imagen_oferta,0,26).'miniatura_'.substr($ruta_imagen_oferta, 26, strlen($ruta_imagen_oferta));
    	unlink($ruta_miniatura_oferta);						
		}
		
		$cantidad1++;
	}
	
}
echo '<p align="center">Total de <b>ofertas</b> viejas borradas: <b>'.$cantidad1.'</b></p>';
/***************************************************************************/
$result = mysqli_query($con, "SELECT * FROM demandas");

$cantidad2=0;
while($row = mysqli_fetch_array($result))
{
	$id_demanda=$row['ID'];
	$ruta_imagen_demanda=$row['FOTO'];	
	
	$fecha_demanda=$row['FECHA'];
	$fecha_demanda2=str_replace('/','-',$fecha_demanda);
	$fecha_demanda3=strtotime($fecha_demanda2);
		
	if ($fecha_demanda3 < $fecha_usuario3)
	{

		mysqli_query($con, "DELETE FROM demandas WHERE (ID='$id_demanda')");	
		if ($ruta_imagen_demanda!='defecto.jpg')
		{
    	unlink($ruta_imagen_demanda);
		$ruta_miniatura_demanda=substr($ruta_imagen_demanda,0,27).'miniatura_'.substr($ruta_imagen_demanda, 27, strlen($ruta_imagen_demanda));
    	unlink($ruta_miniatura_demanda);						
		}
		
		$cantidad2++;
	}
	
}
echo '<p align="center">Total de <b>demandas</b> viejas borradas: <b>'.$cantidad2.'</b></p>';



/***************************************************************************/
mysqli_close($con);
include ("pie.php");
?>