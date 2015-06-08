<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");
?>
<!-- **************************contenido del div contenido******************** -->
<?php
if (!$_POST)
{
?>

<form id="formulario"   action="publicar_anuncio.php" method="POST" lang="es" enctype="multipart/form-data" >

			<h3>Tipo de anuncio a publicar</h3>
			<label for="uno" style="display: inline">
			<input id="uno" type="radio" name="tipo" value="ofertas" style="float: left" checked>&nbsp; Oferta (algo que ofreces)<br>
			</label>
			<label for="dos" style="display: inline">
			<input id="dos" type="radio" name="tipo" value="demandas" style="float: left">&nbsp; Demanda (algo que necesitas)<br>
			</label><br>
		
		<span id="label_formulario">Título</span><br/>
		<input  name="titulo" type="text" maxlength="50" required />
		
		<span id="label_formulario">Etiquetas (opcional): <span style="font-size:0.8em; font-weight:normal">añade palabras clave para facilitar la búsqueda (útil sólo para ofertas)</span></span><br/>
		<input  name="etiquetas" type="text" />

		<span id="label_formulario">Descripción</span><br/>
		<textarea rows="4" name="cuerpo" required></textarea>

		<span id="label_formulario">Foto o imagen (opcional). <span style="font-size:0.8em; font-weight:normal">Su tamaño no debe exceder 1 MB</span></span><br/>
		<input  type="file" name="foto" />

		<span id="label_formulario">Localidad</span>
		<?php include ('comarcas.php');?>

		<button class="button"  type="submit">Publicar Anuncio</button>	

</form>
<?php
}

else
{	
	$tipo = $_POST["tipo"];
	$titulo = $_POST["titulo"];
	$cuerpo = $_POST["cuerpo"];
	$etiquetas = $_POST["etiquetas"];
	$localizacion = $_POST["localizacion"];
	$email = $_SESSION['EMAIL'];
	$fecha = obten_fecha();


	/************ sube la imagen ********************************************************/
		$nameimagen=$_FILES['foto']['name'];			// nombre de la imagen con extension incluida
		$tmpimagen=$_FILES['foto']['tmp_name'];			// ruta temporal del archivo en el servidor
		$info=pathinfo($nameimagen); 					// informacion de la imagen (incluye extension)
		
			
		if (is_uploaded_file($tmpimagen)) 
		{
			if (($info['extension']=='jpg') or ($info['extension']=='JPG') or ($info['extension']=='jpeg') or ($info['extension']=='JPEG'))	
			{	
				$urlnueva = "imagenes/anuncios/ofertas/".$nameimagen; 				// para la base de datos
				copy($tmpimagen, $urlnueva);
			}		
			else 
			{
				echo '<p align="center"><b>Error: Sólo imágenes con extensión "jpg, png o gif".<br/> Aún así se ha creado su anuncio pero sin foto. Si desea un anuncio con foto asegúrese que el formato de la misma es jpg, gif o png. Gracias.</p>';
				$urlnueva="defecto.jpg";			
			}		
		}
		else
		{
				$urlnueva="defecto.jpg";
		}	
	/**********************************************************/
		$con=conectar_base_datos();
		if ($tipo == 'ofertas'){				
			mysqli_query($con, "insert into ofertas (TITULO,CUERPO,ETIQUETAS,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$etiquetas','$email','$fecha', '$localizacion', '$urlnueva')");
		}
		else{
			mysqli_query($con, "insert into demandas (TITULO,CUERPO,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$email','$fecha', '$localizacion', '$urlnueva')");
		}
		mysqli_close($con);

		echo'<p>Se ha publicado tu anuncio correctamente.<br></p>';

		echo '<a href="mis_anuncios.php" class="button">Volver</a>';
}
?>
<!-- --------------------------------------------------------------------- -->
<?php
include ("pie.php");
?>