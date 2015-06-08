<?php 
include ("cabecera_administrador2.php");
/********************************************************/
$tipo = $_GET['tipo'];
?>


	<br />
	<h2>Enviar Boletín de <?php echo $tipo ?> a los usuarios activos.</h2>

<form action="boletin2.php" method="POST" accept-charset="utf-8-es">
	Tipo de anuncios a enviar:
	<input id="formulario" name="tipo" type="text" value="<?php echo $tipo ?>" required  > 
	<br /> 
	Cantidad de anuncios a enviar:
	<input id="formulario" name="cantidad_anuncios" type="number" required  > 
	<br /> 
	<button  class="button" type="submit">Continuar</button>	

</form>
	<br>
<?php
include("pie.php");
?>