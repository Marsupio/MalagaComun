<?php
include ("cabecera_inicio.php");
include 'conectar_bd.php';
include ("autocompletar_usuarios.php");

?>
<br><br><br>
<h3 align="left">Buscar usuari@</h3>
<form action="mostrar_usuario.php" method="post">
		<input id="autocomplete-custom-append" name="seleccion" type="text" required />
		<div id="suggestions-container" style="position: relative; float: left; width: 400px; margin: 0px;"></div>
		<button class="button"  type="submit" name="buscador">Ver perfil</button>
		Introduce su nombre, apellidos o email
</form>


<?php include ("pie.php");?>