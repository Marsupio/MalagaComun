<?php
include "cabecera_inicio.php";
include "funcs_sitio.php";

if ($_POST)   // si llegamos a través del formulario de búsqueda de usuarios
{	
	$seleccion = $_POST['seleccion'];
	$nombre_email = explode (" <", $seleccion);
	$nombre = $nombre_email[0];
	$email = trim ($nombre_email[1],'>');
	$anuncio = '';
}
elseif ($_GET)   //si llegamos a través de un anuncio
{
	$email = $_GET['email'];
	$anuncio = $_GET['anuncio'];
}

$conexion=conectar_base_datos();
$ssql = "SELECT * FROM usuarios WHERE (EMAIL='$email') "; 
$rs = mysqli_query($conexion, $ssql); 
$usr = mysqli_fetch_array($rs);     
muestra_datos_usuario($usr,$anuncio);
$nombre = $usr['NOMBRE'];
include "ofertas_demandas_usuario.php";
?>