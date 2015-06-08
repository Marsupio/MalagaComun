<?php
include ("cabecera_administrador2.php");
include ("../sitio/funcs_sitio.php");
include ("admin_conectar_bd.php");
?>
<br>
<h3 align="left"> Cobro de la cuota mensual a los usuarios activos </h3><br><br>

<?php if(!$_POST) 
{?>
	<form action="cobrar_cuota.php" method="POST">
		Cantidad a cobrar: <input type="number" name="valor" min=1>
		<button class="button" type="submit">Cobrar</button>
	</form>
	
<?php
}
else 
{
	echo 'Por favor, deja esta ventana abierta hasta que se actualicen todos los pagos <br><br>';
	$cuota = $_POST['valor'];

		//Datos del pagador  NP->nombre pagador, EP->email pagador
		$pago['NP']='Administrador de Malaga Comun';
		$pago['EP']='administrador@malagacomun.org';

		//Datos del pago
		$pago['CPT'] = 'Cuota mensual a la Cuenta Comunitaria';
		$pago['CTD'] = -$cuota;
		$pago['CMNT'] = '';
		$pago['FECHA'] = obten_fecha();
		$pago['VAL'] = 10; //pasamos de las estrellitas

		$conex = admin_conectar_bd();
		$qry = "SELECT NOMBRE, EMAIL FROM usuarios WHERE ROL='activo'";
		$rs = mysqli_query($conex, $qry);
		$i = 0;
		while ($usr = mysqli_fetch_array($rs))
		{
			$pago['NR'] = $usr['NOMBRE'];
			$pago['ER'] = $usr['EMAIL'];
			insertar_pago_directo($pago);
			enviar_email_aviso_pago($pago);
			usleep(300000);  //número de microsegundos para poder escribir múltiples valores en serie en la base de datos
			echo $i++.'. '.$pago['ER'].'<br>';
		}
		echo '<br>';
		echo '<p align="center" id="titulo6"><b>El cobro de la cuota mensual se ha realizado correctamente. El número de contribuidores ha sido '.$i.', siendo la recaudación de '.$cuota*$i.' comunes</b></p>';
		mysqli_close($conex);
}
include ("pie.php");
?>