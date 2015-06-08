<?php
include ("funciones.php");
include ("cabecera_inicio.php");

echo '<br />';
echo '<p align="center">Aquí puedes pagar a un usuario buscando el ID del anuncio al que respondiste.<br/> El ID es el número de anuncio que aparece en la primera columna de la izquierda.</p>';

$conexion=conectar_base_datos();

	
//////////Sentencia SQL para buscar todas las ofertas  ////////////////
$ssql2 = "SELECT * FROM ofertas ORDER BY ID DESC"; 
$rs2 = mysql_query($ssql2,$conexion); 

//////////////////////////// Muestro las DEMANDAS de ese usuario //////////////////////////////////////////
echo '<p align="center" style=" color:#000; font-size:20px;">'.'Ofertas'.'</p>'; 

echo " <table id='tabla_anuncio' align='center'> 

<tr>

<th>ID </th>
<th>Título</th>
<th>Usuario</th>
<th>Email</th>
<th colspan='2'>Acciones</th>

</tr>";

while($row2 = mysql_fetch_array($rs2))
  {
	$id=$row2[0];
	$titulo=$row2[1];
	$email=$row2[4];
	
  	  
  echo "<tr>";
  echo "<td>" . $id . "</td>";
  echo "<td>" . $titulo . "</td>";
/**************************************************/
	$rs5 = mysql_query("SELECT * FROM usuarios WHERE EMAIL='$email'",$conexion);
	$fila=mysql_fetch_array($rs5);
	$nombre=$fila[1];
	$apellidos=$fila[2];
	$usuario=$nombre.' '.$apellidos; 

    echo "<td>" . $usuario . "</td>";  
/**************************************************/  
  echo "<td>" . $email . "</td>";
  
  echo "<td colspan='2'> 
  <a href='rellenar_pago_anuncio.php?id=$id&titulo=$titulo&usuario=$usuario&email=$email'><button>Pagar</button></a></td>"; 

  echo "</tr>";
  
  }
echo "</table>";
echo '<br>';
echo '<br>';

//////////////////////////// Muestro las DEMANDAS de ese usuario //////////////////////////////////////////
  echo '<p align="center" style=" color:#000; font-size:20px;">'.'Demandas'.'</p>';      

	
//Sentencia SQL para buscar las demandas publicadas por ese usuario 
$ssql2 = "SELECT * FROM demandas ORDER BY ID DESC"; 
$rs2 = mysql_query($ssql2,$conexion); 

echo " <table id='tabla_anuncio' align='center'> 

<tr>

<th>ID </th>
<th>Título</th>
<th>Usuario</th>
<th>Email</th>
<th colspan='2'>Acciones</th>

</tr>";

while($row2 = mysql_fetch_array($rs2))
  {
	$id=$row2[0];
	$titulo=$row2[1];
	$email=$row2[4];
	
  	  
  echo "<tr>";
  echo "<td>" . $id . "</td>";
  echo "<td>" . $titulo . "</td>";
/**************************************************/
	$rs5 = mysql_query("SELECT * FROM usuarios WHERE EMAIL='$email'",$conexion);
	$fila=mysql_fetch_array($rs5);
	$nombre=$fila[1];
	$apellidos=$fila[2];
	$usuario=$nombre.' '.$apellidos; 

    echo "<td>" . $usuario . "</td>";  
/**************************************************/  
  echo "<td>" . $email . "</td>";
  
  echo "<td colspan='2'> 
  <a href='rellenar_pago_anuncio.php?id=$id&titulo=$titulo&usuario=$usuario&email=$email'><button>Pagar</button></a></td>"; 
  
  echo "</tr>";
  
  }
echo "</table>";

echo '<br>';
echo '<br>';    

/****************************************/
mysql_close($conexion);

include ("pie.php");
?>