<?php
include ("conectar_bd.php");
include ("cabecera_inicio.php");

$email=$_SESSION['EMAIL'];

$con = conectar_base_datos();
$rs = mysqli_query ($con, "SELECT * FROM usuarios WHERE EMAIL = '$email'");
$us = mysqli_fetch_array ($rs);
mysqli_close($con);

if (!$_POST)	
{
?>	
	<h2>Modifica tus datos de usuario</h2>
	<p><b>El cambio de email no será visible hasta que vuelvas a inciar sesión</b></p>

	<img class="bordes_redondeados" id="foto_perfil" src="<?php echo $us['FOTO']; ?>" alt="" />
	<br><br>
	<h4 align="left">Foto: </h4>
	<form action="modificar_foto_usuario.php" method="POST" lang="es" enctype="multipart/form-data">
		Por favor, envía sólo imágenes de un tamaño inferior a 1 MB
		<input type="file" name="imagen" />
		<button class="button"  type="submit">Enviar la foto seleccionada</button>
	</form>

	<form action="modificar_usuario.php" method="POST" lang="es">

		<input id="formulario" name="id" type="hidden" size="80" value="<?php echo $us['ID']; ?>"  /><br />
		Nombre<br />
		<input id="formulario" name="nombre" type="text" size="80" value="<?php echo $us['NOMBRE']; ?>" required  /><br />
		Apellidos<br />
		<input id="formulario" name="apellidos" type="text" size="80" value="<?php echo $us['APELLIDOS']; ?>"  /><br />
		Teléfono<br />
		<input id="formulario" name="telefono"  type="text" size="80" value="<?php echo $us['TELEFONO']; ?>"  /><br/>
		Localidad<br />
			<?php include ('comarcas.php');  ?>
		<br />
		Código Postal<br />
		<input id="formulario" name="cp" type="number" size="80"  value="<?php echo $us['CP']; ?>" ><br />
		E-mail<br />
		<input id="formulario" name="email" type="text" size="80"  value="<?php echo $email; ?>" required ><br />
		Nombre Usuario<br />
		<input id="formulario" name="alias" type="text" size="80"  value="<?php echo $us['ALIAS']; ?>" required ><br />
		Contraseña<br />
		<input id="formulario" name="clave" type="text" size="80"  value="<?php echo $us['CLAVE']; ?>" required ><br />
		<button class="button" type="submit">Modificar Mis Datos</button>

	</form>
<?php 
}
else
{
	$con=conectar_base_datos();

	$id=$_POST["id"];
	$nombre=$_POST["nombre"];
	$apellidos=$_POST["apellidos"];
	$telefono=$_POST["telefono"];
	$localizacion=$_POST["localizacion"];
	$email=$_POST["email"];
	$alias=$_POST["alias"];
	$clave=$_POST["clave"];
	$cp=$_POST["cp"];

	mysqli_query($con, "UPDATE usuarios SET NOMBRE='$nombre', APELLIDOS='$apellidos', TELEFONO='$telefono', EMAIL='$email', ALIAS='$alias', CLAVE='$clave', LOCALIZACION='$localizacion', CP='$cp' where (ID='$id')");

	echo '<h2>Se han modificado correctamente tus datos.</h2>';
	echo '<a class="button"  href="inicio.php">Pulsa aquí para volver</a>';
	mysqli_close($con);
}
include('pie.php'); ?>