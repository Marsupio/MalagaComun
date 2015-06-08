<?php

include ("funciones.php");
include ("cabecera_administrador2.php");

	
	echo '<br/>';
	echo '<h2>Aquí puede agregar una nueva categoría.</h2>';
	echo '<p>Escriba a continuación en la caja de texto el nombre para esa nueva categoría de anuncios)</p>';

?>

<form  action="insertar_categoria.php" method="POST" lang="es">

<input id="formulario"  name="categoria" type="text"  placeholder="Escriba aqui la nueva categoría..." required />

<button class="button"  type="submit">Agregar esta nueva categoría al sistema</button>

</form>

<?php

if ($_POST)
{	
	$categoria=$_POST["categoria"];

	if ($categoria=="")
	{
		echo '<p align="center">Rellene correctamente todos los datos.</p>';
		echo '<p align="center"><a href="insertar_categoria.php"><button>Volver a intentarlo</button></a></p>';
	}
	elseif ($categoria!="")
	{
	// me conecto a la base de datos
	$con=conectar_base_datos();
	mysqli_query($con, "INSERT INTO categorias(categoria) values ('$categoria')");
	
	echo'<p style=" font-weight:bold;  color:#57036C;">Se ha añadido correctamente esa nueva categoría. <br />Puede agregar tantas categorías como sean necesarias.</p>';
		
	mysqli_close($conexion);
	}
	
}
include ("pie.php");
?>