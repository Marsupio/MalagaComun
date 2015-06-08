<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");

$email=$_GET["email"];

$conexion=conectar_base_datos();
$ssql = "SELECT * FROM usuarios WHERE (EMAIL='$email') "; 
$rs = mysqli_query($conexion, $ssql); 
$usr = mysqli_fetch_array($rs);     
muestra_datos_usuario($usr);

include "ofertas_demandas_usuario.php";
?>