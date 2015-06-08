<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");
?>

<form name="categorias" action="borrar_categoria.php" method="post">
<h2>Elija la categoría a eliminar de la lista desplegable a continuación:</h2>
<?php include ('categorias.php'); ?>
<br/>
<input class="button" type="submit" value="Eliminar la categoría seleccionada" name="boton_eliminar_categoria">
</form>

<?php
if (isset($_POST['boton_eliminar_categoria']))
{
	$categoria=$_POST["categoria"];

	// conexion con la base de datos
	$con = conectar_base_datos();
	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM categorias WHERE (categoria='$categoria')"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $ssql);	 

	if (mysqli_num_rows($rs)!=0){ 
   		// encontrado y lo borro
		mysqli_query($con, "DELETE FROM categorias WHERE (categoria='$categoria')");

		echo '<p style=" font-weight:bold; color:red;">Categoría eliminada del sistema.</p>';	

		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<p style=" font-weight:bold; color:red">Ya no existe esa categoria en el sistema.</p>';	
	}
	mysqli_close($con);	
}

include("pie.php");
?>