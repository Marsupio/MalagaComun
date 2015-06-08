<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include("config_local.php") ;

$con = conectar_base_datos();

$id=$_GET["id"];


	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM usuarios WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysql_query($ssql,$con); 

	if (mysql_num_rows($rs)!=0){ 
   		//evento encontrado,  lo borro
		mysql_query("DELETE FROM usuarios WHERE (ID='$id')");

		echo '<h2>Usuario borrado correctamente del sistema.</h2>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_usuarios.php">Pulse aquí para volver</a>';
		echo '<br>';	

		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<h2>No existe ese usuario en el sistema</h2>';
		echo '<br>';	
		echo '<a class="button" href="gestionar_usuarios.php">Pulse aquí para volver</a>';
		echo '<br>';	
	}


include("pie.php");
mysql_close($con);
?>