<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");

// Falta la modificación de la foto
$tipo_anuncio = $_GET['tipo'];

if ($_POST)
{
	//inserto el anuncio modificado en la tabla correspondiente de acuerdo a su ID
	$id=$_POST["id"];
	$titulo=$_POST["titulo"];
	$cuerpo=$_POST["cuerpo"];
	$categoria=$_POST["categoria"];
	$localizacion=$_POST["localizacion"];
	
//	$fecha=obten_fecha();
	$con=conectar_base_datos();
	mysqli_query($con, "UPDATE '$tipo_anuncio' SET TITULO='$titulo', CUERPO='$cuerpo', CATEGORIA='$categoria', LOCALIZACION='$localizacion' where (ID='$id')");
	mysqli_close($con);

echo'<p>Se ha modificado correctamente tu anuncio.</p>';
echo '<a class="button"  href="mis_anuncios.php">Pulsa aquí para volver </button></a>';


}
else
{
	echo '<p align="center" style="font-size:16px;">No ha efectuado ningún cambio.</p>';	
}
include ("pie.php");
?>