<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");

$email=$_SESSION['EMAIL'];

$con = conectar_base_datos();
$rs = mysqli_query ($con, "SELECT * FROM usuarios WHERE EMAIL = '$email'");
$us = mysqli_fetch_array ($rs);
mysqli_close($con);

echo '<h2>Mis datos personales y de contacto</h2>';  
echo '<p>En caso de que quieras rectificar algún dato puedes hacerlo con el botón "Cambiar mis datos"</p>';

/**************   foto  ************************************************************************/

echo '<img class="bordes_redondeados" id="foto_perfil"   src="'.$us['FOTO'].'" alt="" /><br>';

/*********** tabla de datos ****************/
	
echo '<table   align="center" >';

echo '<th colspan="2">'.'Mis Datos Personales'.'</th>';      

echo '<tr><td>Nombre</td><td >'.$us['NOMBRE'].'</td></tr>';
echo '<tr> <td>Apellidos</td><td >'.$us['APELLIDOS'].'</td></tr>';
echo '<tr> <td>Teléfono</td><td>'.$us['TELEFONO'].'</td></tr>';

$email2 = str_replace('@', ' @ ', $email);
echo '<tr> <td>Email</td><td>'.$email2.'</td></tr>';

echo '<tr> <td>Localizacion</td><td >'.$us['LOCALIZACION'].'</td></tr>';
echo '<tr> <td>Código Postal</td><td >'.$us['CP'].'</td></tr>';

$servicios_prestados=obten_pagos_recibidos($email);
echo '<tr> <td>Servicios prestados</td><td >'.$servicios_prestados.'</td></tr>';
$servicios_recibidos=obten_pagos_emitidos($email);
echo '<tr> <td>Servicios recibidos</td><td >'.$servicios_recibidos.'</td></tr>';
echo '<tr><td>Saldo </td>';
	  echo '<td style="font-size:2em; color: green; font-weight: bold; " >' . $us['COMUNES'] . '</td>'; 	
echo '</tr>';
echo '<tr><td>Estado de tu cuenta</td>';
	if ($us['ROL'] == 'inactivo')
		{echo '<td style="font-size:1.5em; font-weight: bold; color: red;">INACTIVA</td>';
		}
	elseif ($us['ROL'] == 'activo')
		{echo '<td style="font-size:1.5em; font-weight: bold; color: green;">ACTIVA</td>';
		}
	elseif ($us['ROL'] == 'nuevo')
		{echo '<td style="font-size:1.5em; font-weight: bold; color: blue;">Tu cuenta está activa pero deberás realizar algún servicio para validarla. </td>';
		}
	else
		{echo '<td style="font-size:1.5em; font-weight: bold; color: green;">ACTIVA</td>';
		}
echo '</tr>';
echo "<tr > <td colspan='2' ><a class='button' href='mostrar_comentarios.php?email=$email'>Ver Comentarios</a></td></tr>";

echo '</table>';
/***************************************************************************************/
echo "<a class='button'  href='modificar_usuario.php'>Cambiar mis datos</a>";
	if ($us['ROL'] == 'inactivo')
		{echo "<a class='button' href='activacion_cuenta.php?activar=si'>Activar cuenta</a>";}
	elseif ($us['ROL'] == 'activo')
		{echo "<a class='button' href='activacion_cuenta.php?activar=no'>Desactivar cuenta</a>";}
	else  
		{} //un nuevo usuario no puede activar su cuenta. Se activará automáticamente cuando realice algún servicio. Las cuentas de la organización tampoco pueden ser desactivadas
echo "<a class='button'  href='baja.php'>Darme de baja</a>";
echo '<br/><br/>';  

include ("pie.php");
?>