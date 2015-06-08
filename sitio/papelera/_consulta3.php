<?php
include ('cabecera_inicio.php');
include ('funciones.php');

$seleccion=$_GET['seleccion'];
$tipo=$_GET['tipo'];
$con=conectar_base_datos();

if ($tipo='realizados')
{
		$result=mysqli_query($con, "select * from pagos where (EMAIL_PAGADOR='$email') ORDER BY ID DESC");

		if (mysqli_num_rows($result)==0)
		{
				echo '<p align="center">El usuario aún no hay realizado ningún pago.</p>';
		}
		else
		{
				//muestra los datos consultados
				while ($pago = mysqli_fetch_array($result))
				{	
					muestra_pago($pago);
				}
		}
else
{
		$result=mysqli_query($con, "select * from pagos where (EMAIL_RECEPTOR='$email') ORDER BY ID DESC");

		if (mysqli_num_rows($result)==0)
		{
				echo '<p align="center">El usuario aún no hay realizado ningún pago.</p>';
		}
		else
		{
				//muestra los datos consultados
				while ($pago = mysqli_fetch_array($result))
				{	
					muestra_pago($pago);
				}
		}
}
include('pie.php');
mysqli_close($con);
?>