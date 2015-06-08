<?php
include ("funciones.php");
include ("cabecera_inicio.php");

	$id=$_GET["id"];
	
	$conexion=conectar_base_datos();
	
	// guardo los datos del anuncio con ese id	
	$rs=mysql_query("SELECT * FROM ofertas WHERE ID='$id'");
	
	$oferta=mysql_fetch_array($rs);
	
	$titulo=$oferta["TITULO"];
	$cuerpo=$oferta["CUERPO"];
	$categoria=$oferta["CATEGORIA"];
	$email=$oferta["EMAIL"];	
	$fecha=obten_fecha();	
	$localizacion=$oferta["LOCALIZACION"];
	$foto=$oferta["FOTO"];	
	
	// insertto al principio
	mysql_query("INSERT INTO ofertas (TITULO,CUERPO,CATEGORIA,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$categoria','$email','$fecha', '$localizacion', '$foto')");
	
	//borro copia antigua
	mysql_query("DELETE FROM ofertas WHERE ID='$id'");
		
	mysql_close($conexion);	
	
	
	echo'<h1>Se ha actualizado la fecha del anuncio con la fecha de hoy.</h1>';
	
	echo'<a href="mis_anuncios.php" class="button">Pulse aquí para volver</a>';



include ("pie.php");
?>