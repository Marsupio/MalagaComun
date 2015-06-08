<?php
include ("funciones.php");
include ("cabecera_inicio.php");

/************************************************************************************************/
$conexion=conectar_base_datos();

// muestro el calendario
$rs1 = mysql_query("SELECT * FROM eventos",$conexion); 


$eventos=array();
$i=0;
while($fila = mysql_fetch_array($rs1))
{
	$eventos[$i]=$fila['FECHA'];
	$i++;
}

// Muestro las eventos
echo '<h2>Listado de eventos programados.</h2><br/>';      

	
//Sentencia SQL para buscar los eventos
$ssql2 = "SELECT * FROM eventos ORDER BY FECHA"; 

//Ejecuto la sentencia 
$rs2 = mysql_query($ssql2,$conexion); 


echo " <table   align='center'> 

<tr>

<th>Evento(s) programado(s) </th>


</tr>";

$cantidad=0;
while($row2 = mysql_fetch_array($rs2))
  {
	  $id=$row2['ID'];
	  $evento=$row2['EVENTO']; 
	  $lugar=$row2['LUGAR']; 
	  $fecha=$row2['FECHA'];
	  $fecha_eur=implode('-', array_reverse(explode('-', $fecha))); 
	  $inicio=$row2['INICIO']; 
	  $notas=$row2['NOTAS'];
	    	  
  echo "<tr><td><span style='font-weight:bold; color: black;'> " . $evento . "</span><br />Lugar:  " . $lugar . "<br />Fecha:  <span style='font-weight:bold; color: black;'> " . $fecha_eur . "</span><br />Hora inicio:  " . $inicio . "<br />Detalles: <br /> " . nl2br($notas) . "</td></tr>";
  
  $cantidad++;
  }
echo "</table>";

echo "<br>";
echo "<p align='center'>Total de Eventos: " . "<b> ".  $cantidad ."</b>". "</p>";

mysql_close($conexion);
include ("pie.php");
?>