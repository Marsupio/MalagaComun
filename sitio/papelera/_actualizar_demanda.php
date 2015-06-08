<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");

$con=conectar_base_datos();

if ($_POST)
{
	//inserto la demanda modificada en la tabla de demandas deacuerdo a su ID
	$id=$_POST["id"];
	$titulo=$_POST["titulo"];
	$cuerpo=$_POST["cuerpo"];
	$categoria=$_POST["categoria"];
	$localizacion=$_POST["localizacion"];
	
//	$fecha=obten_fecha();

	mysqli_query($con, "update demandas set TITULO='$titulo', CUERPO='$cuerpo', CATEGORIA='$categoria', LOCALIZACION='$localizacion' where (ID='$id')");
	
echo'<p>Se ha modificado correctamente su demanda.</p>';
echo '<a class="button"  href="mis_anuncios.php">Pulse aquí para volver</a>';
}
else
{
	echo '<p align="center" style="font-size:16px;">No ha efectuado ningún cambio.</p>';	
}

mysqli_close($con);
include ("pie.php");
?>