<?php
include ("cabecera_inicio.php");
include ('funciones.php');
$con=conectar_base_datos();
######Configuración#######                      
$tam_trozo = 20;            
##########################
$sql=mysqli_query($con, "SELECT * FROM pagos");
$total = mysqli_num_rows ($sql);											// numero total de registros	
$num_paginas=$total/$tam_trozo;

echo '<h2>Listado de transacciones</h2>';
echo '<p align="center">Encontradas '.'<span style="font-size:1.3em;">'.$total.'</span>'.' transacciones realizadas</p>';

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
echo " <table> ";

$resp=mysqli_query ($con, "SELECT * FROM pagos ORDER BY ID DESC LIMIT ".$desde.", ".$tam_trozo."");
while($pago = mysqli_fetch_array($resp))
{
		muestra_pago($pago);				
}
echo '</table';

echo '<span align="center">Haga click en el número de página inferior para ver más resultados:</span><br />';
if  ( ($total%$tam_trozo<$tam_trozo) and ($total%$tam_trozo!=0) )
{
	for ($pag = 1;  $pag <= $num_paginas+1 ; $pag++) 
	{
		if ($pag%10==0)
		{
			echo '<br>';
		}		
		echo "<a class='num_pagina' href=\"lista_transacciones.php?pg=".$pag."\">&nbsp;".$pag."&nbsp;</a>";
	}
}
else
{
	for ($pag = 1;  $pag <= $num_paginas ; $pag++) 
	{
		echo "<a href=\"lista_transacciones.php?pg=".$pag."\"> ".$pag."</a>";
	}	
}
echo "<br><br>";
if ($pg>1) echo "<a href=\"lista_transacciones.php?pg=".($pg-1)."\">Página Anterior</a>&emsp;&emsp;";
echo "<a href=\"lista_transacciones.php?pg=".($pg+1)."\">Página Siguiente</a>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
include ('pie.php');
mysqli_close($con);
?>