<?php
include ("funciones.php");
include ("cabecera_usuarios.php");

$conexion=conectar_base_datos();
######Configuración#######                      
$tam_trozo = 10;            
##########################
	$sql = mysql_query ("SELECT * FROM pagos");
	$total = mysql_num_rows ($sql);										// numero total de registros	
	$num_paginas=$total/$tam_trozo;
	
	echo '<p id="titulo5">Encontrados '.'<b>'.$total.'</b>'.' pagos realizados.</p>';
	echo '<p align="center" >Los pagos m&aacute;s recientes de muestran primero.</p>';
	
	
	
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

$resp = mysql_query ("SELECT * FROM  pagos ORDER BY FECHA DESC LIMIT " . $desde . ", ".$tam_trozo."");

while ($fila = mysql_fetch_array ($resp)) {

	$pagador=$fila['PAGADOR'];
	$email_pagador=$fila['EMAIL_PAGADOR'];
	$titulo=$fila['TITULO'];
	$receptor=$fila['RECEPTOR'];
	$email_receptor=$fila['EMAIL_RECEPTOR'];
	$cantidad=$fila['CANTIDAD'];
	$comentario=$fila['COMENTARIO'];
	$fecha=$fila['FECHA'];
	
  	    muestra_pago($pagador,$email_pagador,$titulo,$receptor,$email_receptor,$cantidad,$comentario,$fecha);
//	  	muestra_pago_reducido($pagador,$email_pagador,$titulo,$receptor,$email_receptor,$cantidad,$comentario,$fecha);

		
}

echo '<center>';	

if ($hasta<=$total)
{
	echo 'Mostrando pagos desde el n&deg; '.'<b>'.$desde.'</b>'.' hasta el n&deg; '.'<b>'.$hasta.'</b>';
	echo '<br>';
}
else
{
	echo 'Mostrando pagos desde el n&deg; '.'<b>'.$desde.'</b>'.' hasta el n&deg; '.'<b>'.$total.'</b>';
	echo '<br>';		
}

echo 'Haga click en el n&uacute;mero de p&aacute;gina inferior para ver m&aacute;s resultados: <br> ';
if  ( ($total%$tam_trozo<$tam_trozo) and ($total%$tam_trozo!=0) )
{
	for ($pag = 1;  $pag <= $num_paginas+1 ; $pag++) 
	{
		echo "<a href=\"pagina_pagos.php?pg=".$pag."\"> ".$pag."</a>";
	}
}
else
{
	for ($pag = 1;  $pag <= $num_paginas ; $pag++) 
	{
		echo "<a href=\"pagina_pagos.php?pg=".$pag."\"> ".$pag."</a>";
	}	
}
	
echo '</center>';	

mysql_free_result($resp);
mysql_close($conexion);
include ("pie.php");
?>