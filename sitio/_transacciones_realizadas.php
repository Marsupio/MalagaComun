<?php
include ('cabecera_inicio.php');
include ('funcs_sitio.php');

$seleccion=$_POST['seleccion'];
$tipo=$_POST['tipo'];
$con=conectar_base_datos();
$nombre_email = explode (" <", $seleccion);
$email = trim ($nombre_email[1],'>');
echo "<h3>Pagos $tipo por $nombre_email[0]</h3><br>" ;

if ($tipo=='realizados')
{
		$result=mysqli_query($con, "select * from pagos where EMAIL_PAGADOR='$email' ORDER BY ID DESC");

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
else
{
		$result=mysqli_query($con, "select * from pagos where EMAIL_RECEPTOR='$email' ORDER BY ID DESC");

		if (mysqli_num_rows($result)==0)
		{
				echo '<p align="center">El usuario aún no hay recibido ningún pago.</p>';
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