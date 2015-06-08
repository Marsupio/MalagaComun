<?php
include ('cabecera_inicio.php');
include ('funciones.php');


	$id=$_GET['id'];
	
	$conexion=conectar_base_datos();
	$rs=mysql_query("SELECT * FROM pagos WHERE ID='$id' ");

	$fila=mysql_fetch_array($rs);
	
	$pagador=$fila['PAGADOR'];
	$email_pagador=$fila['EMAIL_PAGADOR'];
	$receptor=$fila['RECEPTOR'];
	$email_receptor=$fila['EMAIL_RECEPTOR'];
	$cantidad=$fila['CANTIDAD'];
	$fecha=$fila['FECHA'];
	$titulo=$fila['TITULO'];
	$comentario=$fila['COMENTARIO'];
	$valoracion=$fila['VALORACION'];
								
	
  	echo '<table>';

    echo "<tr ><th >Recibo Nº ".$id."</th></tr>";	
	
    echo "<tr><td>Pagador: <br/>" . $pagador . " (" . $email_pagador . ")</td></tr>
				<tr><td>Receptor: <br/> " . $receptor . " (" . $email_receptor . ")</td></tr>
				<tr><td>Cantidad: " . $cantidad . " comunes</td></tr>
				<tr><td>Pagado el " . $fecha . "</td></tr>	
				<tr><td>Concepto: <br/> " . $titulo . "</td></tr>							
				<tr><td>Comentarios:  <br/>" . nl2br($comentario) . "</td></tr>";
	
//	echo '<tr align="left"><td colspan="2"><a class="button" href="consulta1.php?pg=1">Volver</a></tr>';
	
    echo "</table>";


mysql_close($conexion);

include ('pie.php');
?>