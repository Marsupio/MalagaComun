<?php
include ("cabecera_inicio.php");
include 'conectar_bd.php';

	$email=$_SESSION['EMAIL'];
	$id=$_SESSION['ID'];

	$nameimagen = strtolower ($_FILES['imagen']['name']);	//nombre del fichero subido (en minúsculas)
	$tmpimagen=$_FILES['imagen']['tmp_name'];  //nombre en directorio temporal del servidor
	
	$extimagen=pathinfo($nameimagen);  //array con las diferentes partes de la ruta del fichero
	 
	if (is_uploaded_file($tmpimagen)) 
	{
		if (($extimagen['extension']=='jpg') or ($extimagen['extension']=='png') or ($extimagen['extension']=='gif'))	
		{
			$urlnueva="imagenes/usuarios/".$id.'.'.$extimagen['extension'];
			
			copy ($tmpimagen, $urlnueva);   //copia el fichero desde el servidor a la nueva ubicación
			
			$con = conectar_base_datos();
			mysqli_query($con, "UPDATE usuarios SET FOTO='$urlnueva' WHERE EMAIL='$email'");
			mysqli_close($con);			

			echo '<br/>';
			echo '<h3>Se ha cambiado correctamente tu fotografía.</h3>';
			echo '<h4>Si al volver no ves ningún cambio, pulsa la tecla F5</h4>';			
			echo '<a class="button" href="usuario.php">Pulsa aquí para volver</a>';
		} 
		else 
		{
			echo '<br/>';
			echo '<p align="center"><b>Error: Sólo imágenes con extensión (jpg, png o gif)</b></p>';
			echo '<a class="button" href="usuario.php">Pulse aquí para volver a intentarlo</a>';
		}
	} 
	else 
	{
			echo '<br/>';
			echo '<p align="center"><b>Elija una imagen.</b></p>';
			echo '<a class="button" href="usuario.php">Pulse aquí para volver</a>';
	}
include('pie.php');
?>