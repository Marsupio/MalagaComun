<?php			// OBSOLETO, LISTO PARA ELIMINAR
include ("funciones.php");
include ("cabecera_inicio.php");

$conexion=conectar_base_datos();

if ($_POST)
{
	$id=$_POST["id"];
	$nombre=$_POST["nombre"];
	$apellidos=$_POST["apellidos"];
	$telefono=$_POST["telefono"];
	$localizacion=$_POST["localizacion"];
	$email=$_POST["email"];
	$alias=$_POST["alias"];
	$clave=$_POST["clave"];
	$cp=$_POST["cp"];

	mysqli_query($conexion, "UPDATE usuarios SET NOMBRE='$nombre', APELLIDOS='$apellidos', TELEFONO='$telefono', EMAIL='$email', ALIAS='$alias', CLAVE='$clave', LOCALIZACION='$localizacion', CP='$cp' where (ID='$id')");

echo '<h2>Se han modificado correctamente sus datos.</h2>';
echo '<a class="button"  href="inicio.php">Pulse aquí para volver</a>';
	
}

mysqli_close($conexion);
include ("pie.php");
?>