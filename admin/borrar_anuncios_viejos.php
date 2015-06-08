<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
 
if (!$_POST)
{
?>

<br />
<h2>Borrado y eliminación de anuncios viejos.</h2>

<h3 style="color:#a11">Advertencia:<br> Una vez escrita una fecha y pulsado el botón 'Borrar Anuncios Viejos', se le pedirá la confirmación y una vez haya aceptado, se eliminarán todos los anuncios (tanto ofertas como demandas) publicados antes de la fecha introducida.</h3>

<p>El formato correcto para la fecha son dos números para el día, dos números para el mes y cuatro números para el año separados por barras a la derecha y en ese orden. Si el día o el mes es menor de diez hay que ponerle u cero delante, como por ejemplo: El 31 de enero del 2012: <b>31/01/2012</b> ó  el 1 de  mayo del 2013: <b>01/05/2013</b></p>

<form action="borrar_anuncios_viejos.php" method="POST">


<b>Escriba una fecha en el formato correcto:</b> <br>

<input  type="text"  name="fecha" required />
<input class="button" type="submit" value="Borrar Anuncios Viejos" />


</form>

<br/>
<?php
}

if ($_POST)
{	
	$fecha=$_POST['fecha'];
	if ($fecha!='')
	{
		if (($fecha[2]=='/')&&($fecha[5]=='/')&&(strlen($fecha)==10))
		{
			echo '<br><p align="center">¿Borrar todos los anuncios anteriores al '.$fecha.'?</p>';

			echo '<p align="center" style="color:red">Advertencia: Esta operación no es reversible.</p>';
			
			echo '<a class="button" href="borrar_anuncios_viejos.php">Cancelar</a>';
			
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			
			echo "<a class='button' href='borrar_anuncios.php?fecha=$fecha'>Aceptar</a>";
			
			echo '<br/>';
		}
		else
		{
			echo '<p align="center"><br/><b>Error: </b>Formato de fecha no correcto.<br/> El formato correcto son dos números para el día, dos números para el mes y cuatro números para el año separados por barras a la derecha, como por ejemplo: 12/01/2012 ó 01/05/2013</p>';	
		}
	}
	elseif ($fecha=='')
	{
		echo '<br><p align="center">Debe seleccionar una fecha.</p>';;
	
	}
}

include ("pie.php");
?>