<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");
?>

<form  action="ver_ofertas.php" method="POST" lang="es">

Categoría
<?php include ('categorias.php');?>

<button class="button" type="submit">Filtrar por categoría</button>

</form>

<?php

if (!$_POST)
{
// se muestran todas las categorías por defecto
	// me conecto a la base de datos
	$con=conectar_base_datos();
	$result = mysqli_query($con, "SELECT * FROM ofertas order by ID desc limit 20");	

	echo '<h2 align="left">Últimas Ofertas publicadas: </h2><br />';
	$oferta = mysqli_fetch_array($result);
	while($oferta)
	{
		$tipo_anuncio='oferta';
		$email=$oferta['EMAIL'];
		
		/************* busco nombre usuario con ese email**************************/
		$resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE EMAIL='$email' ");	
		$usr = mysqli_fetch_array($resultado);	
		$autor = $usr['NOMBRE'].' '.$usr['APELLIDOS'];

		muestra_anuncio_con_foto($tipo_anuncio,$oferta,$autor);
		$oferta = mysqli_fetch_array($result);
	}

}  // end if 1

else  //if $_POST
{
	$categoria=$_POST['categoria'];
	if ($categoria!='TODAS LAS CATEGORIAS')   //si se selecciona una categoría concreta
	{
		// me conecto a la base de datos
		$con=conectar_base_datos();
		$result = mysqli_query($con, "SELECT * FROM ofertas WHERE (CATEGORIA='$categoria') order by ID desc limit 20");	

		echo '<h2>Listado de las Ofertas de la categoría seleccionada:</h2><br />';
		$oferta = mysqli_fetch_array($result);
		while($oferta)
		{	
			$tipo_anuncio='oferta';
			$email = $oferta['EMAIL'];

			/************* busco nombre usuario con ese email**************************/
			$resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE EMAIL='$email' ");	
			$usr = mysqli_fetch_array($resultado);	
			$autor = $usr['NOMBRE'].' '.$usr['APELLIDOS'];	
			muestra_anuncio_con_foto($tipo_anuncio,$oferta,$autor);
			$oferta = mysqli_fetch_array($result);
		} //end while

	}  // end if 2
	else   // si se seleccionan todas las categorías
	{
		header("Location: ver_ofertas.php");
	}  //end else 2
} //end else 1
mysqli_close($con);

/**************************************************************************************/
include ("pie.php");
?>