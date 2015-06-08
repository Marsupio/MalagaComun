<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");

$tipo_anuncio=$_GET["tipo_anuncio"];
$id=$_GET["id"];
$foto=$_GET["foto"];

		$con = conectar_base_datos();
		mysqli_query($con, "DELETE FROM $tipo_anuncio WHERE ID='$id'");
		
		if ($foto!='defecto.jpg') unlink($foto);	 //borra la foto
		
		echo '<center>';
		echo '<b>Tu anuncio ha sido eliminado del sistema.</b>';
		echo '<br>';	
		echo '<br>';	
		echo '<a  class="button" href="mis_anuncios.php">Pulsa aquí para volver a tus anuncios</a>';
		echo '</center>';
		echo '<br>';	
		echo '<br>';	

mysqli_close($con);
include("pie.php");
?>