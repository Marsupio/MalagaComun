<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include ("funciones_calendario.php");


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

?>


<?php

// Muestro eventos
echo '<h2>Aquí puede eliminar o rectificar algún dato del evento en cuestión.</h2>';    
echo '<br />';  

	
//Sentencia SQL para buscar los eventos
$ssql2 = "SELECT * FROM eventos ORDER BY FECHA ASC"; 

//Ejecuto la sentencia 
$rs2 = mysql_query($ssql2,$conexion); 




$cantidad=0;
while($row2 = mysql_fetch_array($rs2))
{
	
echo '<table  > 

<th colspan="8">Evento programado</th>';

	
	  $id=$row2['ID'];
	  $evento=$row2['EVENTO']; 
	  $lugar=$row2['LUGAR']; 
	  $fecha=$row2['FECHA']; 
	  $inicio=$row2['INICIO']; 
	  $notas=$row2['NOTAS'];

	    	  
 	 echo '<tr>';
  	echo '<td>';
	  
  	echo "<h4>Evento: </h4>" . $evento.'<br>';
  	echo "<h4>Lugar:</h4>" . $lugar.'<br>' ;
  	echo "<h4>Fecha: </h4>" . $fecha.'<br>';
	echo "<h4>Hora inicio: </h4>" . $inicio.'<br>';
  	echo "<h4>Descripción: </h4>" . nl2br($notas).'<br>';

	echo "<br>";
 	echo "<a class='button'  href='borrar_evento.php?id=$id'>Eliminar</a>"; 
	echo "&nbsp;&nbsp;&nbsp;";
  	echo "<a class='button'  href='editar_evento.php?id=$id'>Editar</a>"; 
   
   
   echo "</td>";
  echo "</tr>";
  echo "</table>";
  $cantidad++; 
}

echo "<br>";
echo "<p align='center'>Total de Eventos: " . "<b> ".  $cantidad ."</b>". "</p>";


mysql_close($conexion);
include ("pie.php");
?>