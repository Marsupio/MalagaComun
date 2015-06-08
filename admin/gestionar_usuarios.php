<?php
include ("funciones.php");
include ("cabecera_administrador2.php");

echo '<br/>';
echo '<h2>Lista completa de usuarios registrados en el sistema.</h2>';
echo '<p>(Seleccione alguna acción a realizar en la columna de la derecha si lo cree oportuno)</p>';

$con=conectar_base_datos();
$result = mysqli_query($con, "SELECT * FROM usuarios order by ID");

echo "<table > 

<tr>

<th>ID</th>
<th>Datos Personales</th>


</tr>";

$cantidad=0;
while($row = mysqli_fetch_array($result))
{
	$id=$row['ID'];
	$email=$row['EMAIL'];
	$email2 = str_replace('@', ' @ ', $email);
	  
	
	  echo "<tr >";
	  
	  echo "<td>" . $id . "</td>";
	  
	  echo "<td>" . $row['NOMBRE'] ."<br />". $row['APELLIDOS'] . "<br />". $row['TELEFONO'] . "<br />" .$email2;
	  
/*********************************/	  
	$comunes=$row['COMUNES'];
	
	echo '<br />';
	if ($comunes<0)
	{
	  echo '<span style=" font-weight:bold; color:#a00;">' . $row['COMUNES'] . '</span>'; 
	}
	elseif ($comunes>0)
	{
	  echo '<span style="font-weight:bold; color:#080">' . $row['COMUNES'] . '</span>'; 	
	}
	else
	{
	  echo '<span style="font-weight:bold; color:#000">' . $row['COMUNES'] . '</span>'; 			
	}
/************************************/	  
	echo ' comunes';

	echo '<br>';
	
	  echo "<a class='button' href='borrar_usuario.php?id=$id'>Eliminar</a>";
	  echo "&nbsp;&nbsp&nbsp;";
  	  echo "<a class='button' href='avisar_usuario.php?para=$email'>Email</a>";

	echo "</td>";
	      
	  
	  $cantidad++;
  	  echo "</tr>";

}
echo "</table>";

echo "<p align='center'>Total de usuarios: " .'<span style=" font-weight:bold; font-size:1.5em; color:black;">'.  $cantidad .'</span>'. " personas.</p>";
echo '<p align="center"><a class="button" href="gestionar_usuarios.php">Pulse aquí para volver al principio de la lista</a></p>';

include("pie.php");
mysqli_close($con);

?>
