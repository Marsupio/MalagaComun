<?php
include ("cabecera_inicio.php");
include ("funciones.php");


$conexion=conectar_base_datos();

// ****** consigue el pago más alto ***********/
$ssql1 = "SELECT MAX(CANTIDAD) AS maximo FROM pagos"; 
$rs1 = mysql_query($ssql1); 
$row1 = mysql_fetch_array($rs1);
$mayor=$row1['maximo'];

/******** selecciona todos los pagos   ***************/
$ssql = "SELECT * FROM pagos ORDER BY ID ASC"; 
$rs = mysql_query($ssql,$conexion); 


echo '<h2 align="left">Histórico de pagos a lo largo del tiempo</h2>';
echo '<p align="left">((( A continuación se muestra el histórico de pagos realizados desde el inicio )))</p>';
echo '<p align="left">La longitud de la barra indica la cantidad de comunes movidos en ese intercambio. Mientras más larga sea mayor importe.<br> Si desea ver los detalles de ese pago, o ve algún importe de una cantidad fuera de lo normal o muy exagerado, pulse el botón "Detalles" para comprobar ese pago en cuestión.</p>';



while($row = mysql_fetch_array($rs))
{
	$id=$row['ID'];
	$pagador=$row['PAGADOR'];
	$email_pagador=$row['EMAIL_PAGADOR'];
	$titulo=$row['TITULO'];
	$receptor=$row['RECEPTOR'];
	$email_receptor=$row['EMAIL_RECEPTOR'];
	$cantidad=$row['CANTIDAD'];
	$comentario=$row['COMENTARIO'];
	$fecha=$row['FECHA'];

	$valor=round(($cantidad/$mayor)*100,0);
	
?>

<table style="width:<?php echo $valor+25 ?>%; padding:0; margin:2px 0px; border:0; font-size:0.7em;">

<tr>
<th>


<?php


echo 'Recibo nº '. $id .', '.$cantidad.' comun(es) ';


echo '<a class="boton"  href="muestra_recibo.php?id='.$id.'&pagador='.$pagador.'&email_pagador='.$email_pagador.'&titulo='.$titulo.'&receptor='.$receptor.'&email_receptor='.$email_receptor.'&cantidad='.$cantidad.'&comentario='.$comentario.'&fecha='.$fecha.' ">Detalles</a>';


?>

</th>
</tr>



</table>


<?php
}
//**********************************************************//
include ("pie.php"); 
?>


