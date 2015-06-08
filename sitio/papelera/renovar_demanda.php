<?php
include ("funciones.php");
include ("cabecera_inicio.php");


	$id=$_GET["id"];
	
	$fecha= date('d/m/Y', time());


	$conexion=conectar_base_datos();
	
	// guardo los datos del anuncio con ese id	
	$rs=mysql_query("SELECT * FROM demandas WHERE ID='$id'");
	
	$demanda=mysql_fetch_array($rs);
	
	$titulo=$demanda["TITULO"];
	$cuerpo=$demanda["CUERPO"];
	$categoria=$demanda["CATEGORIA"];
	$email=$demanda["EMAIL"];	
	$fecha=obten_fecha();	
	$localizacion=$demanda["LOCALIZACION"];
	$foto=$demanda["FOTO"];	
	
	// insertto al principio
	mysql_query("INSERT INTO demandas (TITULO,CUERPO,CATEGORIA,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$categoria','$email','$fecha', '$localizacion', '$foto')");
	
	//borro copia antigua
	mysql_query("DELETE FROM demandas WHERE ID='$id'");		
	mysql_close($conexion);	
	
	echo'<h1>Se ha actualizado la fecha del anuncio con la fecha de hoy.</h1>';
	
	echo'<a href="mis_anuncios.php" class="button">Pulse aquí para volver</a>';



include ("pie.php");
?>