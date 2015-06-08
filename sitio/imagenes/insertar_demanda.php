<?php
include ("funciones.php");
include ("cabecera_inicio.php");
?>
<!-- **************************contenido del div contenido******************** -->
<center>
<br>
<p id="titulo2">Crear una <b>DEMANDA</b> de servicios a la comunidad.<p>

<form  action="insertar_demanda.php" method="POST" lang="es">
<table align="center" width="90%"  style="text-align:left">

<tr>       
<td>Título</td>
<td><input id="formulario"  name="titulo" type="text" size="63%" placeholder="Titulo que aparecerá en el tablón de anuncios." required /><br /></td>
</tr>

<tr>
<td><br />Descripción</td>
<td><br /><textarea id="formulario" name="cuerpo" cols="65%" rows="10" placeholder="Escriba su demanda concretando un poco o indique los detalles que considere oportunos..." required /></textarea><br /></td>
</tr>

<tr>
<td>
	Foto o imagen (opcional)
</td>
<td>
	<input id="titulo6" type="file" name="foto" />
</td>
</tr>

<tr>
<td><br>Categoría</td>
<td>
	<br>
	<?php include ('categorias.php');?>
</td>
</tr>


<tr>
<td><br>Localidad</td>
<td>
	<br>
	<?php include ('localidades.php');?>
</td>
</tr>


<tr>       
<td><br />Tu Email</td>
<td><br /><input id="formulario" name="email" type="text" size="63%" placeholder="Escribe aquí tu dirección de email." required />
</td>
</tr>




<tr>
<td style="text-align:left"><br /><br /><button type="reset">Borrar</button>	 </td>   
<td style="text-align:right"><br /><br /><button type="submit">Publicar Demanda</button>	 </td>
</tr>


</table>
</form>

<br />
</center>
<!-- **********************fin del contenido del div contenido******************** -->
<?php

if ($_POST)
{
	
$conexion=conectar_base_datos();
	
//inserto la oferta en la tabla de ofertas
$titulo=$_POST["titulo"];
$cuerpo=$_POST["cuerpo"];
$categoria=$_POST["categoria"];
$localizacion=$_POST["localizacion"];
$email=$_POST["email"];
$fecha=obten_fecha();



	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM usuarios WHERE (EMAIL='$email') "; 
	//Ejecuto la sentencia 
	$rs = mysql_query($ssql,$conexion); 
	// si existe un usuario con ese email inserto la oferta
	if (mysql_num_rows($rs)!=0)
	{

/************ sube la imagen ********************************************************/
	$nameimagen=$_FILES['foto']['name'];
	$tmpimagen=$_FILES['foto']['tmp_name'];
	
	$extimagen=pathinfo($nameimagen); 
	
	$foto=$nameimagen;
	$urlnueva="imagenes/anuncios/demandas/".$nameimagen;

	if (is_uploaded_file($tmpimagen)) 
	{
		if (($extimagen['extension']=='jpg') or ($extimagen['extension']=='png') or ($extimagen['extension']=='gif') or ($extimagen['extension']=='JPG') or ($extimagen['extension']=='PNG') or ($extimagen['extension']=='GIF'))	
		{
			$urlnueva="imagenes/anuncios/demandas/".$nameimagen;
			move_uploaded_file($tmpimagen,$urlnueva);
		} 
		else 
		{
			echo '<p align="center"><b>Error: Sólo imágenes con extensión (jpg, png o gif).</p>';
		}
	
	}
	else
	{
			$urlnueva="defecto.jpg";
	}	
/**********************************************************/
		
	$conexion=conectar_base_datos();
						
	mysql_query("insert into demandas (TITULO,CUERPO,CATEGORIA,EMAIL,FECHA,LOCALIZACION,FOTO) values ('$titulo','$cuerpo','$categoria','$email','$fecha', '$localizacion', '$urlnueva')");
	
	mysql_close($conexion);

	echo'<p align="center" style="font-size:16px; color:#00a;"><b>Se ha insertado su oferta correctamente en la categoría correspondiente.<br>Ahora puede insertar otra oferta o seguir navegando por el sitio.</b></p>';
	}
	else
	{
		echo '<p align="center" style="font-size:16px; color:#a00;"><b>Por favor, asegúrate de que has escrito correctamente tu email y vuelve a intentarlo. Gracias.</b></p>';		
	}

}
else
{

echo '<p align="center" style="font-size:15px;"><b>Por favor, rellene correctamente todos los campos. Gracias.</b></p>';
	
} // fin del if POST
?>
<!-- --------------------------------------------------------------------- -->
<?php
include ("pie.php");
?>