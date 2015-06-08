<?php
include 'conectar_bd.php';
include ("cabecera_inicio.php");
include ("autocompletar_pagos.php");

echo '<h2 align="left">Búsqueda de transacciones por usuarios</h2>';
echo '<p align="left">Si quieres ver todos los pagos realizados o recibidos por alguien escribe un asterisco * en el campo correspondiente. Si no aparece el email del usuario junto a su nombre es que se dio de baja del sistema.</p>';
?>

<form action="transacciones_realizadas.php" method="post">
		Nombre del pagador:
		<br> 
				<input id="autocomplete-custom-append-1" name="pagador" type="text" />
					<div id="suggestions-container-1" style="position: relative; width: 600px; margin: 0px;"></div>
		<br>
		Nombre del receptor:
		<br> 
				<input id="autocomplete-custom-append-2" name="receptor" type="text" />
					<div id="suggestions-container-2" style="position: relative; width: 600px; margin: 0px;"></div>
		<br>
	<button class="button" type="submit" name="pagos">Ver transacciones</button>
</form>

<?php
include ("pie.php");
?>