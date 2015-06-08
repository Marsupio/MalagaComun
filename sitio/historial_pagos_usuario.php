<?php
include ('cabecera_inicio.php');
include ('funciones.php');

$titulo=$_GET['titulo_del_pago'];
$pagador=$_GET['pagador_del_pago'];

$con = conectar_base_datos();
$result = mysqli_query($con, "select * from pagos where (PAGADOR='$pagador') ORDER BY ID DESC");

//muestra los datos consultados
echo '<h2>Historial de pagos de un usuario.</h2>';
echo '<p align="center">Se muestran al principio los pagos más recientes y al final los más antiguos.</p>';
while ($pago = mysqli_fetch_array($result))
{
  	muestra_pago($pago);
}
include('pie.php');
// cierrra la conexion
mysqli_close($con);
?>