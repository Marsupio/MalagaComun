<?php
include ("funciones.php");
include ("cabecera_inicio.php");

if (!$_POST)
{
	$id=$_GET['id'];
	$asunto=$_GET['asunto'];
?>
<div align="left">
	<h2>Respuesta a una sugerencia</h2>
	Asunto: <?php echo $asunto; ?>
	<br><br>
</div>
<form  action="responder_sugerencia.php?id=<?php echo $id?>" method="POST" lang="es" >
		Tu respuesta:<textarea id="formulario2" name="respuesta" type="text"   rows="9" required /> </textarea>
		<button class="button" type="submit">Publicar respuesta</button>	
</form>

<?php
}
?>

<?php

if ($_POST)
{
	$id=$_GET['id'];
	$autor=$_SESSION['NOMBRE'];
	$respuesta = '\n\n >> Respuesta de '.$autor.': ';
	$respuesta .= $_POST['respuesta'];
	$fecha=obten_fecha();

	$con=conectar_base_datos();
	mysqli_query($con, "update sugerencias SET TEXTO=CONCAT(TEXTO,'$respuesta') WHERE ID=$id");
	mysqli_close($con);	
	echo'<h2>Tu respuesta ha sido publicada</h2>';
	echo'<a href="ver_sugerencias.php?pg=1">VOLVER</a>';

}

include ("pie.php");
?>