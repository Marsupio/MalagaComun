<?php
include ("funciones.php");
include ("cabecera_inicio.php");

$conexion=conectar_base_datos();

$alias=$_SESSION['ALIAS'];
$clave=$_SESSION['CLAVE'];

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuarios WHERE ((ALIAS='$alias')&&(CLAVE='$clave'))"; 
//Ejecuto la sentencia 
$rs = mysql_query($ssql,$conexion); 

/////////////////// muestro los datos personales de ese usuario //////////////////////////////////

if (mysql_num_rows($rs)!=0)
{ 
  $row = mysql_fetch_array($rs); 
  
  $id=$row['ID'];
  $nombre=$row['NOMBRE'];
  $apellidos=$row['APELLIDOS'];
  $telefono=$row['TELEFONO'];
  $email=$row['EMAIL'];
  $comunes=$row['COMUNES'];
  $localizacion=$row['LOCALIZACION'];
  $foto=$row['FOTO']; 
  $cp=$row['CP']; 
  
echo '<h2>Mis datos personales y de contacto</h2>';  
echo '<p>En caso de que quieras rectificar algún dato puedes hacerlo con el botón "Cambiar mis datos" o "Cambiar mi fotografía".</p>';

/**************   foto  ************************************************************************/

echo 'Mi foto de perfil'; 
echo '<br />';     
echo '<img class="bordes_redondeados" id="foto_perfil"   src="'.$foto.'" alt="" />';
echo '<br />';     
echo "<a class='button' href='modificar_foto.php?email=$email'>Cambiar mi fotografía</a>";
echo '<br />';

/*********** tabla de datos ****************/
	
echo '<table   align="center" >';

echo '<th colspan="2">'.'Mis Datos Personales'.'</th>';      

echo '<tr><td>Nombre</td><td >'.$nombre.'</td></tr>';
echo '<tr> <td>Apellidos</td><td >'.$apellidos.'</td></tr>';
echo '<tr> <td>Teléfono</td><td>'. $telefono.'</td></tr>';

$email2 = str_replace('@', ' @ ', $email);
echo '<tr> <td>Email</td><td>'.$email2.'</td></tr>';

echo '<tr> <td>Localizacion</td><td >'.$localizacion.'</td></tr>';
echo '<tr> <td>Código Postal</td><td >'.$cp.'</td></tr>';
/*********************************/	  	
$reputacion=calcula_reputacion($email);

echo '<tr><td>Reputacion </td>';

if ($reputacion !="Este usuario aún no ha participado")
{
	
	if ($reputacion<=3) 
	{
	  echo '<td style="color: red; font-weight: bold; text-shadow: 1px 1px 1px grey;" >' . round($reputacion,2). '/10</td>'; 
	}
	elseif ($reputacion>=7)
	{
	  echo '<td style="color: green; font-weight: bold; text-shadow: 1px 1px 1px grey;">' . round($reputacion,2). '/10</td>'; 	
	}
	else
	{
	  echo '<td style="color: black; font-weight: bold; text-shadow: 1px 1px 1px grey;" >' . round($reputacion,2) . '/10</td>'; 			
	}

}
else
{
	  echo '<td style="font-size:1em; font-weight:bold; color:#000; text-shadow: 0px 0px #aaa;">'.$reputacion.'</td>'; 			  
}

echo '</tr>';
/*****************************************/
$intercambios=obten_pagos_recibidos($email);
echo '<tr> <td>Intercambios realizados</td><td >'.$intercambios.'</td></tr>';

/************************************/	
echo '<tr><td>Comunes </td>';
	if ($comunes<0)
	{
	  echo '<td  style="font-size:2em; color:red; font-weight: bold; text-shadow: 1px 1px 1px grey;" >' . $row['COMUNES'] . '</td>'; 
	}
	elseif ($comunes>0)
	{
	  echo '<td style="font-size:2em; color: green; font-weight: bold; text-shadow: 1px 1px 1px grey;" >' . $row['COMUNES'] . '</td>'; 	
	}
	else
	{
	  echo '<td style="font-size:2em; color: black; font-weight: bold; text-shadow: 1px 1px 1px grey;" >' . $row['COMUNES'] . '</td>'; 	
	}
echo '</tr>';
/************************************/
 echo "<tr > <td colspan='2' ><a class='button' href='mostrar_comentarios.php?email=$email'>Ver Comentarios</a></td></tr>";
 
	
echo '</table>';
/***************************************************************************************/

echo "<a class='button'  href='modificar_usuario.php?email=$email'>Cambiar mis datos</a>";
echo '<br/><br/>';  
} 
else 
{
  echo '<br/><p align="center">Salga del sistema y vuelva a introducir su nombre de usuario y contraseña por motivos de seguridad.<br> Gracias.</p><br><br>';

} 

echo '<p align="justify" >Tu reputación varía dependiendo de tu comportamiento e interacción con el resto de usuarios, y puede ser positiva o negativa. Una reputación por debajo de 5 se considera mala hasta un mínimo de 0 que es la peor, mientras que por encima de 5 se considera buena hasta un máximo de 10 que es la mejor posible.</p>';

mysql_close($conexion);
include ("pie.php");
?>