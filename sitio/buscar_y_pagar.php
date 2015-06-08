<?php
include ("funcs_sitio.php");
include ("cabecera_inicio.php");
include ("autocompletar_usuarios.php");

if (!$_POST)
{
echo '<h2 align="left">Formulario de transferencias</h2>';
echo '<hr>';
echo '<p align="left" ><i style="color:green" class="fa fa-info-circle"></i>&emsp; Se ha creado un Fondo Comunitario para financiar proyectos encaminados al crecimiento de la red de Málaga Común. Si tu saldo es positivo (preferiblemente mayor que 100), y quieres contribuir al fondo, simplemente escribe <i>"fondo"</i> en la casilla "Nombre del receptor de la transferencia" para seleccionar al usuario correspondiente, e ingresa la cantidad que desees. De esta forma los comunes que no estés usando se activarán y servirán para dinamizar la red, beneficiándonos a tod@s. Además podrás recuperarlos cuando quieras comunicándolo al usuario Fondo Comunitario, ya que sólo es un depósito. En agradecimiento a tu apoyo tu nombre aparecerá en una lista de colaboradores</p>';

	if (isset($_GET['receptor'])) $receptor = $_GET['receptor'];
	else $receptor="";
?>
		<form action="buscar_y_pagar.php" method="post">
				Nombre del receptor de la transferencia
				<input id="autocomplete-custom-append" name="nombre" type="text" value="<?php echo $receptor;?>" required />
				<div id="suggestions-container" style="position: relative; float: left; width: 400px; margin: 0px;">
				</div>
				Concepto
				<input id="formulario" name="concepto" type="text" size="75%" required onFocus="this.style.backgroundColor='#ffc'" onBlur="this.style.backgroundColor='#ffe'" style="font-size:20px; " />
				Cantidad (en comunes)
				<input id="formulario" name="cantidad" type="number" size="75%" required onFocus="this.style.backgroundColor='#ffc'" onBlur="this.style.backgroundColor='#ffe'" style="font-size:20px; " />
				Comentarios (opcional)
				<input id="formulario" name="comentario" type="text" size="75%" onFocus="this.style.backgroundColor='#ffc'" onBlur="this.style.backgroundColor='#ffe'" style="font-size:20px; " />

				<button class="button" type="submit" name="buscador">Realizar Transferencia</button>
		</form>
<?php
}
else
	{ 
		//Datos del pagador  NP->nombre pagador, EP->email pagador
		$pago['NP']=$_SESSION['NOMBRE'].' '.$_SESSION['APELLIDOS'];
		$pago['EP']=$_SESSION['EMAIL'];
		$rol = $_SESSION['ROL'];

		//Datos del receptor
		$seleccion = $_POST['nombre'];
		$nombre_email = explode (" <", $seleccion);
		$pago['NR'] = $nombre_email[0];
		$pago['ER'] = trim ($nombre_email[1],'>');

		//Datos del pago
		$pago['CPT'] = $_POST['concepto'];
		$pago['CTD'] = $_POST['cantidad'];
		$pago['CMNT'] = $_POST['comentario'];
		$pago['FECHA'] = obten_fecha();
		$pago['VAL'] = 10; //pasamos de las estrellitas

// inserto el pago
			if ($pago['CTD']>0 or $rol=='mc_org')
				{
				insertar_pago_directo($pago);   //esta función actualizará los saldos también
				enviar_email_aviso_pago($pago); // se envia un email de aviso al receptor del pago

				// se avisa de que se ha hecho bien 
				echo '<br>';
				echo '<p align="center" id="titulo6"><b>La transferencia se ha realizado correctamente</b></p>';
				echo '<p align="center"><b><a class="button" href="mis_pagos_realizados.php">Ir a mis pagos realizados</a><a class="button" href="buscar_y_pagar.php">Realizar otro pago</a></b></p>';	
				echo '<br>';
				}
			else
				{
				echo '<br>';
				echo '<p align="center"><b>Debes poner una cantidad en comunes positiva o mayor que cero.</b></p>';
				echo '<p align="center"><b><a class="button" href="buscar_y_pagar.php">Pulsa aquí para volver a intentarlo</a></b></p>';	
				}
	}
include ("pie.php");
?>