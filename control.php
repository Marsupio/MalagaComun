<?php 
include ('sitio/conectar_bd.php');

// leo datos de inicio_sesion.php
$alias=$_POST["ALIAS"];
$clave=$_POST["CLAVE"];

//Sentencia SQL para buscar un usuario con esos datos 
$ssql = "SELECT * FROM usuarios WHERE ((ALIAS='$alias')&&(CLAVE='$clave')) "; 
$con = conectar_base_datos();
//Ejecuto la sentencia 
$rs = mysqli_query($con, $ssql); 

if ($usr = mysqli_fetch_array($rs))
{ 
	session_start();
	$_SESSION = $usr;	
	$_SESSION["autentificado"] = "si";
   	if ($_SESSION['ROL']=='inactivo') 
		{
			header("Location: sitio/aviso_inactivos.php");
		}
	else 
		{
			header("Location: sitio/novedades.php");
		} 
}
else
{ 
   	//si no existe le mando otra vez a la portada 
    $_SESSION["autentificado"] = "no"; 	
   	header("Location: inicio_sesion.php?errorusuario=si"); 
} 
mysqli_close($con);
?> 

