<?php
include ("cabecera_inicio.php");
include ("funciones.php");
$email=$_SESSION['EMAIL'];
$conexion=conectar_base_datos();
if ($_GET["activar"]=="si")
{
	$query="UPDATE usuarios SET ROL='activo' WHERE EMAIL = '$email'";
	mysqli_query ($conexion, $query);
	echo '<br><span  style="color:#000000;">Tu cuenta ha sido activada pero el cambio no será efectivo hasta que vuelvas a iniciar sesión </span><br><br>';
}
elseif ($_GET["activar"]=="no")
{
	$query="UPDATE usuarios SET ROL='inactivo' WHERE EMAIL = '$email'";
	mysqli_query ($conexion, $query);
	echo '<br><span style="color:#000000;">Tu cuenta ha sido desactivada pero el cambio no será efectivo hasta que vuelvas a iniciar sesión </span><br><br>';
}
echo "<a class='button' href='usuario.php'>Volver</a>";

mysqli_close($conexion);
 ?>