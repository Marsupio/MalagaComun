<?php
include ('cabecera_administrador.php');
include ('funciones.php');
$conexion=conectar_base_datos();
######Configuración#######                      
$tam_trozo = 20;            
##########################
$sql=mysql_query("SELECT * FROM pagos",$conexion);
$total = mysql_num_rows ($sql);											// numero total de registros	
$num_paginas=$total/$tam_trozo;

echo '<br>';
echo '<h3 align="center">Lista simplificada de pagos realizados.</h3>';
echo '<p align="center">Encontrados '.'<b>'.$total.'</b>'.' pagos realizados.</p>';

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
/////////////////////// muestra los datos consultados ////////////////////////////////////////////////////////////////
echo " <table align='center' border='3px solid #000' style='border-collapse:collapse' width='95%'> ";

$resp=mysql_query ("SELECT * FROM pagos LIMIT ".$desde.", ".$tam_trozo."");
while($row = mysql_fetch_array($resp))
{
		$pagador=$row['PAGADOR'];
		$email_pagador=$row['EMAIL_PAGADOR'];
		$titulo=$row['TITULO'];
		$receptor=$row['RECEPTOR'];
		$email_receptor=$row['EMAIL_RECEPTOR'];
		$cantidad=$row['CANTIDAD'];
		$comentario=$row['COMENTARIO'];
		$fecha=$row['FECHA'];	
	
		muestra_pago_reducido($pagador,$email_pagador,$titulo,$receptor,$email_receptor,$cantidad,$comentario,$fecha);
			
}
echo '</table';
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ($hasta<=$total)
{
echo '<br><br>';
echo '<p align="center">Mostrando pagos desde el n&deg; '.'<b>'.$desde.'</b>'.' hasta el n&deg; '.'<b>'.$hasta.'</b></p>';
}
else
{
echo '<p align="center">Mostrando pagos desde el n&deg; '.'<b>'.$desde.'</b>'.' hasta el n&deg; '.'<b>'.$total.'</b></p>';
}
echo '<p align="center">Haga click en el n&uacute;mero de p&aacute;gina inferior para ver m&aacute;s resultados:</p>';

echo '<center>';
if  ( ($total%$tam_trozo<$tam_trozo) and ($total%$tam_trozo!=0) )
{
	for ($pag = 1;  $pag <= $num_paginas+1 ; $pag++) 
	{
		echo "<a href=\"consulta1_administrador.php?pg=".$pag."\"> ".$pag."</a>";
	}
}
else
{
	for ($pag = 1;  $pag <= $num_paginas ; $pag++) 
	{
		echo "<a href=\"consulta1_administrador.php?pg=".$pag."\"> ".$pag."</a>";
	}	
}
echo '</center>';
echo '<br>';
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
include ('pie.php');
//cierro la conexion
mysql_close($conexion);
?>