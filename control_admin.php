<?php 

// leer datos de usuario y contraseña de la base de datos
include ('sitio/conectar_bd.php');

$alias=$_POST["ALIAS"];
$clave=$_POST["CLAVE"];

/**************************************************************/
// busco ese usuario en la base de datos
$con=conectar_base_datos();
$ssql = "SELECT * FROM administradores";
$rs = mysqli_query ($con, $ssql);
$admin = mysqli_fetch_array ($rs);

if ( ($alias==$admin['NOMBRE']) and ($clave==$admin['PASSWORD']) )
{
   	//usuario y contraseña válidos, defino una sesion y guardo datos 
   	session_start(); 
    $_SESSION["autentificado"]= "si";

   	header ("Location: admin/pagina_administrador.php");	
	
}
else 
{ 
   	//si no existe le mando otra vez a la portada 
    $_SESSION["autentificado"]= "no"; 	
   	header("Location: administrador.php?errorusuario=si"); 	 	
}
/****************************************************************/
mysqli_close($con);
?> 

