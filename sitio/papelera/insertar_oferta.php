<?php
include ("funciones.php");
include ("cabecera_inicio.php");
?>
<!-- **************************contenido del div contenido******************** -->
<?php
if (!$_POST)
{
?>
<h2 align="left">OFERTAS: Publica tu anuncio</h2>


<form id="formulario"   action="insertar_oferta.php" method="POST" lang="es" enctype="multipart/form-data" >

<span id="label_formulario">Título</span><br/>
<input  name="titulo" type="text" required />


<span id="label_formulario">Descripción</span><br/>
<textarea  name="cuerpo"  rows="7" required /></textarea>


<span id="label_formulario">Foto o imagen (opcional)</span><br/>
<input  type="file" name="foto" />


<span id="label_formulario">Categoría</span>
<?php include ('categorias.php');?>


<span id="label_formulario">Localidad</span>
<?php include ('localidades.php');?>

<button class="button"  type="submit">Publicar Oferta</button>	

</form>
<?php
}
?>

<!-- **********************fin del contenido del div contenido******************** -->
<?php

// if( isset($_POST['propiedad name del boton tipo submit']) )   

if ($_POST)
{
	
$con=conectar_base_datos();
	
//inserto la oferta en la tabla de ofertas
$titulo=$_POST["titulo"];
$cuerpo=$_POST["cuerpo"];
$categoria=$_POST["categoria"];
$localizacion=$_POST["localizacion"];
$email=$_SESSION['EMAIL'];
$fecha=obten_fecha();

	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM usuarios WHERE (EMAIL='$email') "; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $ssql); 
	// si existe un usuario con ese email inserto la oferta
	if (mysqli_num_rows($rs)!=0)
	{

/************ sube la imagen ********************************************************/
	$nameimagen=$_FILES['foto']['name'];			// nombre de la imagen con extension incluida
	$tmpimagen=$_FILES['foto']['tmp_name'];			// ruta temporal del archivo en el servidor
	$info=pathinfo($nameimagen); 					// informacion de la imagen (incluye extension)
	
		
	if (is_uploaded_file($tmpimagen)) 
	{
		if (($info['extension']=='jpg') or ($info['extension']=='JPG') or ($info['extension']=='jpeg') or ($info['extension']=='JPEG'))	
		{			
			// Establecer un ancho y alto máximo para las miniaturas 
			// (añadir despues el caso que la imagen original sea menor que la miniatura)
			$ancho = 320;
			$alto = 240;

			// Obtener las nuevas dimensiones
			list($ancho_orig, $alto_orig) = getimagesize($tmpimagen);
			$ratio_orig = $ancho_orig/$alto_orig;
			
			if ($ancho/$alto > $ratio_orig) {
   				$ancho = $alto*$ratio_orig;
			} else {
   				$alto = $ancho/$ratio_orig;
			}

			// Redimensionar
			$nueva_imagen = imagecreatetruecolor($ancho, $alto);		// miniatura
			$vieja_imagen = imagecreatefromjpeg($tmpimagen);			// original
			imagecopyresized($nueva_imagen, $vieja_imagen, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);

			// Guardar la imagen original y la miniatura
			$urlnueva = "imagenes/anuncios/ofertas/".$nameimagen; 				// para la base de datos
			
			$original = "imagenes/anuncios/ofertas/".$nameimagen; 				// ruta imagen original
			$copia = "imagenes/anuncios/ofertas/miniatura_".$nameimagen;		// ruta miniatura
			copy($tmpimagen, $original);
			imagejpeg($nueva_imagen, $copia);
			
	
		} 
		elseif (($info['extension']=='png') or ($info['extension']=='PNG'))	
		{

			// Establecer un ancho y alto máximo para las miniaturas 
			// (añadir despues el caso que la imagen original sea menor que la miniatura)
			$ancho = 320;
			$alto = 240;

			// Obtener las nuevas dimensiones
			list($ancho_orig, $alto_orig) = getimagesize($tmpimagen);
			$ratio_orig = $ancho_orig/$alto_orig;
			
			if ($ancho/$alto > $ratio_orig) {
   				$ancho = $alto*$ratio_orig;
			} else {
   				$alto = $ancho/$ratio_orig;
			}

			// Redimensionar
			$nueva_imagen = imagecreatetruecolor($ancho, $alto);		// miniatura
			$vieja_imagen = imagecreatefrompng($tmpimagen);				// original
			imagecopyresized($nueva_imagen, $vieja_imagen, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);

			// Guardar la imagen original y la miniatura
			$urlnueva = "imagenes/anuncios/ofertas/".$nameimagen; 				// para la base de datos
			
			$original = "imagenes/anuncios/ofertas/".$nameimagen; 				// ruta imagen original
			$copia = "imagenes/anuncios/ofertas/miniatura_".$nameimagen;		// ruta miniatura
			copy($tmpimagen, $original);
			imagepng($nueva_imagen, $copia);		
		
		
		}
		elseif (($info['extension']=='gif') or ($info['extension']=='GIF'))	
		{
		
			// Establecer un ancho y alto máximo para las miniaturas 
			// (añadir despues el caso que la imagen original sea menor que la miniatura)
			$ancho = 320;
			$alto = 240;

			// Obtener las nuevas dimensiones
			list($ancho_orig, $alto_orig) = getimagesize($tmpimagen);
			$ratio_orig = $ancho_orig/$alto_orig;
			
			if ($ancho/$alto > $ratio_orig) {
   				$ancho = $alto*$ratio_orig;
			} else {
   				$alto = $ancho/$ratio_orig;
			}

			// Redimensionar
			$nueva_imagen = imagecreatetruecolor($ancho, $alto);		// miniatura
			$vieja_imagen = imagecreatefromgif($tmpimagen);			// original
			imagecopyresized($nueva_imagen, $vieja_imagen, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);

			// Guardar la imagen original y la miniatura
			$urlnueva = "imagenes/anuncios/ofertas/".$nameimagen; 				// para la base de datos
			
			$original = "imagenes/anuncios/ofertas/".$nameimagen; 				// ruta imagen original
			$copia = "imagenes/anuncios/ofertas/miniatura_".$nameimagen;		// ruta miniatura
			copy($tmpimagen, $original);
			imagegif($nueva_imagen, $copia);		
		
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
						
	mysqli_query($con, "insert into ofertas (TITULO,CUERPO,CATEGORIA,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$categoria','$email','$fecha', '$localizacion', '$urlnueva')");
	
	mysqli_close($con);

	echo'<p>Se ha insertado su oferta correctamente en la categoría correspondiente.<br>Ahora puede insertar otra oferta o seguir navegando por el sitio.</b></p>';

	echo '<a href="mis_anuncios.php" class="button">Volver</a>';

	}
	else
	{
		echo '<p>Por favor, asegúrate de que has escrito correctamente tu email y vuelve a intentarlo. Gracias.</b></p>';		
	}
}
else
{
/*
echo'<br>';
echo '<h3 align="left">Por favor,  asegúrese de rellenar correctamente todos los campos. Gracias.</h3>';
*/	
} // fin del if POST

?>
<!-- --------------------------------------------------------------------- -->
<?php
include ("pie.php");
?>