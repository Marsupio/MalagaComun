<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");

	$id = $_GET['id'];
	$tipo_anuncio = $_GET['tipo_anuncio'];

	//conecto con la base de datos
	$con = conectar_base_datos();
	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM $tipo_anuncio WHERE ID='$id'"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $ssql);
	//Obtengo la fila en cuestion
	$anuncio = mysqli_fetch_array($rs);
	
	$id=$anuncio['ID'];
	$titulo=$anuncio['TITULO'];
	$cuerpo=$anuncio['CUERPO'];
	if ($tipo_anuncio == 'ofertas') $etiquetas=$anuncio['ETIQUETAS'];   //solo hay campo ETIQUETAS en la tabla de ofertas
	
// Modificación de la foto del anuncio
	echo '<br />';     
	echo '<img class="bordes_redondeados" id="foto_perfil" src="'.$anuncio['FOTO'].'" alt="" />';
	echo '<br>';
	
if (!$_POST)
{	
?>	

<form action="modificar_foto_anuncio.php?id=<?php echo $id; ?>&tipo_anuncio=<?php echo $tipo_anuncio;?>" method="POST" lang="es" enctype="multipart/form-data">

	<h4>Foto:</h4>Por favor envía sólo imágenes de un tamaño inferior a 1 MB
	<input type="file" name="imagen" />
	<button class="button"  type="submit">Enviar la foto seleccionada</button><br><br>

</form>

<form action="editar_anuncio.php?tipo_anuncio=<?php echo $tipo_anuncio ?>&id=<?php echo $id ?>" method="POST" lang="es">
		Título
		<input id="formulario" name="titulo" type="text" size="80" value="<?php echo $titulo; ?>" required />
		Descripción
		<textarea id="formulario" name="cuerpo" cols="61" rows="5" required ><?php echo $cuerpo; ?></textarea>
		Etiquetas (sólo para ofertas)
		<input id="formulario" name="etiquetas" type="text" size="80" value="<?php if (isset($etiquetas)) echo $etiquetas; ?>"/>
		Localidad
		<?php include ('comarcas.php'); ?>
		<button class="button"  type="submit">Enviar Cambios</button>
</form>

<?php 
}
else
{
	//inserto el anuncio modificado en la tabla correspondiente de acuerdo a su ID
	$titulo=$_POST["titulo"];
	$cuerpo=$_POST["cuerpo"];
	$etiquetas=$_POST["etiquetas"];
	$localizacion=$_POST["localizacion"];
	
	mysqli_query($con, "UPDATE $tipo_anuncio SET TITULO='$titulo', CUERPO='$cuerpo', ETIQUETAS='$etiquetas', LOCALIZACION='$localizacion' where (ID='$id')");
	

echo'<p>Se ha modificado correctamente tu anuncio.</p>';
echo '<a class="button"  href="mis_anuncios.php">Pulsa aquí para volver </button></a>';	
}
include('pie.php'); ?>