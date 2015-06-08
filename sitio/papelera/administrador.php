<?php
include ("cabecera_administrador.php");
include ("funciones.php");
?>
<!-- **************************contenido del div contenido******************** -->
<center>

<form action="control2.php" method="POST" accept-charset="UTF-8"> 

<?php
if ($_GET["errorusuario"]=="si")
{
	echo '<p style="color:#ff0000">Datos incorrectos. Por favor vuelva a intentarlo.</p>';
}
else
{
	echo '<p style="color:#000000">Indique su nombre de usuario y contraseña</p>';
}
?>


<p style="font-style:oblique">Recuerde que se distingue entre letras mayúsculas y minúsculas, (no es lo mismo 'Juan' que 'juan').</p>

<table>
<tr>
<td><p>Usuario:</p></td>
<td><input id="formulario" type="text" name="ALIAS" size="40" maxlength="200"><td>
</tr>

<tr>
<td><p>Contraseña:</p></td>
<td><input id="formulario" type="password" name="CLAVE" size="40" maxlength="200"></td>
</tr>

<tr>
<td style="text-align:right"><br /><br /><input id="boton" type="reset" value="Borrar"></td>
<td style="text-align:right"><br /><br /><input id="boton" type="submit" value="Entrar a Málaga Común"></td>
</tr>

</table>

</form>







</center>
<!-- **********************fin del contenido del div contenido******************** -->
<?php include ("pie.php"); ?>