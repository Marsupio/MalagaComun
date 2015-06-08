<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include("config_local.php") ;

$con = conectar_base_datos();

$id=$_GET["id"];


	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM eventos WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysql_query($ssql,$con); 

	if (mysql_num_rows($rs)!=0){ 
   		//evento encontrado,  lo borro
		mysql_query("DELETE FROM eventos WHERE (ID='$id')");

		echo '<center>';
		echo '<b>Evento borrado correctamente del sistema.</b>';
		echo '<br>';	
		echo '<br>';	
		echo '<a class="button" href="administrar_eventos.php">Pulse aquí para volver a la lista de eventos</a>';
		echo '</center>';
		echo '<br>';	
		echo '<br>';	

		}
		else 
		{ 
	   	//si no existe le mando otra vez a la portada 
		echo '<br />';
		echo '<b>No existe ese evento en el sistema</b>';
		echo '<br>';	
		echo '<br>';	
		echo '<a class="button" href="administrar_eventos.php">Pulse aquí para volver a la página de eventos</a>';
		echo '<br>';	
		echo '<br>';	
	}


include("pie.php");
mysql_close($con);
?>