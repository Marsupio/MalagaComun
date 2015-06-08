<?php
include ("funciones.php");
include ("cabecera_inicio.php");


$conexion=conectar_base_datos();

if ($_POST)
{
//inserto el pago en la tabla de pagos
$pagador=$_POST["pagador"];
$email_pagador=$_POST["email_pagador"];
$titulo=$_POST["titulo"];
$receptor=$_POST["receptor"];
$email_receptor=$_POST["email_receptor"];
$cantidad=$_POST["cantidad"];
$comentario=$_POST["comentario"];
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
mysql_query("insert into pagos (PAGADOR,EMAIL_PAGADOR,TITULO,RECEPTOR,EMAIL_RECEPTOR,CANTIDAD,COMENTARIO,FECHA) values ('$pagador','$email_pagador','$titulo','$receptor','$email_receptor','$cantidad','$comentario','$fecha')");

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

/********************************/
include ("pie.php");


?>