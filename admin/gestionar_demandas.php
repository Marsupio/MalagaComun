<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");

$con=conectar_base_datos();

// Muestro las OFERTAS 
echo '<h2>Listado de Demandas</h2>';      
echo '<p>Aquí puede inspecccionar y borrar alguna demanda en concreto si el contenido de la misma no se ajusta a la filosofía del sitio.</p>';  

//Sentencia SQL para buscar las ofertas publicadas por ese usuario 
$ssql2 = "SELECT * FROM demandas ORDER BY ID DESC"; 

//Ejecuto la sentencia 
$rs2 = mysqli_query($con, $ssql2); 

$cantidad=0;
while($row2 = mysqli_fetch_array($rs2))
  {
	$id=$row2['ID'];  	  // para borrar anuncio
	$titulo=$row2['TITULO'];	
	$cuerpo=$row2['CUERPO'];
	$categoria=$row2['CATEGORIA'];	
	
echo ' <table> 

<tr><th>Demanda nº '.$id.'</th></tr>';	
	
	  	  
  echo '<tr>';
  echo '<td>';
  
  echo '<h3> ' . $titulo.'</h3>' ;
  echo nl2br($cuerpo).'<br><br>' ;
  echo 'Categoría: ' . $categoria.'<br>' ;
  echo 'Publicado el ' . $row2['FECHA'].'<br>'  ;
  
  echo "<a class='button' href='eliminar_demanda.php?id=$id'>Eliminar</a>"; 
  echo '<br  />';
  echo "<a class='button' href='demanda_a_oferta.php?id=$id'>Convertir este anuncio en OFERTA</a>"; 
    
  
  echo '</td>';
  echo '</tr>';
  echo "</table>";

  $cantidad++;
  }

echo "<br>";
echo "<p align='center'>Total de Demandas: " . "<b> ".  $cantidad ."</b>". "</p>";

mysqli_close($con);
include ("pie.php");
?>