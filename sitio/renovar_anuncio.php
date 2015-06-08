<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");

	$id = $_GET["id"];
	$tipo_anuncio = $_GET["tipo_anuncio"];
	$fecha=obten_fecha();
	
	$con = conectar_base_datos();
	$rs = mysqli_query($con, "SELECT ID FROM $tipo_anuncio ORDER BY ID DESC LIMIT 0, 1");
	$max_id = mysqli_fetch_array ($rs)['ID'];
	$max_id++;  //el índice del anuncio que irá por encima del anuncio más reciente
	//echo $max_id;
	mysqli_query($con, "UPDATE $tipo_anuncio SET ID=$max_id, FECHA='$fecha' WHERE ID=$id");  //lo muevo arriba de la tabla	
	mysqli_close($con);	
		
	echo'<h1>Se ha renovado el anuncio</h1>';	
	echo'<a href="mis_anuncios.php" class="button">Pulse aquí para volver</a>';

include ("pie.php");
?>