<?php
include ("funciones.php");
include ("cabecera_administrador.php");

if (!$_POST)
{

$email_pagador=$_SESSION['EMAIL'];
$nombre_pagador=$_SESSION['NOMBRE'];
$apellidos_pagador=$_SESSION['APELLIDOS'];

?>

<center>
<br />
<p align="left" id="titulo2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<b>PAGO directo</b>&nbsp;a favor de un usuario de la comunidad que te ha ofrecido un servicio.<p>

<form  action="insertar_pago_oferta.php" method="POST" lang="es">

<table align="center" width="90%" border="0px solid #000"  style="text-align:left;">

<tr>       
<td>Tu Nombre</td>
<td colspan="3"><input id="formulario2" name="pagador" type="text" size="63%" required readonly="readonly" value="<?php echo $nombre_pagador.' '.$apellidos_pagador;  ?>" />
</td>
</tr>

<tr>       
<td>Tu Email</td>
<td colspan="3"><input id="formulario2" name="email_pagador" type="text" size="63%" required  readonly="readonly" value="<?php echo $email_pagador; ?>"/>
</td>
</tr>

<tr>       
<td><br /></td>
<td colspan="3"><br /></td>
</tr>

</tr>
<td style="text-align:left" >Título del anuncio</td>
<td > <?php muestra_titulo_ofertas() ?> </td>
</tr>


</tr>
<td ><br /></td>
<td > <br /> </td>
</tr>

<tr>       
<td>Nombre del receptor del pago</td>
<td colspan="3"><?php muestra_usuario_receptor() ?></td>
</tr>

<tr>       
<td>Email del receptor del pago</td>
<td colspan="3"><?php muestra_email_receptor() ?></td>
</tr>

<tr>       
<td>Cantidad (comunes en números)</td>
<td colspan="3"><input id="formulario2" name="cantidad" type="text" size="63%" placeholder="" required />
</td>
</tr>

<tr>       
<td>Comentario (si lo cree oportuno)</td>
<td colspan="3"><textarea id="formulario2" name="comentario" type="text" size="63%"  rows="5" cols="63%" placeholder="" required /> </textarea>
</td>
</tr>

<tr>
<td style="text-align:left"><button type="reset">Borrar</button>	 </td>   
<td colspan="3" style="text-align:right"><button type="submit">Efectuar el Pago</button>	 </td>
</tr>



</table>
</form>

<br />
<br />
</center>

<?php
}


?>

<?php

$conexion=conectar_base_datos();


if ($_POST)
{
//inserto el pago en la tabla de pagos
$pagador=$_POST["pagador"];
$email_pagador=$_POST["email_pagador"];
$titulo=$_POST["titulo"];
$receptor=$_POST["receptor"];
$cantidad=$_POST["cantidad"];
$comentario=$_POST["comentario"];

$tipo='oferta';
$fecha=obten_fecha_pago();

/********************************/
if (($titulo=='') or ($receptor==''))
{
	echo '<p align="center">Elija el anuncio del que se trata y el usuario al que va destinado el pago en la lista desplegable.</p>';
	echo '<p align="center"><a href="insertar_pago_oferta.php"><button>Volver a intentarlo</button></a></p>';
}
elseif (($cantidad<=0) or (!is_numeric($cantidad)))
{
	echo '<p align="center">Por favor, especifique los comunes a pagar en número y de un valor mayor que cero.</p>';
	echo '<p align="center"><a href="insertar_pago_oferta.php"><button>Volver a intentarlo</button></a></p>';
}
else
{
mysql_query("insert into pagos (PAGADOR,EMAIL_PAGADOR,TITULO,RECEPTOR,CANTIDAD,COMENTARIO,TIPO,FECHA) values ('$pagador','$email_pagador','$titulo','$receptor','$cantidad','$comentario','$tipo','$fecha')");

/****************** actualizacion de los comunes de pagador y receptor***************************************/
$resultado=mysql_query("SELECT * FROM usuarios WHERE EMAIL='$email_pagador'");
$fila=mysql_fetch_array($resultado);
$saldo_pagador=$fila[7];
$saldo_pagador_actualizado=$saldo_pagador-$cantidad;
mysql_query("UPDATE clientes SET COMUNES=$saldo_pagador_actualizado WHERE EMAIL='$email_pagador'");





/*************************************************************************************************************/
echo'<p align="center" style=" font-weight:bold; font-size:17px; color:#57036C;">Se ha realizado correctamente su pago.</p>';
echo'<p align="center" style="font-size:17px; color:#57036C;">Ahora puede seguir navegando por el sitio.</p>';
}
/*******************************/
}
else
{
echo '<p align="center" style="color:#57036C; font-size:16px;">Por favor rellene correctamente todos los campos. Gracias.</p>';
	
}

mysql_close($conexion);
?>
<!-- --------------------------------------------------------------------- -->
<?php
include ("pie.php");
?>