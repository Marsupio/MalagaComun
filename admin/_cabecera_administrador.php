<?php
include ("seguridad.php");
?>
<!-- comienzo de la plantilla -->

<!DOCTYPE HTML>
<html lang="es">

<head>

	<meta charset="utf-8">
	<title>Málaga Común</title>

	<link rel="STYLESHEET" type="text/css" href="estilo_sitio.css"/> 
<!-- ************************************************************************************** -->
<link href="datepicker/redmond.datepick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="datepicker/jquery.min.js"></script>
<script type="text/javascript" src="datepicker/jquery.datepick.js"></script>

<script type="text/javascript">
$(function() {
	$('#popupDatepicker').datepick();
	$('#inlineDatepicker').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>
<!-- ************************************************************************************** -->    
</head>

<body>

<div id="contenedor">
<!-- ***************************************************************************** -->
<!--
<div id="cabecera">
<center>
	<img id="imagen" src="imagenes/logo3.jpg" height="100%"/> 
</center>
</div>
-->
<!-- ***************************************************************************** -->
<div id="menu_horizontal">
<ul>

<!--
	<li id="menu_inactivo"> <a href="usuarios.php">Usuarios</a></li>
	<li id="menu_inactivo"> <a href="anuncios.php">Anuncios</a></li>
       
	<li id="menu_inactivo"> <a href="sugerencias.php?pg=1">Sugerencias</a></li>
	<li id="menu_inactivo"> <a href="calendario.php">Calendario</a></li>

-->    

</ul>
</div>
<!-- ***************************************************************************** -->
<!--
<div id="linea_debajo_menu_horizontal">

    
</div>
-->
<!-- ***************************************************************************** -->
<div id="menu1">
 	<img id="imagen" src="imagenes/logo.jpg" height="100%"/> 

		<ul>
     
	  <li><a href="crear_evento.php">Crear un Evento </a></li>     
	  <li><a href="administrar_eventos.php">Ver y Editar Eventos </a></li> 
   	  <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li> 
	  <li><a href="notificar_usuarios_activos.php">Enviar Email a Usuarios Activos</a></li>  
	  <li><a href="notificar_usuarios_inactivos.php">Enviar Email a Usuarios Inactivos</a></li>
	  <li><a href="gestionar_ofertas.php">Gestionar Ofertas</a></li> 
	  <li><a href="gestionar_demandas.php">Gestionar Demandas</a></li> 
 <!-- 	  <li><a href="borrar_anuncios_viejos.php">Borrar Anuncios Viejos</a></li>  -->
   	  <li><a href="balance_administrador.php">Ver Balance Global </a></li> 
	  <li><a href="gestionar_sugerencias.php">Gestionar Sugerencias </a></li>
	  <li><a href="insertar_categoria.php">Crear Nueva Categoría </a></li>
	  <li><a href="borrar_categoria.php">Borrar Categoría </a></li>
 	  <li><a href="mandar_boletin.php">Mandar Boletín</a></li>
   	  <li><a href="fin_sesion.php">Salir</a></li> 
 
 	</ul>

<br />
<p id="texto_pie">Málaga Común @ 2013</p>

</div>  
<!-- ***************************************************************************** -->
<div  id="contenido">


<!-- sitio para el contenido de la subpagina del sitio -->

