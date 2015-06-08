<?php
include ("funciones.php");
include ("cabecera_inicio.php");

if (!$_POST)
{

$email_pagador=$_SESSION['EMAIL'];
$nombre_pagador=$_SESSION['NOMBRE'];
$apellidos_pagador=$_SESSION['APELLIDOS'];
$pagador=$nombre_pagador.' '.$apellidos_pagador;

$id=$_GET["id"];
$titulo=$_GET["titulo"];
$receptor=$_GET["usuario"];
$email_receptor=$_GET["email"];

?>

<center>
<br />
<p align="left" id="titulo2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;<b>PAGO directo</b>&nbsp;a favor de un usuario de la comunidad que te ha ofrecido un servicio.<p>

<form  action="insertar_pago_anuncio.php" method="POST" lang="es">

<table align="center" width="90%" border="0px solid #000"  style="text-align:left;">

<tr>       
<td>Tu Nombre</td>
<td colspan="3"><input id="formulario3" name="pagador" type="text" size="63%" required readonly="readonly" value="<?php echo $pagador  ?>" />
</td>
</tr>

<tr>       
<td>Tu Email</td>
<td colspan="3"><input id="formulario3" name="email_pagador" type="text" size="63%" required  readonly="readonly" value="<?php echo $email_pagador; ?>"/>
</td>
</tr>

<tr>       
<td><br /></td>
<td colspan="3"><br /></td>
</tr>

</tr>
<td style="text-align:left" >Título del anuncio</td>
<td > <input id="formulario3" name="titulo" type="text" size="63%" value="<?php echo $titulo; ?>" required readonly="readonly" /> </td>
</tr>


</tr>
<td ><br /></td>
<td > <br /> </td>
</tr>

<tr>       
<td>Nombre del receptor del pago</td>
<td colspan="3"><input id="formulario3" name="receptor" type="text" size="63%" value="<?php echo $receptor; ?>" required readonly="readonly" /></td>
</tr>

<tr>       
<td>Email del receptor del pago</td>
<td colspan="3"><input id="formulario3" name="email_receptor" type="text" size="63%" value="<?php echo $email_receptor; ?>" required  readonly="readonly"/></td>
</tr>

</tr>
<td ><br /></td>
<td > <br /> </td>
</tr>

<tr>       
<td>Cantidad (comunes en números)</td>
<td colspan="3"><input id="formulario3" name="cantidad" type="text" size="63%" placeholder="" required onFocus="this.style.backgroundColor='#FFFF99'" onBlur="this.style.backgroundColor='#FFFF99'" />
</td>
</tr>

<tr>       
<td>Comentario (si lo cree oportuno)</td>
<td colspan="3"><textarea id="formulario3" name="comentario" type="text" size="63%"  rows="5" cols="63%" /> </textarea>
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

include ("pie.php");
?>