<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");

$con = conectar_base_datos();

$id=$_GET["id"];


	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM ofertas WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $ssql); 

	if (mysqli_num_rows($rs)!=0)
	{ 
	
		$row=mysqli_fetch_array($rs);
		$ruta_imagen=$row['FOTO'];
			
   		// encontrado,  lo borro
		mysqli_query($con, "DELETE FROM ofertas WHERE (ID='$id')");
		if ($ruta_imagen!='defecto.jpg')
		{			
    	unlink($ruta_imagen);
		$ruta_miniatura=substr($ruta_imagen,0,26).'miniatura_'.substr($ruta_imagen, 26, strlen($ruta_imagen));
    	unlink($ruta_miniatura);
		}
		
		echo '<br />';
		echo '<b>Oferta borrada correctamente del sistema.</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_ofertas.php">Pulse aquí para volver</a>';
		echo '<br>';	


		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<br />';
		echo '<b>No existe esa oferta en el sistema</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_ofertas.php">Pulse aquí para volver</a>';
		echo '<br>';	
	}


include("pie.php");
mysqli_close($con);
?>