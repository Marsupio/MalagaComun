<?php
include "cabecera_inicio.php";
include "funcs_sitio.php";

$seleccion = $_POST['seleccion'];
$titulo_etiquetas = explode (" <", $seleccion);
$titulo = $titulo_etiquetas[0];

$con=conectar_base_datos();

$qry = "SELECT ofertas.* , usuarios.NOMBRE FROM ofertas INNER JOIN usuarios ON ofertas.EMAIL=usuarios.EMAIL WHERE TITULO='$titulo'";
$rs = mysqli_query($con, $qry);
$anuncio = mysqli_fetch_array($rs);

muestra_anuncio_con_foto($anuncio);
echo '<p align="left" style="clear:both;">';
echo '<a href="buscar_ofertas.php">[ Buscar otra vez ]</a></p>';
mysqli_close($con);
include "pie.php";
?>