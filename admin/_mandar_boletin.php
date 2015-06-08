<?php 
include ("funciones.php");
include ("cabecera_administrador2.php");
/********************************************************/
if ($_POST)
{
/* compongo el cuerpo del email que lleva las ofertas y demandas entre esas dos fechas */
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];


if  (($fecha_inicio!='') &&($fecha_fin!='') )
{
		if  ((strlen($fecha_inicio)==10)&&(strlen($fecha_fin)==10))
		{
					
			echo '<br /><h2>Va a enviar  las ofertas y demandas publicadas entre las fechas: </h2>';

?>


<!-- ****************** div cargando ******************************************************* -->
<div id="cargando" >

	<img src="imagenes/cargando.gif" alt="" width="200px"  />

</div>
<!-- ----------------- estilo del gif  de cargando ------------------------------------------------------------- -->
<style>
#cargando 
{
	
	position:absolute;
	top:50%;
	left:50%;
	
	background-color:transparent;
	border: 0px;
	outline:none;
	
	width: 200px;


	visibility:hidden;
	z-index:100;
	
}

</style>

<!-- ------- creo la funcion que oculta o no el div ----------------------------------------------------------- -->
<script type="text/javascript" />
function muestra_cargando()
{
	document.getElementById("cargando").style.visibility="visible";	
}
</script>
<!-- ------------------------------------------------------------------------------------------------------------- -->


<form action="mandar_boletin2.php?fecha_inicio=<?php echo $fecha_inicio ?>&fecha_fin=<?php echo $fecha_fin ?>" method="POST"  accept-charset="utf-8">

<br />
<input  name="fecha_inicio" type="text"  placeholder="<?php echo $fecha_inicio ?>" readonly >
<br />
<input  name="fecha_fin" type="text"  placeholder="<?php echo $fecha_fin ?>"    readonly >
<br />

<a class="button" href="mandar_boletin.php">Corregir fechas</a>
<button class="button" onClick="javascript: muestra_cargando();"   type="submit" >Aceptar</button>

</form>
<br/>

<?php
			
		}
		else
		{

			echo '<p  align="left"><b>Error: </b>Formato de fecha no correcto.<br/> El formato correcto son dos números para el día, dos números para el mes y cuatro números para el año separados por barras a la derecha. Si el día o el mes es menor de diez hay que ponerle u cero delante, como por ejemplo: 31/01/2012 ó 01/05/2013</p>';	
		}


}

}
/************************************************/
if (!$_POST)
{
?>
<br />
<h2>Enviar Boletín de Ofertas y Demandas a todos los usuarios.</h2>

<p>Para elegir el  boletín que quiere enviar a todos los usuarios de Málaga Común seleccione dos fechas. La de inicio y la de fin.</p>

<p> El sistema enviará las ofertas y demandas publicadas entre esas dos fechas a todos los usuarios de Málaga Común. Si se trata de un boletín mensual, seleccione el primer dia del mes  y el último día del mismo mes. Nótese que con este sistema puede elegir cualquier rango de tiempo, tales como varios dias, un mes, dos meses, unas cuantas semanas, o el tiempo que quiera.</p>

<p>El formato correcto son dos números para el día, dos números para el mes y cuatro números para el año separados por barras a la derecha y en ese orden. Si el día o el mes es menor de diez hay que ponerle u cero delante, como por ejemplo: El 31 de enero del 2012: 31/01/2012 ó  el 1 de  mayo del 2013: 01/05/2013</p>

<form action="mandar_boletin.php" method="POST"  accept-charset="utf-8-es">

Fecha de inicio:
<input id="formulario" name="fecha_inicio" type="text"    required  > 
<br /> 


Fecha de fin:
<input id="formulario" name="fecha_fin" type="text"    required  > 
<br /> 

<button class="button" type="reset">Borrar</button>
<button  class="button" type="submit">Continuar</button>	

</form>
<br>


<?php	
}
/********************************************************/
include("pie.php");
?>