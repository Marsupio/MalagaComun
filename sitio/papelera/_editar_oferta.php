<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");
include("config_local.php") ;

	$id=$_GET["id"];

	//conecto con la base de datos
	$con = conectar_base_datos();
	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM ofertas WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysqli_query($con, $ssql);
	//Obtengo la fila en cuestion
	$row = mysqli_fetch_array($rs);
	
	$id=$row[0];
	$titulo=$row[1];
	$cuerpo=$row[2];
//	$categoria=$row[3];
//	$email=$row[4];
//	$fecha=$row[5];	
	
	
?>	



<p id="titulo2">Escriba, modifique, añada o borre lo que considere oportuno:<p>

<form action="actualizar_oferta.php" method="POST" lang="es">

Oferta nº:
<input id="formulario" style="background-color:#ffc; color:#000; text-align:left;" name="id" type="text" size="10" value="<?php echo $id; ?>" required readonly /><br />

Título
<input id="formulario" name="titulo" type="text" size="80" value="<?php echo $titulo; ?>" required /><br />

Descripción
<textarea id="formulario" name="cuerpo" cols="61" rows="10" value="" required /><?php echo $cuerpo; ?></textarea><br />


Categoría
<?php include ('categorias.php'); ?>


Localidad
<?php include ('localidades.php'); ?>

<button class="button"  type="submit">Edición Finalizada</button>

</form>

<?php include('pie.php'); ?>