<?php 
if ($_SESSION['ROL']==inactivo) 
{
	header("Location: aviso_inactivos.php");
}
else 
{
	header("Location: novedades.php");
} 
?>

