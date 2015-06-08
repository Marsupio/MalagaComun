<?php
include "cabecera_inicio.php";
include "conectar_bd.php";
?>
<h3>Fondo Comunitario de Málaga Común</h3><br>

<p align="left"><img src='imagenes/usuarios/598.png' style='float:right' height='250px'>El Fondo Comunitario de Málaga Común tiene como misión financiar proyectos enfocados al desarrollo de la red de Málaga Común, pues cuanto más grande sea ésta, más productos y servicios habrán disponibles para todos sus miembros. 
Cualquier usuario con saldo positivo (preferiblemente mayor que 100) que quiera contribuir, podrá hacerlo. Además podrá recuperar lo invertido cuando lo desee.<br>
Para colaborar con el fondo simplemente <a href="mostrar_usuario.php?email=fondocomunitario@malagacomun.org&anuncio=Financiaci%C3%B3n%20de%20proyectos">&raquo;&raquo; entra aquí &laquo;&laquo;</a> y realiza una transferencia a su favor ('enviar un pago').<br></p>

<div style="text-align:left">
	<h4 style="display:inline">Próximo proyecto a financiar: </h4>Acondicionamiento del local para la ecotienda: limpieza, pintura, mobiliario... <br>
	<h4 style="display:inline">Presupuesto: </h4>Por determinar <br>
</div>

<table>
	<tr><th>Listado de Contribuyentes</th><th>Cantidad Aportada (comunes)</th></tr>
	<?php
		$suma = 0;
		$con = conectar_base_datos();
		$qry1 = "SELECT * FROM pagos WHERE RECEPTOR='Fondo Comunitario de Málaga Común'";
		$rs1 = mysqli_query($con, $qry1);
		while ($pago = mysqli_fetch_array ($rs1))
		{
			echo '<tr><td>'.$pago['PAGADOR'].'</td><td>'.$pago['CANTIDAD'].'</td></tr>';
			$suma += $pago['CANTIDAD'];
		}
		// A continuación se listan los que contribuyeron a través de un cobro
		$qry2 = "SELECT * FROM pagos WHERE PAGADOR='Fondo Comunitario de Málaga Común' AND CANTIDAD<0";
		$rs2 = mysqli_query($con, $qry2);
		while ($pago = mysqli_fetch_array ($rs2))
		{
			echo '<tr><td>'.$pago['RECEPTOR'].'</td><td>'.-$pago['CANTIDAD'].'</td></tr>';
			$suma += -$pago['CANTIDAD'];
		}
		echo '</table><br>';
		echo 'Suma Total de Contribuciones: '.$suma.' comunes';		
		mysqli_close($con);	
	?>
