<?php
include ("funciones.php");
include ("cabecera_inicio.php");

echo '<h2>BÚSQUEDA DE DEMANDAS</h2>';
echo '<p align="center">Puede buscar en todas las demandas que hay publicadas en estos momentos con tan sólo escribir una o varias palabras y el buscador le mostrará las demandas que coinciden con su búsqueda después de pulsar el botón "Buscar" <br><br>Alternativamente también puede ojear el listado de demandas en el menú lateral de la izquierda.</p>';


?>

<form action="buscar_demandas.php" method="post">
¿Qué estás buscando?
<br /> 
<input name="palabra" >
<button class="button" type="submit" name="buscador">Buscar</button>
</form>
<?php


if ($_POST)
{ 
// Tomamos el valor ingresado
$buscar = $_POST['palabra'];

// Si está vacío, lo informamos, sino realizamos la búsqueda
if(empty($buscar))
{
	echo "<p align='center'><b>No se ha escrito nada para buscar.</b></p>";
}
// muestro los resultados
elseif (!empty($buscar))
{
	
	mostrar_resultados_demandas($buscar);

} 
else 
{ 
// En caso de no encontrar resultados
echo "No se ha encontrado ninguna demanda para: <b>$buscar</b>"; 
}
}

include ("pie.php");
?>