<?php
include ("cabecera_inicio.php");
include ("conectar_bd.php");

echo '<h2>Datos actuales</h2>';

$cantidad_usuarios=0;
$cantidad_usuarios_inactivos=0;
$cantidad_usuarios_activos=0;
$cantidad_usuarios_a_cero=0;
$cantidad_usuarios_a_positivo=0;
$cantidad_usuarios_a_negativo=0;
$suma_saldos_positivos=0;
$suma_saldos_negativos=0;

$con=conectar_base_datos();
$result = mysqli_query($con, "SELECT * FROM usuarios");
while($usr = mysqli_fetch_array($result))
{	   
	$saldo = $usr['COMUNES'];
	$estado = $usr['ROL'];
	
	if ($saldo<0)
	{	$suma_saldos_negativos += $saldo;
		$cantidad_usuarios_a_negativo++;
	}
	elseif ($saldo>0)
	{	$suma_saldos_positivos += $saldo;
		$cantidad_usuarios_a_positivo++;
	}
	else $cantidad_usuarios_a_cero++;

	if ($estado == 'inactivo') $cantidad_usuarios_inactivos++;
	else $cantidad_usuarios_activos++;
	     
	  $cantidad_usuarios++;
	  $balance = $suma_saldos_positivos + $suma_saldos_negativos;
}
  	echo '<table  >';

		echo '<th colspan="3">Usuarios, actividad y saldos</th>'; 

		echo '<tr><td>Número total de usuarios: <br />'.$cantidad_usuarios.'</td>';
		echo '<td>Marcados activos: <br />'.$cantidad_usuarios_activos.'</td>'; //contando los nuevos y los mc_org
		echo '<td>Marcados inactivos: <br />'.$cantidad_usuarios_inactivos.'</td></tr>';		
		echo '<tr><td>Con saldo positivo: <br />'.$cantidad_usuarios_a_positivo.'</td>';
		echo '<td>Con saldo negativo: <br />'.$cantidad_usuarios_a_negativo.'</td>';
		echo '<td>Con saldo cero: <br />'.$cantidad_usuarios_a_cero.'</td></tr>';
		echo '<tr><td>Sumatorio de saldos positivos: <br /><span style="font-size:1.5em; font-weight:bold; color:#000;">'.$suma_saldos_positivos.'</span></td>';
		echo '<td>Sumatorio de saldos negativos: <br /><span style="font-size:1.5em; font-weight:bold; color:#000;">'.$suma_saldos_negativos.'</span></td></tr>';

		echo '<tr><td><b>Balance Total: </b><br /><span style="font-size:30px; font-weight:bold; color:#080;">' . $balance . '</span></td></tr>';

	echo '</table>';
	
mysqli_close($con);
include("pie.php");
?>