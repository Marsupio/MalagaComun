<?php
include ("conectar_bd.php");
include ("cabecera_administrador2.php");

$con = conectar_base_datos();

$id=$_GET["id"];


	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM sugerencias WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con,$ssql); 

	if (mysqli_num_rows($rs)!=0){ 
   		//evento encontrado,  lo borro
		mysqli_query($con, "DELETE FROM sugerencias WHERE (ID='$id')");

		echo '<b>Sugerencia borrada correctamente del sistema.</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_sugerencias.php">Pulse aquí para volver</a>';
		echo '<br>';	

		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<b>No existe esa sugerencia en el sistema</b>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_sugerencias.php">Pulse aquí para volver</a>';
		echo '<br>';	
	}


include("pie.php");
mysqli_close($con);
?>