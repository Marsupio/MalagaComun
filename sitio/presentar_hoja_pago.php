<?php
include ("funciones.php");
include ("cabecera_inicio.php");

$nombre_pagador=$_SESSION['NOMBRE'];
$apellidos_pagador=$_SESSION['APELLIDOS'];
$pagador=$nombre_pagador.' '.$apellidos_pagador;
$telefono_pagador=$_SESSION['TELEFONO'];
$email_pagador=$_SESSION['EMAIL'];
$localizacion_pagador=$_SESSION['LOCALIZACION'];

$seleccion=$_POST['nombre'];
echo $seleccion;

$id='prueba';
$nombre_receptor='prueba';
$apellidos_receptor='prueba';
$receptor='prueba';

$email_receptor='prueba';


?>

<!-- ************************************************************************************ -->
<script type="text/javascript">

function actualiza_valoracion(valor)
{
	document.getElementById("valor_estrella").src="imagenes/"+valor+".png";
	
	document.getElementById("valoracion_formulario").value=valor;

	for (var j = 0; j <= 10; j++) 
	{ 
			var nombre1="estrella"+j;
			document.getElementById(nombre1).src="imagenes/estrella_vacia.png";
	}


	for (var i = 0; i <= valor; i++) 
	{ 
			var nombre2="estrella"+i;
			document.getElementById(nombre2).src="imagenes/estrella_llena.png";
	}

}
</script>
<!-- ************************************************************************************ -->


<h2 align='left'>Formulario de pago</h2>
<!--<span>(Una vez efectuado el pago se le notificará por email al usuario receptor del pago, y se registrará la transacción en el sistema)</span> -->
<br />

<form  action='' method="POST" lang="es">

<h3>Receptor del pago:</h3>

<input id="formulario" name="receptor" type="text" size="75%" required readonly value="<?php echo $nombre_receptor.' '.$apellidos_receptor;  ?>" style="background-color:#FFe; color:#000; border:0px" />

<input id="formulario" name="email_receptor" type="text" size="75%" required readonly value="<?php echo $email_receptor;  ?>" style="background-color:#FFe; color:#000; border:0px" />

Concepto
<input id="formulario" name="titulo" type="text" size="75%" placeholder="" required onFocus="this.style.backgroundColor='#ffc'" onBlur="this.style.backgroundColor='#ffe'" style="font-size:20px; font-weight:bold;" />
Cantidad en comunes que quieres pagar a ese usuario (un número mayor que cero)
<input id="formulario" name="cantidad" type="number" size="75%" placeholder="" required onFocus="this.style.backgroundColor='#ffc'" onBlur="this.style.backgroundColor='#ffe'" style="font-size:20px; font-weight:bold;" />
<span>Comentarios (opcional)</span>
<input id="formulario" name="comentario" type="text" size="75%" onFocus="this.style.backgroundColor='#ffc'" onBlur="this.style.backgroundColor='#ffe'" style="font-size:20px; font-weight:bold;" />

Valoración del servicio recibido entre 0 y 10, donde 0 es pésimo, 5 es indiferente y 10 es excelente.
<br>
<img  id="estrella0" src="imagenes/estrella_llena.png" onClick="actualiza_valoracion(0)"    width="25px" alt="0" />
<img id="estrella1" src="imagenes/estrella_llena.png" onClick="actualiza_valoracion(1)"  width="25px" alt="1" />
<img id="estrella2" src="imagenes/estrella_llena.png" onClick="actualiza_valoracion(2)"   width="25px" alt="2" />
<img id="estrella3" src="imagenes/estrella_llena.png" onClick="actualiza_valoracion(3)"   width="25px" alt="3" />
<img id="estrella4" src="imagenes/estrella_llena.png" onClick="actualiza_valoracion(4)"   width="25px" alt="4" />
<img id="estrella5" src="imagenes/estrella_llena.png" onClick="actualiza_valoracion(5)"   width="25px" alt="5" />
<img id="estrella6" src="imagenes/estrella_vacia.png" onClick="actualiza_valoracion(6)"  width="25px" alt="6" />
<img id="estrella7" src="imagenes/estrella_vacia.png" onClick="actualiza_valoracion(7)"   width="25px" alt="7" />
<img id="estrella8" src="imagenes/estrella_vacia.png" onClick="actualiza_valoracion(8)"   width="25px" alt="8" />
<img id="estrella9" src="imagenes/estrella_vacia.png" onClick="actualiza_valoracion(9)"   width="25px" alt="9" />
<img id="estrella10" src="imagenes/estrella_vacia.png"  onClick="actualiza_valoracion(10)"  width="25px" alt="10" />
<img id="valor_estrella" src="imagenes/5.png" alt="" width="80px" />

<input id="valoracion_formulario" name="valoracion"  size="100%" type="hidden" value="5"  required    />
<br />
<!--<button class="boton" type="reset">Borrar Todo</button>  --> 
<button class="button" type="submit">Efectuar el Pago</button>

</form>

<?php

// SE INSERTA ESE PAGO EN LOS RECIBOS Y SE ACTUALIZAN LOS COMUNES DE ESOS DOS USUARIOS 
/*
if ($_POST)
{
// primero recojo los datos de los usuarios (muchos de ellos estaban ya rellenos)

$pagador=$_POST['pagador'];
$email_pagador=$_POST['email_pagador'];

$titulo=$_POST['titulo'];

$receptor=$_POST['receptor'];
$email_receptor=$_POST['email_receptor'];

$cantidad=$_POST['cantidad'];
$comentario=$_POST['comentario'];
$fecha=obten_fecha();
$valoracion=$_POST['valoracion'];

if ($cantidad>0)
{
insertar_pago_directo($pagador, $email_pagador, $titulo, $receptor, $email_receptor, $cantidad, $comentario, $fecha, $valoracion);

// actualizacion de los comunes de pagador y receptor

$con = conectar_base_datos();
$resultado=mysqli_query($con, "SELECT * FROM usuarios WHERE EMAIL='$email_pagador'");
$fila=mysqli_fetch_array($resultado);
$saldo_pagador=$fila[7];
$saldo_pagador_actualizado=$saldo_pagador-$cantidad;
mysqli_query($con, "UPDATE usuarios SET COMUNES=$saldo_pagador_actualizado WHERE EMAIL='$email_pagador'");

$resultado=mysqli_query($con, "SELECT * FROM usuarios WHERE EMAIL='$email_receptor'");
$fila=mysqli_fetch_array($resultado);
$saldo_receptor=$fila[7];
$saldo_receptor_actualizado=$saldo_receptor+$cantidad;
mysqli_query($con, "UPDATE usuarios SET COMUNES=$saldo_receptor_actualizado WHERE EMAIL='$email_receptor'");

// se envia un email de aviso al receptor del pago
// enviar_email_aviso_pago($email_receptor,$pagador,$receptor,$cantidad,$titulo,$email_pagador);

// se activa la cuenta del receptor del pago si es 'nuevo'

$estado_receptor = $fila[11];
if ($estado_receptor='nuevo')
	{mysqli_query($con, "UPDATE usuarios SET ROL='activo' WHERE EMAIL='$email_receptor'");}

// se avisa de que se ha hecho bien 
echo '<br>';
echo '<h2>Gracias</h2>';
echo '<p align="center" id="titulo6"><b>Se ha realizado correctamente su pago.</b></p>';

echo '<p align="center"><b><a class="button" href="mis_pagos_realizados.php">Ir a mis pagos realizados</a></b></p>';	

echo '<br>';
}
else
{
	echo '<br>';
	echo '<p align="center"><b>Debes poner una cantidad en comunes positiva o mayor que cero.</b></p>';
	echo '<p align="center"><b><a class="button" href="buscar_y_pagar.php">Pulse aquí para volver a intentarlo</a></b></p>';	
}


} /*fin del if principal*/
include ("pie.php");
?>