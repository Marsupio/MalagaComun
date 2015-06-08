<?php
include ("funciones.php");
include ("cabecera_administrador2.php");
include("config_local.php") ;

	$id=$_GET["id"];

	//conecto con la base de datos
	$conexion = conectar_base_datos();
	//Sentencia SQL para buscar un usuario con esos datos 
	$ssql = "SELECT * FROM eventos WHERE (ID='$id')"; 
	//Ejecuto la sentencia 
	$rs = mysql_query($ssql,$conexion);
	//Obtengo la fila en cuestion
	$row = mysql_fetch_array($rs);
	
	$evento=$row["EVENTO"];
	$lugar=$row["LUGAR"];
	$fecha=$row["FECHA"];
	$inicio=$row["INICIO"];
	$fin=$row["FIN"];
	$notas=$row["NOTAS"];
	
	
?>	

<h2>Escriba, modifique, añada o borre lo que considere oportuno a este evento programado:</h2>

<form action="actualizar_evento.php?id=<?php echo $id ?>" method="POST" accept-charset="UTF-8">

<br />
Evento 
<input   type="text" name="evento" size="100%" maxlength="200" value="<?php echo $evento ?>" />


<br />
Lugar 
<input   type="text" name="lugar" size="100%" maxlength="200" value="<?php echo $lugar ?>" />


<br />
Fecha 
<input  type="date"  name="fecha" value="<?php echo $fecha ?>">


<br />
Hora inicio
<input type="time" name="hora" value=<?php echo $hora ?>




<br />


<br />
Notas 
<textarea  type="text" name="notas" rows='5'/><?php echo $notas ?></textarea>

<br />
<input class="button"  type="submit" value="Modificar este evento con estos nuevos datos" />

</form>


<?php 	include('pie.php'); ?>