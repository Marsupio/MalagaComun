<?php
include ("funciones.php");
include ("cabecera_inicio.php");

if (!$_POST)
{

$email_pagador=$_SESSION['EMAIL'];
$nombre_pagador=$_SESSION['NOMBRE'];
$apellidos_pagador=$_SESSION['APELLIDOS'];
$pagador=$nombre_pagador.' '.$apellidos_pagador;


?>

<center>
<br />
<p align="left" id="titulo2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<b>PAGO directo</b>&nbsp;a favor de un usuario de la comunidad.<p>

<form  action="pago_directo.php" method="POST" lang="es">

<table align="center" width="90%" border="0px solid #000"  style="text-align:left;">

<tr>       
<td>Tu Nombre</td>
<td colspan="3"><input id="formulario3" name="pagador" type="text" size="75%" required readonly="readonly" value="<?php echo $pagador  ?>" />
</td>
</tr>

<tr>       
<td>Tu Email</td>
<td colspan="3"><input id="formulario3" name="email_pagador" type="text" size="75%" required  readonly="readonly" value="<?php echo $email_pagador; ?>"/>
</td>
</tr>


<tr>       
<td>Datos del receptor del pago</td>
<td colspan="3"><?php mostrar_lista_usuarios() ?></td>
</tr>


<tr>       
<td>Cantidad (comunes en números)</td>
<td colspan="3"><input id="formulario3" name="cantidad" type="text" size="75%" placeholder="" required onFocus="this.style.backgroundColor='#FFFF99'" onBlur="this.style.backgroundColor='#FFFF99'" />
</td>
</tr>

<tr>       
<td>Concepto o Descripción</td>
<td colspan="3"><textarea id="formulario3" name="comentario" type="text" size="75%"  rows="5" cols="75%" /> </textarea>
</td>
</tr>

<tr>
<td style="text-align:left"><button type="reset">Borrar</button>	 </td>   
<td colspan="3" style="text-align:right"><button type="submit" name="enviar">Efectuar el Pago</button>	 </td>
</tr>

</table>
</form>

<br />
<br />
</center>

<?php
}


if ($_POST)
{
$id_pagador=$_SESSION['ID'];
$nombre_pagador=$_SESSION['NOMBRE'];
$apellidos_pagador=$_SESSION['APELLIDOS'];
$pagador=$nombre_pagador.' '.$apellidos_pagador;
$email_pagador=$_SESSION['EMAIL'];
$titulo='Modalidad de Pago Directo';
$email_receptor=$_POST["email_usuario_destino"];
$receptor=obten_nombre_usuario_por_email($email_receptor);
$cantidad=$_POST['cantidad'];
$comentario=$_POST['comentario'];
$fecha=obten_fecha();

insertar_pago_directo($pagador, $email_pagador, $titulo, $receptor, $email_receptor, $cantidad, $comentario, $fecha);

/****************** actualizacion de los comunes de pagador y receptor***************************************/
$resultado=mysql_query("SELECT * FROM usuarios WHERE EMAIL='$email_pagador'");
$fila=mysql_fetch_array($resultado);
$saldo_pagador=$fila[7];
$saldo_pagador_actualizado=$saldo_pagador-$cantidad;
mysql_query("UPDATE usuarios SET COMUNES=$saldo_pagador_actualizado WHERE EMAIL='$email_pagador'");

$resultado=mysql_query("SELECT * FROM usuarios WHERE EMAIL='$email_receptor'");
$fila=mysql_fetch_array($resultado);
$saldo_receptor=$fila[7];
$saldo_receptor_actualizado=$saldo_receptor+$cantidad;
mysql_query("UPDATE usuarios SET COMUNES=$saldo_receptor_actualizado WHERE EMAIL='$email_receptor'");


enviar_email_aviso_pago($email_receptor,$pagador,$cantidad,$titulo);

/*************************************************************************************************************/

echo '<br>';
echo '<p align="center" id="titulo6">Se ha realizado correctamente su pago.</p>';
echo '<br>';
	
}

include ("pie.php");
?>