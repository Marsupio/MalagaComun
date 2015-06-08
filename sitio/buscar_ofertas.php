<?php
include ("cabecera_inicio.php");
include ("autocompletar_ofertas.php");

?>
<br><br><br>
<h3 align="left">Buscar oferta</h3>
<form action="mostrar_oferta.php" method="post"> 
		<input id="autocomplete-custom-append" name="seleccion" type="text" required/>
		<div id="suggestions-container" style="position: relative; float: left; width: 400px; margin: 0px;"></div>
		<button class="button"  type="submit" name="buscador">Ver oferta</button>Si existe lo que buscas, debe aparecer a medida que lo escribes
</form>

<?php include ("pie.php"); ?>