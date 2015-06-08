<?php
ini_set('max_execution_time', 0);
/**************************************************************************/
function conectar_base_datos()   //quitar de aquí y dejarlo en conectar_bd.php
{
include ('config_local.php') ;
$conexion = mysqli_connect($server, $db_user, $db_pass, $database) or die ("error1".mysqli_connect_error());
mysqli_query ($conexion, "SET NAMES 'utf8'");

return $conexion;
}
/***************************************************************************/
function obten_fecha()
{
$fecha= date('d/m/Y', time());
return $fecha;
}

/**************************************************************************/
function obten_fecha_pago()
{
//$fecha= "Pagado el " . date('d/m/Y', time());
$fecha= date('d/m/Y', time());

return $fecha;
}
/**************************************************************************/
function gira_fecha($fecha)
{
		$ano=substr($fecha, 0, 4);
		$mes=substr($fecha, 5, 2);
		$dia=substr($fecha, -2);

		$fecha2=$dia.'/'.$mes.'/'.$ano;

return $fecha2;
}

/*************************************************************************/
function muestra_anuncio_con_foto($anuncio)
{
$ruta_original=$anuncio['FOTO'];
$email = $anuncio['EMAIL'];
$autor = $anuncio['NOMBRE'];

echo '<div class="mostrar">';
	echo "<table style='width:95%' >";
		$titulo = $anuncio['TITULO'];
		// Quito el número de anuncio para optimizar el espacio echo "<tr>  <th>Anuncio nº ".$id."<br/>
		echo "<tr ><th><h5 style='color:white;'>". $titulo ."</h5></th> </tr>";

		if  ($anuncio['FOTO']=='defecto.jpg')  //no mostramos foto, sólo cuerpo del anuncio
		{
			echo "<tr class='cuerpo_anuncio'><td>".nl2br($anuncio['CUERPO'])."</td></tr>";
		}
		else  //mostramos foto junto con el cuerpo del anuncio
		{
		?>
		<tr class="cuerpo_anuncio"><td>
		<div align="left">
				<a href="<?php echo $ruta_original; ?>" target="_blank"><img  src="<?php echo $ruta_original; ?>" id="imagen_anuncio" style="float: right; max-height: 150px; max-width:250px" /></a>
				<?php echo $anuncio['CUERPO']; ?>
		</div>
		</td></tr>

		<?php
		}
		echo "<tr><td>";
		echo "Localidad: ".$anuncio['LOCALIZACION'].". Publicado el ".$anuncio['FECHA']." por <a href='mostrar_usuario.php?email=$email&anuncio=$titulo'>".$autor." (contacta aquí)
		</a></td></tr>";				
	echo '</table>';
echo '</div>';
}

/**************************************************************************/
function muestra_anuncio_propio_con_foto($anuncio,$tipo_anuncio)
{
$foto = $anuncio['FOTO'];
$id = $anuncio['ID'];

if ($foto == "defecto.jpg") $ruta='imagenes/anuncios/defecto.jpg';
else $ruta = $foto;

echo "<table  >";
echo '<tr>  <th colspan="2">Anuncio nº  '.$anuncio['ID'].'</th> </tr>';	

if ($foto=="defecto.jpg")
{
	echo "<tr><td><h4>Título:  </h4>".$anuncio['TITULO']."</td></tr>";
}
else
{
	echo "<tr><td width='50%'><h4>Título:  </h4>".$anuncio['TITULO']."</td><td rowspan='5'><div align='center'><img class='bordes_redondeados' width='100%'  id='imagen_anuncio_propio'  src='".$ruta."'/></div></td></tr>";
}
echo "<tr> <td><h4>Detalles: </h4>".nl2br($anuncio['CUERPO'])."</td>  </tr>";
if ($tipo_anuncio == 'ofertas') echo '<tr><td ><h4>Etiquetas:</h4>'.$anuncio['ETIQUETAS'].'</td>  </tr>';			
echo '<tr> <td><h4>Localidad: </h4> '.$anuncio['LOCALIZACION'].'</td>  </tr>';			
echo '<tr> <td><h4>Publicado el:  </h4> '.$anuncio['FECHA'].'</td>  </tr>';	
	
echo "<tr><td colspan='2'>
  	<a class='button' href='editar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id'>Editar</a>
  	<a class='button' href='renovar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id'>Renovar este anuncio</a>    
	<a class='button' href='borrar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id&foto=$foto'>Eliminar</a>
	</td></tr>";
echo "</table><br><br>";
	
}
/**************************************************************************/
/**************************************************************************/
function muestra_cantidad_anuncios($cantidad)
{
	echo "<span>Total de ofertas: ".$cantidad."</span>";
	echo '<br/>';
	echo "<a class='button' href='tablon_anuncios.php'>Volver</a>";

}
/*************************************************************************/
/************************************************************************/
function muestra_pago($pago)
{	
  	echo '<table>';
		echo "<tr ><th >Recibo Nº ".$pago['ID']."&emsp; Fecha: ".$pago['FECHA']."</th></tr>";	
		echo "<tr> <td>Pagador: " . $pago['PAGADOR'] . " (" . $pago['EMAIL_PAGADOR'] . ")</td></tr>";
		echo "<tr> <td>Receptor: " . $pago['RECEPTOR'] . " (" . $pago['EMAIL_RECEPTOR'] . ")</td></tr>";
		echo "<tr> <td>Concepto: " . $pago['TITULO'] . "</td></tr>";
		echo "<tr> <td>Cantidad : " . $pago['CANTIDAD'] . " comun(es)</td></tr>";
		echo "<tr> <td>Comentario: " . nl2br($pago['COMENTARIO']) . "</td></tr>";
    echo "</table>";
	echo "</br>";
}
/**************************************************************************/
function muestra_pago_reducido($id,$pagador,$email_pagador,$titulo,$receptor,$email_receptor,$cantidad,$comentario,$fecha)
{	

echo " <table > ";

echo '<tr style="background-color:black; color: white;"><td>Recibo nº '. $id .'</td></tr>';

echo '<tr><td>'.$titulo .'<br/>'. $pagador .'<br/>'.$cantidad .' comun(es) <br/>'. $fecha .'</td></tr>';
	
echo '<tr><td><a class="button"  href="muestra_recibo.php?id='.$id.'">Detalles</a>&nbsp;&nbsp;&nbsp;<a class="button"  href="consulta2.php?titulo_del_pago='.$titulo.'&pagador_del_pago='.$pagador.'">Historial</a></td></tr>';
  
echo "</table>";

}
/**************************************************************************/
function muestra_sugerencia($id,$asunto,$texto,$fecha,$autor)
{	
	echo " <table > ";
	echo '<th>'.$asunto.'</th>';
    echo "<tr><td>".$autor." dice: ".nl2br($texto)."</td></tr>";
	echo '<tr><td>Publicado el '.$fecha.'&emsp;<a href="responder_sugerencia.php?id='.$id.'&asunto='.$asunto.'">Responder</a></td></tr>';
    echo "</table>";
}
/*****************************************************************************************************/
function enviar_email_aviso_pago($pago)
{
$para=$pago['ER'];

$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$pago['NP']."<".$pago['EP'].">"."\r\n";
$cabeceras .= "Sender: no-reply@malagacomun.org"."\r\n";

if ($pago['CMNT']) {$comentario = ", y ha dejado el siguiente comentario: <br>".$pago['CMNT'];}
else $comentario = "";

$mensaje = "Estimad@ usuari@: <p>".$pago['NP']." ha realizado una transferencia de ".$pago['CTD']." comune(s) a tu cuenta en concepto de ".$pago['CPT'].$comentario."</p><br><p><font size='2'>Revisa tus transacciones en la web para más detalles. En caso de estar en desacuerdo con la transacción, por favor, comunícalo al usuario implicado, y si la discrepancia persiste, comunícalo al administrador de Málaga Común en un plazo de 10 días en la dirección administrador@malagacomun.org</font></p>";

$asunto = 'Málaga Común: Aviso de transferencia realizada';

mail($para, $asunto, $mensaje, $cabeceras);

}
/*******************************************************************************************************************/
function obten_pagos_recibidos($email)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion, "SELECT * FROM pagos WHERE EMAIL_RECEPTOR='$email'");

	$pagos_recibidos = mysqli_num_rows ( $rs );

	return $pagos_recibidos;	
	
}
/*******************************************************************************************************************/
function obten_pagos_emitidos($email)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion, "SELECT * FROM pagos WHERE EMAIL_PAGADOR='$email'");

	$pagos_emitidos = mysqli_num_rows ( $rs );

	return $pagos_emitidos;	
	
}
/*******************************************************************************************************************/
function obten_oferta_por_id($id)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion,"SELECT * FROM ofertas WHERE ID='$id'");

	$oferta = mysqli_fetch_array($rs);

	return $oferta;	
	
}
/*******************************************************************************************************************/
function obten_demanda_por_id($id)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion,"SELECT * FROM demandas WHERE ID='$id'");

	$demanda = mysqli_fetch_array($rs);

	return $demanda;	
	
}
/*******************************************************************************************************************/
function insertar_pago_directo($pago)
{
	//Registramos la transacción en la tabla de pagos
	$con = conectar_base_datos();
	$v1=$pago['NP']; $v2=$pago['EP']; $v3=$pago['CPT']; $v4=$pago['NR']; $v5=$pago['ER']; $v6=$pago['CTD']; $v7=$pago['CMNT']; $v8=$pago['FECHA']; $v9=$pago['VAL'];
	$query = "insert into pagos (PAGADOR,EMAIL_PAGADOR,TITULO,RECEPTOR,EMAIL_RECEPTOR,CANTIDAD,COMENTARIO,FECHA,VALORACION) values ('$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8','$v9')";
	mysqli_query($con, $query);

	// Actualizamos los saldos del pagador y del receptor
	$resultado=mysqli_query($con, "SELECT * FROM usuarios WHERE EMAIL='$v2'");
	$us = mysqli_fetch_array($resultado);
	$nuevo_saldo = $us['COMUNES']-$v6;
	mysqli_query($con, "UPDATE usuarios SET COMUNES=$nuevo_saldo WHERE EMAIL='$v2'");

	$resultado=mysqli_query($con, "SELECT * FROM usuarios WHERE EMAIL='$v5'");
	$us = mysqli_fetch_array($resultado);
	$nuevo_saldo = $us['COMUNES']+$v6;
	mysqli_query($con, "UPDATE usuarios SET COMUNES=$nuevo_saldo WHERE EMAIL='$v5'");
	
	// se activa la cuenta del receptor del pago si es 'nuevo'
	if ($us['ROL']=='nuevo')
		{mysqli_query($con, "UPDATE usuarios SET ROL='activo' WHERE EMAIL='$v5'");}
	
	mysqli_close($con);	
}
/******************************************************************************************************************
/**********************************************************************************/
// Ejemplo de entrada de parámetros a la función:
// $imagen='prueba.jpg';
// $ancho_maximo=640;
// $alto_maximo=640;
function redimensionar_imagen($imagen,$ancho_maximo,$alto_maximo)
{
// El archivo
$nombre_archivo = $imagen;

echo $nombre_archivo.'<br>';

// Establecer un ancho y alto máximo
$ancho = $ancho_maximo;
$alto = $alto_maximo;

echo $ancho.'<br>';
echo $alto.'<br>';

// Tipo de contenido
header('Content-Type: image/jpeg');

// Obtener las nuevas dimensiones
list($ancho_orig, $alto_orig) = getimagesize($nombre_archivo);

$ratio_orig = $ancho_orig/$alto_orig;

if ($ancho/$alto > $ratio_orig) {
   $ancho = $alto*$ratio_orig;
} else {
   $alto = $ancho/$ratio_orig;
}

// Redimensionar
$image_p = imagecreatetruecolor($ancho, $alto);
$image = imagecreatefromjpeg($nombre_archivo);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);

// Imprimir
imagejpeg($image_p, null, 100);
}
/**********************************************************************************/
/**********************************************************************************/
function muestra_datos_usuario($usr,$anuncio)   //incluye también el formulario de contacto
{
$email = $usr['EMAIL'];
$nombre = $usr['NOMBRE'];
$nombre_completo = $nombre.' '.$usr['APELLIDOS'];
$nombre_completo_email = $nombre_completo.' <'.$usr['EMAIL'].'>';
?>
<div style="float:left; width:70%; text-align:left">
	<h3><b>Enviar mensaje a <?php echo $nombre ?></b></h3>
	<?php if ($usr['ROL']=='inactivo') echo 'Aviso: la cuenta de est@ usuari@ está inactiva, por lo que es posible que no recibas respuesta<br>';?>
	<form action="responder_anuncio.php?para=<?php echo $email ?>&anuncio=<?php echo $anuncio ?>" method="POST"  accept-charset="UTF-8">

		<textarea name="mensaje"  rows="5" required  ></textarea>
		<button class="button" type="submit">Enviar mensaje</button><br><br>
	</form>
</div>
<div align="right">
	<img src="<?php echo $usr['FOTO']; ?>" width="30%"/><br>
</div>

<?php
echo '<table  align="center">';

echo '<th colspan="3">'.'Datos Personales'.'</th>';      
	
echo '<tr><td>Nombre completo</td><td>'. $nombre_completo.' </td></tr>';
echo '<tr> <td>Datos de contacto</td><td >'.$email.', '.$usr['TELEFONO'].'</td></tr>';

echo '<tr> <td>Localizacion</td><td >'.$usr['LOCALIZACION'].' ['.$usr['CP'].']</td></tr>';

$servicios_prestados=obten_pagos_recibidos($email);
$servicios_recibidos=obten_pagos_emitidos($email);
echo "<tr> <td>Servicios prestados / recibidos</td><td>".$servicios_prestados." / ".$servicios_recibidos."</td></tr>";
echo "<tr> <td>Comentarios de otros usuarios</td><td><a href='mostrar_comentarios.php?email=$email'>Ver comentarios</a></td></tr>";
echo '<tr><td>Saldo </td>';
echo '<td style="font-size:35px; color:#080;">'.$usr['COMUNES'].'&emsp;&emsp;<a href="buscar_y_pagar.php?receptor='.$nombre_completo_email.'"><span style="font-size:26px">Enviar un pago</span></a></td></tr>';

echo '</table>';	

}
/****************************************************************************************************************************/
function codigos_postales()
{
	$conexion=conectar_base_datos();
	$result = mysqli_query($conexion, "SELECT CP FROM usuarios");	

	$codigos=array();
	while($row = mysqli_fetch_array($result))
	{
			$cp=$row['CP'];
			if ($cp!=0) 
			{
				array_push($codigos, $cp);
			}
	}
	return $codigos;
}
/****************************************************************************************************************************/
function obten_coord_desde_array($array_asociativo, $cp)
{
	foreach ($array_asociativo as $posicion)
	{
		if ($posicion['cp']==$cp)
		{
				$latitud=$posicion['latitud'];
				$longitud=$posicion['longitud'];

			    return array($latitud, $longitud);

		}	
	}
}
/****************************************************************************************************************************/
function crea_tabla_desde_fichero()
{
			$array_fichero=array();
			
			$file = fopen ("marcas.txt", "r");
			while (!feof($file) ) 
			{
					$linea = fgets($file);
					array_push($array_fichero, $linea);
			}
			fclose ($file);
			
			
			$conexion=conectar_base_datos();
			
			foreach ($array_fichero as $valor)
			{
				$cp=substr($valor,0,5);
				$latitud=substr($valor,6,6);
				$longitud=substr($valor,17,6);
			
				mysqli_query($conexion, "INSERT INTO coordenadas (CP, LATITUD, LONGITUD) VALUES ('$cp','$latitud','$longitud')");	
				
			}	
			
			mysqli_close($conexion);
	
}
/****************************************************************************************************************************/
function dame_coordenadas()
{
			$array_fichero=array();
			
			$file = fopen ("marcas.txt", "r");
			while (!feof($file) ) 
			{
					$linea = fgets($file);
					array_push($array_fichero, $linea);
			}
			fclose ($file);			
			$array_asociativo = array ();
			foreach ($array_fichero as $valor)
			{
				$cp=substr($valor,0,5);
				$latitud=substr($valor,6,6);
				$longitud=substr($valor,17,6);
			
				$nuevo = array ('cp' => $cp, 'latitud' => $latitud, 'longitud' => $longitud);
				array_push($array_asociativo, $nuevo);
				
			}			
			$codigos=codigos_postales();
			
			$total=count($codigos);
			
			$coords=array();
			for ($i=0; $i<=$total-1; $i++)
			{
					$cp=$codigos[$i];
					
					$coord=obten_coord_desde_array($array_asociativo, $cp);
					
					array_push($coords,$coord);				
			}
		
			return $coords;
}
/***********************************************************************************************************************/
function crea_coordenadas()
{
	$conexion=conectar_base_datos();
	
	$codigos=codigos_postales();
	$total=count($codigos);	
			$coords= array ();	
			for ($i=0; $i<=$total-1; $i++)
			{
					$cp=$codigos[$i];
					$rs=mysqli_query($conexion, "select * from coordenadas where cp='$cp' ");
					
					$fila=mysqli_fetch_array($rs);					
					
					$latitud=$fila['latitud'];
					$longitud=$fila['longitud'];
					
					$coord = array ($latitud, $longitud);

					array_push($coords,$coord);				
			}	
			return $coords;
	mysqli_close($conexion);
}
/***********************************************************************************************************************/
function existe_email($email)
{
	$con=conectar_base_datos();
	$sql = "SELECT * FROM usuarios WHERE EMAIL='$email'";
	$result = mysqli_query($con, $sql);
	return (mysqli_num_rows($result));
	mysqli_close($con);
	mysqli_free_result($result);
}
/******************************************************************************/