<?php
// **********   A sustituir por admin_conectar_bd.php

function conectar_base_datos()
{
include '../sitio/config_local.php';
$conexion = mysqli_connect($server, $db_user, $db_pass, $database) or die ("error1".mysqli_connect_error());
mysqli_query ($conexion, "SET NAMES 'utf8'");

return $conexion;
}
?>