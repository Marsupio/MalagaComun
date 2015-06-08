<?php
include ('cabecera_inicio.php');
include ('funciones.php');

$email_pagador=$_SESSION['EMAIL'];

$conexion=conectar_base_datos();
$result=mysqli_query($conexion, "SELECT * FROM pagos WHERE (EMAIL_PAGADOR='$email_pagador')  ORDER BY  ID DESC");

//muestra los datos consultados
echo '<h2>Pagos que has realizado</h2>';
echo '<p align="center">Se muestran los pagos más recientes al principio y los más antiguos al final.</p>';
while ($fila=mysqli_fetch_array($result))
{

	$id=$fila['ID'];	
	$pagador=$fila['PAGADOR'];
	$email_pagador=$fila['EMAIL_PAGADOR'];
	$titulo=$fila['TITULO'];
	$receptor=$fila['RECEPTOR'];
	$email_receptor=$fila['EMAIL_RECEPTOR'];
	$cantidad=$fila['CANTIDAD'];
	$comentario=$fila['COMENTARIO'];
	$fecha=$fila['FECHA'];
	
	$email_receptor=str_replace('@',' @ ',$email_receptor);
	
  	echo '<table id="tabla_recibo" align="center" >';

    echo "<tr ><th width='30%'>Recibo Nº</th> <th>".$id."</th></tr>";	
	
    echo "<tr> <td>Concepto</td> <td>" . $titulo . "</td></tr>";
    echo "<tr> <td>Receptor del Pago</td> <td>" . $receptor . "</td></tr>";
    echo "<tr> <td>Email Receptor Pago</td> <td>" . $email_receptor . "</td></tr>";
    echo "<tr> <td>Cantidad Abonada</td> <td><span style='color:green; font-size:1.3em;'>" . $cantidad . "</span> comunes</td></tr>";
    echo "<tr> <td>Comentarios</td> <td>" . $comentario . "</td></tr>";
    echo "<tr> <td>Fecha</td> <td>" . $fecha . "</td></tr>";
	
	
    echo "</table>";
	
}

	echo '<a class="button"  href="mis_pagos_realizados.php">Volver</a>';

include('pie.php');
mysqli_close($conexion);
?>