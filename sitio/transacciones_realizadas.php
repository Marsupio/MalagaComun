<?php
include ('cabecera_inicio.php');
include ('funcs_sitio.php');

$con=conectar_base_datos();

$pagador_selec=$_POST['pagador'];
$receptor_selec=$_POST['receptor'];

switch ($pagador_selec)
{
	case '*':
		switch ($receptor_selec)
		{
			case '*':
				$qry = "SELECT * FROM pagos ORDER BY ID DESC";
				echo "<h3>Pagador: Todos <br> Receptor: Todos</h3><br>" ;
				break;
			default:
				$array_receptor_email = explode (" <", $receptor_selec);
				$email_receptor = trim ($array_receptor_email[1],'>');
				$nombre_receptor = $array_receptor_email[0];
				if ($email_receptor == '')
					$qry = "SELECT * FROM pagos WHERE RECEPTOR='$nombre_receptor' ORDER BY ID DESC";
				else
					$qry = "SELECT * FROM pagos WHERE EMAIL_RECEPTOR='$email_receptor' ORDER BY ID DESC";
				echo "<h3>Pagador: Todos <br> Receptor: $nombre_receptor</h3><br>" ;
		}
		break;
	default:
		$array_pagador_email = explode (" <", $pagador_selec);
		$email_pagador = trim ($array_pagador_email[1],'>');
		$nombre_pagador = $array_pagador_email[0];
		switch ($receptor_selec)
		{
			case '*':
				if ($email_pagador == '')
					$qry = "SELECT * FROM pagos WHERE PAGADOR LIKE '$nombre_pagador' ORDER BY ID DESC";
				else
					$qry = "SELECT * FROM pagos WHERE EMAIL_PAGADOR='$email_pagador' ORDER BY ID DESC";
				echo "<h3>Pagador: $nombre_pagador <br> Receptor: Todos</h3><br>" ;
				break;
			default:
				$array_receptor_email = explode (" <", $receptor_selec);
				$email_receptor = trim ($array_receptor_email[1],'>');
				if ($email_pagador == '')
					$qry = "SELECT * FROM pagos WHERE PAGADOR LIKE '$nombre_pagador' AND EMAIL_RECEPTOR='$email_receptor' ORDER BY ID DESC";
				else
					$qry = "SELECT * FROM pagos WHERE EMAIL_PAGADOR='$email_pagador' AND EMAIL_RECEPTOR='$email_receptor' ORDER BY ID DESC";		
				echo "<h3>Pagador: $nombre_pagador <br> Receptor: $array_receptor_email[0]</h3><br>";
		}
}		

	$rs = mysqli_query($con, $qry);

	if (mysqli_num_rows($rs)==0)
	{
			echo '<p align="center">No existen transacciones a mostrar</p>';
	}
	else
	{
			//muestra los datos consultados
			while ($pago = mysqli_fetch_array($rs))
			{	
				muestra_pago($pago);
			}
	}

include('pie.php');
mysqli_close($con);
?>