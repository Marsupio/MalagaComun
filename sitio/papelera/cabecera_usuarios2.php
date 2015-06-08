<?php
include ("seguridad.php");
?>
<!-- comienzo de la plantilla -->

<!DOCTYPE HTML>
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Málaga Común</title>

	<link rel="STYLESHEET" type="text/css" href="estilo_sitio.css"/> 

	<script type="text/javascript" src="ajax.js"> </script>

</head>


<body>

<div id="contenedor">
<!-- ***************************************************************************** -->
<div id="cabecera">
<center>
	<img id="imagen" src="imagenes/logo3.jpg" height="100%"/> 
</center>
</div>
<!-- ***************************************************************************** -->
<div id="linea_encima_menu_horizontal">

    
</div>
<!-- ***************************************************************************** -->
<div id="menu_horizontal">
<ul>
	<li id="menu_inactivo"> <a href="inicio.php">Mis Datos</a></li>
	<li id="menu_activo"> <a href="usuarios.php"><span id="texto_activo">Usuarios</span></a></li>
	<li id="menu_inactivo"> <a href="anuncios.php">Anuncios</a></li>
	<li id="menu_inactivo"> <a href="contactar.php">Contactar</a></li>
	<li id="menu_inactivo"> <a href="sugerencias.php?pg=1">Sugerencias</a></li>
	<li id="menu_inactivo"> <a href="calendario.php">Calendario</a></li>
	<li id="menu_inactivo"> <a href="estadisticas.php">Estadisticas</a></li>
        
	<li id="menu_inactivo"> <a href="fin_sesion.php">Salir</a></li>
</ul>
</div>
<!-- ***************************************************************************** -->
<div id="menu1">
 
    <ul class="nav">

      <li id="texto_invisible_menu">*</li>
      <li><a href="mostrar_usuarios.php">Mostrar Listado de Usuarios</a></li>
      <li><a href="ordenar_usuarios.php?orden=nombre">Ordenar por Nombre</a></li>
      <li><a href="ordenar_usuarios.php?orden=apellidos">Ordenar por Apellido</a></li>
      <li><a href="ordenar_usuarios.php?orden=telefono">Ordenar por Teléfono</a></li>      
      <li><a href="ordenar_usuarios.php?orden=email">Ordenar por E-mail</a></li>    
      <li><a href="ordenar_usuarios.php?orden=comunes_positivos">Ordenar por menos comunes</a></li>      
      <li><a href="ordenar_usuarios.php?orden=comunes_negativos">Ordenar por más comunes</a></li> 
      <li id="texto_invisible_menu">*</li>         

	  <li><a href="buscar_usuario.php">Buscar a un usuario</a></li> 
      <li id="texto_invisible_menu">*</li>         
      
	  <li><a href="consulta1.php?pg=1">Ver Lista de Pagos</a></li>
	  <li><a href="buscar_pagos.php">Buscar Pagos realizados</a></li>                  
	  <li><a href="buscar_y_pagar.php">PAGO DIRECTO</a></li>  
      <li id="texto_invisible_menu">*</li>      
               
      <li><a href="mapa.php">Mapa de Usuarios</a></li> 
      <li id="texto_invisible_menu">*</li>               

   
    </ul>

</div>  
<!-- ***************************************************************************** -->
<div class="bordes_y_sombra" id="contenido">


<!-- sitio para el contenido de la subpagina del sitio -->










