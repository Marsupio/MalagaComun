<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");

$con=conectar_base_datos();

$result = mysqli_query($con, "SELECT * FROM sugerencias ORDER BY ID DESC");

echo '<h2>Sugerencias realizadas por los usuarios de la web.</h2><br>';
$cantidad=0;
while($row = mysqli_fetch_array($result))
{
	  $id=$row['ID'];
	  $texto=$row['TEXTO'];
	  $fecha=$row['FECHA'];
	
echo "<table > 

<tr><th >Sugerencia nº ".$id."</th></tr>";
	  echo "<tr >";
  	  echo "<td >";
	  echo "<p align='left'>" . nl2br($texto)."<br><br>" ;
	  echo " Publicado el " . $fecha."<br>" ;
  	  echo "<a class='button' href='borrar_sugerencia.php?id=$id'>Eliminar</a>";
  	  echo "</td >";	  
    echo "</tr>";
	echo "</table>";
		
	  $cantidad++;
}
echo "<br><p align='center'>Total de sugerencias: " .'<b>'.  $cantidad .'</b>';
include("pie.php");
mysqli_close($con);

?>
