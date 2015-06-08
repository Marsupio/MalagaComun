<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");

$con=conectar_base_datos();

$orden=$_GET["orden"];
/*******************************************************************************************************/	
if ($orden=='nombre')
{
	$result = mysqli_query($con, "SELECT * FROM usuarios order by NOMBRE ASC");
	echo '<p align="center"><b>Usuarios ordenados alfabéticamente por su NOMBRE.</b></p>';

echo "<table >"; 
echo "<tr><th>Nombre</th></tr>";
$cantidad=0;
while($row = mysqli_fetch_array($result))
{
	  $nombre=$row['NOMBRE'];
	  $apellidos=$row['APELLIDOS'];
	  $email=$row['EMAIL'];
	  $telefono=$row['TELEFONO'];
	  $localizacion=$row['LOCALIZACION'];
	  	
		if ($nombre=='') { $nombre='&bull;&bull;&bull;'; }
	
	  $email=$row['EMAIL'];
	  echo "<tr ><td>" . $nombre . "<br/> <a class='button' href='mostrar_usuario.php?email=$email'>Detalles</a></td></tr>";  
	  $cantidad++;
}
echo "</table>";
/*******************************************************************************************************/	
}
elseif ($orden=='apellidos')
{
	$result = mysqli_query($con, "SELECT * FROM usuarios order by APELLIDOS ASC");
	echo '<p align="center"><b>Usuarios ordenados alfabéticamente por su APELLIDO.</b></p>';	
	
echo "<table >"; 
echo "<tr><th>Apellidos</th></tr>";
$cantidad=0;
while($row = mysqli_fetch_array($result))
{
	  $nombre=$row['NOMBRE'];
	  $apellidos=$row['APELLIDOS'];
	  $email=$row['EMAIL'];
	  $telefono=$row['TELEFONO'];
	  $localizacion=$row['LOCALIZACION'];

		if ($apellidos=='') { $apellidos='&bull;&bull;&bull;'; }
	  
	  $email=$row['EMAIL'];
	  echo "<tr ><td>" . $apellidos . "<br/> <a class='button' href='mostrar_usuario.php?email=$email'>Detalles</a></td></tr>";  
	  $cantidad++;
}
echo "</table>";
/*******************************************************************************************************/	
}

elseif ($orden=='comunes_positivos')
{
	$result = mysqli_query($con, "SELECT * FROM usuarios order by COMUNES ASC");
	echo '<p align="center"><b>Usuarios ordenados por COMUNES negativos.</b></p>';	
	
echo "<table >"; 
echo "<tr><th>Usuario</th></tr>";
$cantidad=0;
while($row = mysqli_fetch_array($result))
{
	  $id=$row['ID'];	
	  $nombre=$row['NOMBRE'];
	  $apellidos=$row['APELLIDOS'];
	  $email=$row['EMAIL'];
	  $telefono=$row['TELEFONO'];
	  $localizacion=$row['LOCALIZACION'];
  	 $comunes=$row['COMUNES'];
	  

if ($comunes=='') { $comunes='&bull;&bull;&bull;'; }
	  
echo "<tr >";
echo '<td>';	
 echo 'Usuario nº '.$id;
 echo '<br>';	
echo $nombre.' '.$apellidos;
echo '<br>';	

	
if ($comunes<0) 	
{	  
echo "<span style='font-weight:bold; color:#a00;'>" . $comunes. "<br /></span>"; 	
}
elseif ($comunes>0)	
{	  
echo "<span style='font-weight:bold; color:#080'>" . $comunes. "<br /></span>"; 		
}
else	
{	  
echo "<span style='font-weight:bold; color:#000'>" . $comunes . "<br /></span>"; 			
}
	  
	  echo "<a class='button' href='borrar_usuario.php?id=$id'>Eliminar</a>";
	  echo "&nbsp;&nbsp&nbsp;";
  	  echo "<a class='button' href='avisar_usuario.php?para=$email'>Email</a>";	  
	  
echo '</td>';	  	  
echo "</tr>";
	  
	  $cantidad++;
}
echo "</table>";
/*******************************************************************************************************/		
}
elseif ($orden=='comunes_negativos')
{
	$result = mysqli_query($con, "SELECT * FROM usuarios order by COMUNES DESC");
	echo '<p align="center"><b>Usuarios ordenados por COMUNES positivos.</b></p>';	
	
echo "<table >"; 
echo "<tr><th>Usuario</th></tr>";
$cantidad=0;
while($row = mysqli_fetch_array($result))
{
	  $id=$row['ID'];	
	  $nombre=$row['NOMBRE'];
	  $apellidos=$row['APELLIDOS'];
	  $email=$row['EMAIL'];
	  $telefono=$row['TELEFONO'];
	  $localizacion=$row['LOCALIZACION'];
  	 $comunes=$row['COMUNES'];
	  

if ($comunes=='') { $comunes='&bull;&bull;&bull;'; }
	  
echo "<tr >";
echo '<td>';	
 echo 'Usuario nº '.$id;
 echo '<br>';	
echo $nombre.' '.$apellidos;
echo '<br>';	

	
if ($comunes<0) 	
{	  
echo "<span style='font-weight:bold; color:#a00;'>" . $comunes. "<br /></span>"; 	
}
elseif ($comunes>0)	
{	  
echo "<span style='font-weight:bold; color:#080'>" . $comunes. "<br /></span>"; 		
}
else	
{	  
echo "<span style='font-weight:bold; color:#000'>" . $comunes . "<br /></span>"; 			
}
	  
	  echo "<a class='button' href='borrar_usuario.php?id=$id'>Eliminar</a>";
	  echo "&nbsp;&nbsp&nbsp;";
  	  echo "<a class='button' href='avisar_usuario.php?para=$email'>Email</a>";	  
	  
echo '</td>';	  	  
echo "</tr>";
	  
	  $cantidad++;
}
echo "</table>";
/*******************************************************************************************************/	
}

echo "<p align='center'>Total de usuarios: " .'<b>'.  $cantidad .'</b>'. " personas.</p>";
echo '<a class="button" href="usuarios.php">Pulse aquí para volver</a></p>';

include("pie.php");
mysqli_close($con);

?>