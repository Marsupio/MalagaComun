<?php
include ("funciones.php");
include ("cabecera_administrador.php");

if (!$_POST)
{

?>

<center>
<br />
<p align="center" id="titulo2">Añadir anotación de mejora del software ya realizada:<p>

<form  action="mejoras.php" method="POST" lang="es">

<table align="center" width="90%" border="0px solid #000"  style="text-align:left;">

<tr>       
<td width="20%">Detalles de los cambios y mejoras realizadas</td>
<td colspan="3">
<textarea id="formulario2" name="texto" type="text" size="63%"  rows="10" cols="63%" required /> </textarea>
</td>
</tr>

<tr>
<td width="20%"><br />Grado de dificultad</td>
<td><br />

<SELECT name="dificultad"> 

   <OPTION VALUE="Muy Fácil">Muy Fácil</OPTION> 
   <OPTION VALUE="Fácil">Fácil</OPTION> 
   <OPTION VALUE="Normal">Normal</OPTION> 
   <OPTION VALUE="Difícil">Difícil</OPTION> 
   <OPTION VALUE="Muy Difícil">Muy Difícil</OPTION> 
   
</SELECT> 
</td>

<tr>
<td style="text-align:left"><br/><br/><button type="reset">Borrar lo escrito</button>	 </td>   
<td colspan="3" style="text-align:right"><br><br><button type="submit">Guardar Anotación de Mejora</button>	 </td>
</tr>

</table>
</form>

<br />
<br />
</center>

<?php
}

else
{

$texto=$_POST['texto'];
$dificultad=$_POST['dificultad'];
$fecha=obten_fecha();

	if (strlen($texto)>3)
	{
		$conexion=conectar_base_datos();
		mysql_query("insert into mejoras (TEXTO,FECHA,DIFICULTAD) values ('$texto','$fecha','$dificultad')");
		mysql_close($conexion);	
		echo'<p align="center" style=" font-weight:normal; font-size:17px; color:#000;">Mejora marcada como realizada.</p>';
	}
	else
	{
		echo'<br><p align="center" style=" font-weight:normal; font-size:17px; color:#a00;">Se debe de detallar los cambios realizados en el sistema.</p>';
		echo '<br>';
	}

}
/****************************************************/
include ("pie.php");
?>