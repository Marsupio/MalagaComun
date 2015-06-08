<?php
include ("cabecera_inicio.php");
include 'conectar_bd.php';

$id = $_GET['id'];
$tipo_anuncio = $_GET['tipo_anuncio'];

	$nameimagen = strtolower ($_FILES['imagen']['name']);	//nombre del fichero subido (en minúsculas)
	$tmpimagen=$_FILES['imagen']['tmp_name'];  //nombre en directorio temporal del servidor
	
	$extimagen = pathinfo($nameimagen);  //array con las diferentes partes de la ruta del fichero
	 
	if (is_uploaded_file($tmpimagen)) 
	{
		if (($extimagen['extension']=='jpg') or ($extimagen['extension']=='png') or ($extimagen['extension']=='gif'))	
		{
			$urlnueva="imagenes/anuncios/".$tipo_anuncio."/".$id.'.'.$extimagen['extension'];
			echo $urlnueva;
			copy ($tmpimagen, $urlnueva);   //copia el fichero desde el servidor a la nueva ubicación
			
			$con = conectar_base_datos();
			mysqli_query($con, "UPDATE $tipo_anuncio SET FOTO='$urlnueva' WHERE ID='$id'");
			mysqli_close($con);			

			echo '<br/>';
			echo '<h3>Se ha cambiado correctamente la fotografía.</h3>';
			echo '<h4>Tras volver, pulsa la tecla F5 en tu teclado para poder ver los cambios.</h4>';			
			echo '<a class="button" href="mis_anuncios.php">Pulsa aquí para volver</a>';
		} 
		else 
		{
			echo '<br/>';
			echo '<p align="center"><b>Error: Sólo imágenes con extensión (jpg, png o gif)</b></p>';
			echo "<a class='button' href='editar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id.php'>Pulsa aquí para volver a intentarlo</a>";
		}
	} 
	else 
	{
			echo '<br/>';
			echo '<p align="center"><b>Elija una imagen.</b></p>';
			echo '<a class="button" href="usuario.php">Pulsa aquí para volver</a>';
	}

include('pie.php');
?>