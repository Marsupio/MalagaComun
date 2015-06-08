<?php
include 'conectar_bd.php';
include ("cabecera_inicio.php");
include ("autocompletar_usuarios.php");
echo '<h2 align="left">Búsqueda de transacciones por usuario</h2><br><br>';

?>

<form action="transacciones_realizadas.php" method="post">
Nombre del usuario:
<br> 
		<input id="autocomplete-custom-append" name="seleccion" type="text" required/>
			<div id="suggestions-container" style="position: relative; width: 600px; margin: 0px;"></div>
			<br>
			<label for="uno" style="display: inline">
			<input id="uno" style="float: left; margin: 0" type="radio" name="tipo" value="recibidos" checked />
			&nbsp; ver pagos recibidos <br>
			</label>
			<label for="dos" style="display: inline">
			<input id="dos" style="float: left" type="radio" name="tipo" value="realizados" />&nbsp; ver pagos realizados<br>
			</label>
		<button class="button" type="submit" name="pagos">Ver transacciones</button>
</form>

<?php
include ("pie.php");
?>