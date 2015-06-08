<?php
include ("funcs_admin.php");
include ("cabecera_administrador2.php");

echo '<h2>BÚSQUEDA DE USUARIOS</h2>';
?>

<form action="buscar_usuario_admin.php" method="post">
<input name="email" >
<button class="button"  type="submit" name="buscador">Buscar</button>
</form>

<?php
if ($_POST)
{ 
		// Tomamos el valor ingresado
		$buscar = $_POST['email'];
		// Si está vacío, lo informamos, sino realizamos la búsqueda
		if(empty($buscar))
		{
			echo "<p align='center' style='color:red; font-weight: bold;'>No se ha escrito nada para buscar.</p>";
		}
		// muestro los resultados
		elseif (!empty($buscar))
		{
			mostrar_resultados_busqueda_usuario_admin($buscar);
		} 
		else 
		{ 
		// En caso de no encontrar resultados
		echo "<p align='center' style='color:red; font-weight: bold;'>No se ha encontrado ninguna oferta para: <b>$buscar</b></p>"; 
		}
}

include ("pie.php");
?>