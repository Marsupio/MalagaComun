<?php
include ("funciones.php");
include ("cabecera_usuarios.php");

echo '<br/>';
echo '<p align="center" style="font-weight:bold; font-size:18px;" class="texto_sombreado">Balance Global</p>';

$conexion=conectar_base_datos();

$result = mysql_query("SELECT * FROM usuarios");

$cantidad_usuarios=0;
$cantidad_usuarios_a_cero=0;
$cantidad_usuarios_a_positivo=0;
$cantidad_usuarios_a_negativo=0;

$comunes_positivos=0;
$comunes_negativos=0;
while($row = mysql_fetch_array($result))
{	  
/*********************************/	  
	$comunes=$row['COMUNES'];
	
	if ($comunes<0)
	{
		$comunes_negativos=$comunes_negativos+$comunes;
		$cantidad_usuarios_a_negativo++;
	}
	elseif ($comunes>0)
	{
		$comunes_positivos=$comunes_positivos+$comunes;
		$cantidad_usuarios_a_positivo++;
	}
	else
	{
		$cantidad_usuarios_a_cero++;
	}
/**********************************/	  
	   
	  $cantidad_usuarios++;
	  $balance=$comunes_positivos+$comunes_negativos;

}
  	echo '<table id="tabla_balance" align="center" >';

	echo '<th>Concepto</th><th>Cantidades</th>'; 

	echo '<tr><td >Número total de usuarios: </td>'.'<td>'.$cantidad_usuarios.'</td></tr>';
	echo '<tr><td>Número de usuarios con cero comunes: </td>'.'<td>'.$cantidad_usuarios_a_cero.'</td></tr>';
	echo '<tr><td>Número de usuarios con comunes negativos: </td>'.'<td>'.$cantidad_usuarios_a_negativo.'</td></tr>';
	echo '<tr><td>Número de usuarios con comunes positivos: </td>'.'<td>'.$cantidad_usuarios_a_positivo.'</td></tr>';
	echo '<tr><td>Total de comunes negativos: </td>'.'<td>'.$comunes_negativos.'</td></tr>';
	echo '<tr><td>Total de comunes positivos: </td>'.'<td>'.$comunes_positivos.'</td></tr>';
	echo '<tr><td><b>Balance Total: </b></td>';

/*********************************/		
	if ($balance<0)
	{
	  echo '<td style="font-size:30px; font-weight:bold; color:#a00;">' . $balance . '</td>'; 
	}
	elseif ($balance>0)
	{
	  echo '<td style="font-size:30px; font-weight:bold; color:#080;">' . $balance . '</td>'; 	
	}
	else
	{
	  echo '<td style="font-size:30px; font-weight:bold; color:#000;">' . $balance . '</td>'; 			
	} 	
/************************************/	
	echo '</tr>';

	echo '</table>';

echo '<br>';
include("pie.php");
mysql_close($conexion);

?>

