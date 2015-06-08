<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");

$con=conectar_base_datos();
######Configuración###                      
$tam_trozo = 10;            
$tabla = "sugerencias";  
##########################
	$sql = mysqli_query ($con, "SELECT * FROM ".$tabla."");
	$total = mysqli_num_rows ($sql);										// numero total de registros	
	$num_paginas=$total/$tam_trozo;
	
	echo '<p align="left" >Esta página es un foro donde puedes interactuar con los demás usuarios abriendo nuevos debates o participando en los ya existentes. El objetivo principal del foro es tratar de mejorar el funcionamiento de Málaga Común en general, no sólo el de la web.</p>';

	
$pg=$_GET["pg"];		

if ($pg==1)
{
		$desde = 0;
		$hasta=$tam_trozo-1;
} 	
elseif ($pg>1)
{
	$desde = ($pg-1) * $tam_trozo;
	$hasta=$desde + $tam_trozo;
}

/*-----------------------------------------------------------------------------------------------------------*/
$resp=mysqli_query ($con, "SELECT * FROM  sugerencias ORDER BY ID DESC LIMIT " . $desde . ", ".$tam_trozo."");
while ($fila=mysqli_fetch_array ($resp)) 
	{
	$id=$fila['ID'];
	$asunto=$fila['ASUNTO'];
	$texto=$fila['TEXTO'];
	$fecha=$fila['FECHA'];
	$autor=$fila['AUTOR'];
  	muestra_sugerencia($id,$asunto,$texto,$fecha,$autor);
	}

/*------------------------------------------------------------------------------------------------------------*/

echo 'Haga click en el n&uacute;mero de p&aacute;gina inferior para ver m&aacute;s resultados: <br> ';
if  ( ($total%$tam_trozo<$tam_trozo) and ($total%$tam_trozo!=0) )
{
	for ($pag = 1;  $pag <= $num_paginas+1 ; $pag++) 
	{
		echo "<a href=\"ver_sugerencias.php?pg=".$pag."\"> ".$pag."</a>";
	}
}
else
{
	for ($pag = 1;  $pag <= $num_paginas ; $pag++) 
	{
		echo "<a href=\"ver_sugerencias.php?pg=".$pag."\"> ".$pag."</a>";
	}	
}
/*------------------------------------------------------------------------------------------------------------*/

mysqli_close($con);
include ("pie.php");
?>