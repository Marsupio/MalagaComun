<?php
include ("funciones.php");
include ("cabecera_usuarios.php");


$conexion=conectar_base_datos();

	$sql = mysql_query ("SELECT * FROM usuarios");
	$total = mysql_num_rows ($sql);										// numero total de registros	

	$maximo=mysql_query ("SELECT * FROM usuarios order by ID desc limit 1");
	$row5 = mysql_fetch_array($maximo);
	$maxid=$row5['ID'];
//	echo $maxid;

	echo '<p id="titulo5">Encontrados '.'<b>'.$total.'</b>'.' usuarios en total.</p>';

$pg=$_GET["pg"];	
$tam_trozo = 10;            
$num_paginas=$maxid/$tam_trozo;
$num_paginas=$num_paginas+1;	


	$desde = ($pg-1) * $tam_trozo;
	$hasta=$desde + $tam_trozo;

	echo "<table id='tabla_usuarios' align='center'>"; 

	echo " <tr>
	<th width='8%'>ID</th>
	<th width='30%'>Nombre y Apellidos</th>
	<th width='12%'>Tel&eacute;fono</th>
	<th width='30%'>E-Mail</th>
	<th width='10%'>Comunes</th>
	<th width='10%'>Detalles</th>
	</tr>";	
	
	echo '</table>';


		for ($id=$desde; $id<=$hasta; $id++)
		{
				muestra_usuario_por_id($id);
		}	

	echo '<br>';
/****************************************************************************************************************/
echo '<center>';	

echo 'Mostrando usuarios con ID entre '.$desde.' y  '.$hasta;
echo '<br>';

echo 'Haga click en el n&uacute;mero de p&aacute;gina inferior para ver m&aacute;s resultados: <br> ';

	for ($pag = 1;  $pag <= $num_paginas ; $pag++) 
	{
		echo "<a href=\"pagina_usuarios.php?pg=".$pag."\"> ".$pag."</a>";
	}	

echo '</center>';	
/******************************************************************************************/
include ("pie.php");
mysql_close($conexion);
?>