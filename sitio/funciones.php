<?php
ini_set('max_execution_time', 0);
/**************************************************************************/
function conectar_base_datos()
{
include ('config_local.php') ;
$conexion = mysqli_connect($server, $db_user, $db_pass, $database) or die ("error1".mysqli_connect_error());
mysqli_query ($conexion, "SET NAMES 'utf8'");

return $conexion;
}
/***************************************************************************/
function obten_fecha()
{
//$hoy = getdate();

//$diasemana=$hoy['weekday'];
//$diames=$hoy['mday'];
//$mes=$hoy['month'];
//$ano=$hoy['year'];

//$fecha='Publicado el '.$diasemana.' '.$diames.' de '.$mes.' de '.$ano.'.';
//$fecha= "Publicado el " . date('d/m/Y', time());
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
function muestra_anuncio_con_foto($tipo_anuncio,$anuncio,$autor)
{
$ruta_original=$anuncio['FOTO'];
$email = $anuncio['EMAIL'];

if ($ruta_original != "defecto.jpg")
{
	if ($tipo_anuncio=='oferta')
	{
	$c1=substr($ruta_original,0,26);
	$c2=substr($ruta_original, 26);
	$ruta_miniatura=$c1.'miniatura_'.$c2;
	} 
	elseif ($tipo_anuncio=='demanda') 
	{
	$c1=substr($ruta_original,0,27);
	$c2=substr($ruta_original, 27);
	$ruta_miniatura=$c1.'miniatura_'.$c2;
	}
}
else
{
	$ruta_miniatura='imagenes/anuncios/defecto.jpg';
}

echo "<table>";

		// Quito el número de anuncio para optimizar el espacio echo "<tr>  <th>Anuncio nº ".$id."<br/>
		echo "<tr>  <th><h3 style='color:white;'>". $anuncio['TITULO'] ."</h3></th> </tr>";

		if  ($anuncio['FOTO']=='defecto.jpg')  //no mostramos foto, sólo cuerpo del anuncio
		{
			echo "<tr><td>".nl2br($anuncio['CUERPO'])."</td></tr>";
		}
		else  //mostramos foto junto con el cuerpo del anuncio
		{
		?>
		<tr><td>
		<div align="left">
				<a href="<?php echo $ruta_original; ?>" target="_blank"><img  src="<?php echo $ruta_miniatura; ?>" id="imagen_anuncio" style="float: right; max-height: 100px; max-width:150px" /></a>
				<?php echo $anuncio['CUERPO']; ?>
		<!-- esto no funciona     <br/>
				<a class="button" href="javascript:VentanaModal('block', 'url ?php echo $foto ?>)' )">Ver foto más grande</a> -->
		</div>
		</td>
		</tr>

		<?php
		}
		echo "<tr><td>";
		echo "Publicado el ".$anuncio['FECHA']." por ".$autor.". Localidad: ".$anuncio['LOCALIZACION']."</td></tr>";					
		echo "<tr><td>";
		echo "<a class='button'  href='responder_anuncio.php?para=$email&nombre_completo=$autor' target='_blank'>Enviar Correo</a>";
		echo "<a class='button'  href='ver_perfil_usuario.php?email=$email' target='_blank'>Ver perfil de este usuario</a></td></tr>";

echo '</table>';
}

/**************************************************************************/
function muestra_anuncio2($id,$titulo,$cuerpo,$email,$categoria,$fecha,$tipo_anuncio,$id_usuario,$nombre_completo,$localizacion,$foto)
{


echo "<table  >";

echo "<tr>  <th>Anuncio nº ".$id.' <br/>'. $titulo ."</th> 	</tr>";	

if ($foto=='imagenes/anuncios/ofertas/defecto.jpg')
{

}
else
{
	echo '<tr> 	<td ><div align="center"><br/>	<img class="bordes_y_sombra" id="imagen_anuncio"  src="'.$foto .' " /></div></td></tr>';	
}

echo "<tr><td>Categoría: ".$categoria."</td></tr>";

echo "<tr><td>Detalles: <br/>".nl2br($cuerpo)."</td></tr>";

echo "<tr><td>Localidad: ".$localizacion.'<br/>Fecha: '.$fecha;
		
echo "<tr><td > <a  class='button' href='responder_anuncio.php?para=$email&nombre_completo=$nombre_completo'>Contactar</a></td></tr>";	

echo "</table>";
	
}
/**************************************************************************/
function muestra_anuncio_propio_con_foto($anuncio,$tipo_anuncio)
{
$foto = $anuncio['FOTO'];
$id = $anuncio['ID'];

if ($foto == "defecto.jpg")
{
	$ruta='imagenes/anuncios/defecto.jpg';
}
else
{
	$ruta = $foto;
}


echo "<table  >";

echo '<tr>  <th>Anuncio nº  '.$anuncio['ID'].'</th> </tr>';	


if ($foto=="defecto.jpg")
{
}
else
{
echo "<tr> 	<td ><div align='center'><img class='bordes_redondeados'   id='imagen_anuncio_propio'  src='".$ruta."'   /></div>	</td>   </tr>";
}

echo '<tr>  <td><h4>Título:  </h4>'.$anuncio['TITULO'].'</td> </tr>';	

echo "<tr> <td><h4>Detalles: </h4>".nl2br($anuncio['CUERPO'])."</td>  </tr>";

echo '<tr> 	<td ><h4>Categoría:</h4>'.$anuncio['CATEGORIA'].'</td>  </tr>';			

echo '<tr> <td><h4>Localidad: </h4> '.$anuncio['LOCALIZACION'].'</td>  </tr>';	
		
echo '<tr> <td><h4>Publicado el:  </h4> '.$anuncio['FECHA'].'</td>  </tr>';	
	

if ($tipo_anuncio=='oferta')
{

echo "<tr><td >
	
  	<a class='button' href='borrar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id&foto=$foto'>Eliminar</a> 
		
  	<a class='button' href='editar_oferta.php?id=$id'>Editar</a>    
	
  	<a class='button' href='renovar_oferta.php?id=$id'>Renovar este anuncio</a>    
	

	</td></tr>";	
	
}
else  //si es demanda
{

echo "<tr><td >
	
  	<a class='button'  href='borrar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id&foto=$foto'>Eliminar</a> 
		
  	<a class='button' href='editar_demanda.php?id=$id'>Editar</a>    
	
  	<a class='button' href='renovar_demanda.php?id=$id'>Renovar este anuncio</a>    
	

	</td></tr>";	
	
}

echo "</table>";
echo "</br>";
echo "</br>";		
}
/**************************************************************************/
function muestra_anuncio($id,$titulo,$cuerpo,$email,$categoria,$fecha,$tipo_anuncio,$id_usuario,$nombre_completo,$localizacion,$telefono)
{
	
	if ($tipo_anuncio=='oferta')
	{	
	echo " <table class='tabla_usuarios2' align='center'> ";
	echo "<tr>  <th id='celda_numero'>Nº ".$id." </th> <th id='celda_titulo'>"."&nbsp;&nbsp;". $titulo ."</th> </tr>";		
	echo "<tr> <td  id='celda_cuerpo_anuncio' colspan='2'>" . nl2br($cuerpo) . "</td></tr>";
    echo "<tr> <td id='celda_categoria' colspan='2'>" . $categoria . "</td></tr>";
	

    echo "<tr> <td id='celda_usuario'>" ."Usuario nº ". $id_usuario . "</td>    <td id='celda_fecha'>" . "Nombre: ".$nombre_completo . "</td></tr>";
	
    echo "<tr> <td id='celda_usuario'>" ."Teléfono: ". $telefono . "</td>    <td id='celda_fecha'>" . "Email: ".$email . "</td></tr>";	
	
    echo "<tr> <td id='celda_usuario' >" . $fecha . "</td>    <td id='celda_fecha' >"."Localidad: ". $localizacion . "</td></tr>";


    echo "<tr> <td id='celda_boton' colspan='2'>
	<a class='button' href='responder_anuncio.php?para=$email&nombre_completo=$nombre_completo'>Enviar Email</a></td></tr>";

    echo "</table>";
	echo "</br>";
	echo "</br>";
	}

	if ($tipo_anuncio=='demanda')
	{
		
	echo " <table class='tabla_usuarios2' align='center'> ";
	echo "<tr> <th id='celda_numero2'>Nº ".$id." </th> <th id='celda_titulo2'>"."&nbsp;&nbsp;". $titulo ."</th></tr>";		
	echo "<tr> <td id='celda_cuerpo_anuncio' colspan='2'>" . nl2br($cuerpo) . "</td></tr>";
    echo "<tr> <td id='celda_categoria' colspan='2'>" . $categoria . "</td></tr>";
	
    echo "<tr> <td id='celda_usuario'>" ."Usuario nº ". $id_usuario . "</td>
               <td id='celda_fecha'>" . "Nombre: ".$nombre_completo . "</td></tr>";

    echo "<tr> <td id='celda_usuario' >" . $fecha . "</td>
               <td id='celda_fecha' >"."Localidad: ". $localizacion . "</td></tr>";			   
		
    echo "<tr> <td id='celda_boton2' colspan='2'>
	<a href='responder_anuncio.php?para=$email&nombre_completo=$nombre_completo'>
	<button>Enviar Email</button></a></td></tr>";


    echo "</table>";
	echo "</br>";
	echo "</br>";
	}
}
/**************************************************************************/
function muestra_anuncio_propio($id,$titulo,$cuerpo,$email,$categoria,$fecha,$tipo_anuncio,$id_usuario,$nombre_completo,$localizacion)
{
	
	if ($tipo_anuncio=='oferta')
	{	

	echo " <table class='tabla_anuncio_con_foto' align='center'> ";
	echo "<tr>  <th id='celda_numero'>Nº ".$id." </th> <th id='celda_titulo'>"."&nbsp;&nbsp;". $titulo ."</th> </tr>";		
	echo "<tr> <td  id='celda_cuerpo_anuncio' colspan='2'>" . nl2br($cuerpo) . "</td></tr>";
    echo "<tr> <td id='celda_categoria' colspan='2'>" . $categoria . "</td></tr>";
	

    echo "<tr> <td id='celda_usuario'>" ."Usuario nº ". $id_usuario . "</td>
               <td id='celda_fecha'>" . "Nombre: ".$nombre_completo . "</td></tr>";
	
    echo "<tr> <td id='celda_usuario' >" . $fecha . "</td>
               <td id='celda_fecha' >"."Localidad: ". $localizacion . "</td></tr>";


    echo "<tr><td id='celda_boton' colspan='2'>
	
  	<a href='borrar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id'><button>Eliminar</button></a> 
  	<a href='editar_oferta.php?id=$id'><button>Editar</button></a>    

	</td></tr>";

    echo "</table>";
	echo "</br>";
	echo "</br>";

	
	}

	if ($tipo_anuncio=='demanda')
	{
		
	echo " <table class='tabla_anuncio_con_foto' align='center'> ";
	echo "<tr> <th id='celda_numero2'>Nº ".$id." </th> <th id='celda_titulo2'>"."&nbsp;&nbsp;". $titulo ."</th></tr>";		
	echo "<tr> <td id='celda_cuerpo_anuncio' colspan='2'>" . nl2br($cuerpo) . "</td></tr>";
    echo "<tr> <td id='celda_categoria' colspan='2'>" . $categoria . "</td></tr>";
	
    echo "<tr> <td id='celda_usuario'>" ."Usuario nº ". $id_usuario . "</td>
               <td id='celda_fecha'>" . "Nombre: ".$nombre_completo . "</td></tr>";

    echo "<tr> <td id='celda_usuario' >" . $fecha . "</td>
               <td id='celda_fecha' >"."Localidad: ". $localizacion . "</td></tr>";			   
		
    echo "<tr><td id='celda_boton' colspan='2'>
	
  	<a href='borrar_anuncio.php?tipo_anuncio=$tipo_anuncio&id=$id'><button>Eliminar</button></a> 
  	<a href='editar_demanda.php?id=$id'><button>Editar</button></a>    

	</td></tr>";


    echo "</table>";
	echo "</br>";
	echo "</br>";
	}
}
/**************************************************************************/
function muestra_cantidad_anuncios($cantidad)
{
	echo "<span>Total de ofertas: ".$cantidad."</span>";
	echo '<br/>';
	echo "<a class='button' href='anuncios.php'>Volver</a>";

}
/*************************************************************************/
function muestra_titulo_anuncios()
{
	$conexion=conectar_base_datos();
	$rs_ofertas=mysqli_query($conexion,'SELECT * FROM ofertas');
	$rs_demandas=mysqli_query($conexion, 'SELECT * FROM demandas');
	

	echo '<SELECT name="titulo" id="formulario2" size="10"> ';
	echo '<option selected="selected" value="">SELECCIONE UNO DE LOS ANUNCIOS DE LA LISTA DESPLEGABLE</option>';

	echo '<option value="">&nbsp;</option>';

	while ($fila=mysqli_fetch_array($rs_ofertas))
	{	
   		echo '<OPTION VALUE="'.$fila[1].'">'.'Oferta Nº '.$fila[0].' - '.$fila[1].'</OPTION> ';
	}
	
	echo '<option value="">&nbsp;</option>';
	
	while ($fila=mysqli_fetch_array($rs_demandas))
	{	
   		echo '<OPTION VALUE="'.$fila[1].'">'.'Demanda Nº '.$fila[0].' - '.$fila[1].'</OPTION> ';
	}	
	
	echo '<option value="">&nbsp;</option>';
	
	echo '</SELECT> ';
	
	mysqli_free_result($rs_ofertas);
	mysqli_free_result($rs_demandas);

	mysqli_close($conexion);
}

/************************************************************************/
function muestra_pago($pago)
{	
  	echo '<table>';
		echo "<tr ><th >Recibo Nº ".$pago['ID']."</th></tr>";	
		echo "<tr> <td>Pagador: " . $pago['PAGADOR'] . " (" . $pago['EMAIL_PAGADOR'] . ")</td></tr>";
		echo "<tr> <td>Receptor: " . $pago['RECEPTOR'] . " ( " . $pago['EMAIL_RECEPTOR'] . ")</td></tr>";
		echo "<tr> <td>Cantidad : " . $pago['CANTIDAD'] . " comun(es)</td></tr>";
		echo "<tr> <td>Pago realizado el " . $pago['FECHA'] . "</td></tr>";
		echo "<tr> <td>Anuncio: " . $pago['TITULO'] . "</td></tr>";
		echo "<tr> <td>Comentario: <br/> " . nl2br($pago['COMENTARIO']) . "</td></tr>";
	//	echo '<tr align="left"><td colspan="2"><a class="button" href="consulta1.php?pg=1">Volver</a></td></tr>';
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
function muestra_sugerencia($id,$texto,$fecha)
{	
	echo " <table > ";
	
	echo '<th>Sugerencia '.$id.' con fecha del '.$fecha.'</th>';
	
    echo "<tr><td >".nl2br($texto)."</td></tr>";

    echo "</table>";

}
/*****************************************************************************************************/
function enviar_email_aviso_pago($pago)
{

$para=$pago['ER'];

$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$pago['NP']."<".$pago['EP'].">"."\r\n";
$comentario = "";
if ($pago['CMNT']) {$comentario = ", y ha dejado el siguiente comentario: <br>".$pago['CMNT'];}

$mensaje = "<h2>Estimad@ usuari@ </h2> <br><h3> ".$pago['NP']." ha realizado una transferencia de ".$pago['CTD']." comune(s) a tu cuenta en concepto de ".$pago['CPT'].$comentario."</h3><br><p>Revisa tus transacciones en la web para más detalles. En caso de estar en desacuerdo con la transacción, por favor, comunícalo al usuario implicado, y si la discrepancia persiste, comunícalo al administrador de Málaga Común en un plazo de 10 días en la dirección administrador@malagacomun.org</p>";

$asunto = 'Málaga Común: Aviso de transferencia realizada';

mail($para, $asunto, $mensaje, $cabeceras);

}
/*******************************************************************************************************************/
function mostrar_lista_usuarios()
{
	$conexion=conectar_base_datos();
	$result = mysqli_query($conexion, "SELECT * FROM usuarios");

	echo '<SELECT id="formulario2" size="10" name="email_usuario_destino">';

	while($row = mysqli_fetch_array($result))
	{
		$id=$row['ID'];
		$nombre=$row['NOMBRE'];
		$apellidos=$row['APELLIDOS'];
		$email=$row['EMAIL'];
		
		$receptor=$nombre.' '.$apellidos;


		echo '<option value="'.$email.'">'.$id.'&nbsp;&nbsp;&bull;&nbsp;&nbsp;'.$nombre.'&nbsp;'.$apellidos.'&nbsp;&nbsp;&bull;&nbsp;&nbsp;'.$email.'</option>';	
		
	}
	echo '</SELECT>';
	
mysqli_close($conexion);
}
/*******************************************************************************************************************/
function obten_nombre_usuario_por_email($email_receptor)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion, "SELECT * FROM usuarios WHERE EMAIL='$email_receptor'");
	$fila=mysqli_fetch_array($rs);

		$nombre=$fila['NOMBRE'];	
		$apellidos=$fila['APELLIDOS'];	
		$usuario=$nombre.' '.$apellidos;	
	
	return $usuario;	
	
}
/*******************************************************************************************************************/
function obten_id_usuario_por_email($email_receptor)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion, "SELECT * FROM usuarios WHERE EMAIL='$email_receptor'");
	$fila=mysqli_fetch_array($rs);

		$id=$fila['ID'];	
	
	return $id;	
	
}
/*******************************************************************************************************************/
function obten_telefono_usuario_por_email($email)
{
	$conexion=conectar_base_datos();
	$rs = mysqli_query($conexion,"SELECT * FROM usuarios WHERE EMAIL='$email'");
	$fila=mysqli_fetch_array($rs);

		$telefono=$fila['TELEFONO'];

	return $telefono;	
	
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
/*******************************************************************************************************************/
function muestra_usuario_por_id($id)
{	
$registro = mysqli_query($conexion,"SELECT * FROM  usuarios WHERE ID='$id' ");

$row78 = mysqli_fetch_array($registro);

if ($row78)
{
	
	echo "<table id='tabla_usuarios2' align='center'>"; 
/*
	echo " <tr>
	<th>ID</th>
	<th>Nombre</th>
	<th>Apellidos</th>
	<th>Tel&eacute;fono</th>
	<th>E-Mail</th>
	<th>Comunes</th>
	<th>Detalles</th>
	</tr>";	
*/
	  echo "<tr>";
	  
	  echo "<td width='8%'>" . $row78['ID'] . "</td>";
	  echo "<td width='30%'>" . $row78['NOMBRE'] .' '. $row78['APELLIDOS'].  "</td>";
	  echo '<td width="12%">' . $row78['TELEFONO'] . "</td>";
	  echo '<td width="30%">'.$row78['EMAIL'].'</td>';
	  
	$comunes=$row78['COMUNES'];
	
	if ($comunes<0)	
	{
	  echo '<td width="10%" style=" font-weight:bold; color:#a00;">' . $row78['COMUNES'] . '</td>'; 
	}	
	elseif ($comunes>0) 	
	{
	  echo '<td width="10%" style="font-weight:bold; color:#080">' . $row78['COMUNES'] . '</td>'; 	
	} 	
	else 	
	{
	  echo '<td width="10%" style="font-weight:bold; color:#000">' . $row78['COMUNES'] . '</td>'; 			
	}

	$email=$row78['EMAIL'];
  	echo "<td width='10%'> <a href='mostrar_usuario.php?email=$email'><button>Ver</button></a></td>";     

	echo '</tr>';
	
	echo '</table>';
}


}
/**********************************************************************************/
function mandar_email($nombre, $email, $asunto, $cuerpo_mensaje, $para)
{
	
//empiezo a componer el email
$nombre='Administrador de Málaga Común';

$cabeceras = "MIME-Version: 1.0"."\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8-es"."\r\n";
$cabeceras .= "From: ".$nombre."<".$email.">"."\r\n";

//comprobamos si todos los campos fueron completados
if ($nombre!='' && $email!='' && $asunto!='' && $cuerpo_mensaje!='') 
{
	
// si es asi armamos el mensaje
//		$mensaje = "Este mensaje fue enviado por: " . $nombre . " <br />";
//		$mensaje .= "En referencia a: " . $asunto . " <br />";
//		$mensaje .= "Su e-mail es: " . $email . " <br />";
		$asunto = 'Boletín de Ofertas y Demandas';
		$mensaje =  " <br />" . $cuerpo_mensaje . " <br />" . " <br />";
		$mensaje .= "Enviado el " . date('d/m/Y', time());
		
// si todos los campos fueron completados enviamos el mail
		mail($para, $asunto, $mensaje, $cabeceras);
		echo '<span>Mensaje enviado a: <b>'.$para.'</b>......<span style="font-weight:bold; color:green;">OK!</span></span><br />';

} 
else 
{
		echo "<span>Mensaje enviado a: <b>".$para."</b>......<span style='font-weight:bold; color:red;'>ERROR!</span></span><br />";
}
	
	
}
/**********************************************************************************/
function mostrar_resultados($buscar)
{

	$con=conectar_base_datos();
	$sql = "SELECT * FROM usuarios WHERE (NOMBRE LIKE '%$buscar%') OR (APELLIDOS LIKE '%$buscar%') OR (TELEFONO LIKE '%$buscar%') OR (EMAIL LIKE '%$buscar%') OR (LOCALIZACION LIKE '%$buscar%')";

	$result = mysqli_query($con, $sql);

	// Tomamos el total de los resultados
	$total = mysqli_num_rows($result);

	if ($total>0)
	{
	// Imprimimos los resultados
	echo '<p align="center" style="color:green;">Se han encontrado '.$total.' resultado(s)</p>';
	
	echo "<table> <tr>		<th>Resultado(s)</th></tr>";

	while($row = mysqli_fetch_array($result))
	{	
		$id=$row['ID'];
		$nombre=$row['NOMBRE'];
		$apellidos=$row['APELLIDOS'];
		$telefono=$row['TELEFONO'];
		$email=$row['EMAIL'];
		$localizacion=$row['LOCALIZACION'];
	
	  echo "<tr><td>Usuario nº " . $id . "<br />Nombre: " . $nombre . " " . $apellidos . "<br />Teléfono: " . $telefono . "<br />Email: " . $email ."<br />Localidad: " . $localizacion ."<br /><a class='button'  href='presentar_hoja_pago.php?id=$id&&nombre=$nombre&&apellidos=$apellidos&&telefono=$telefono&&email=$email&&localizacion=$localizacion'>Pagar</a></td></tr>";
	  
	  
	}
  	echo '</table>';

	}
	else
	{
		echo '<p align="center"  style="color:red;">No se han encontrados resultados.<br> Pruebe con otras palabras.</p>';	
	}

	mysqli_close($con);
	mysqli_free_result($result);
}
/**********************************************************************************/
function mostrar_resultados_busqueda_usuario($email)   //Obsoleta
{

	$con=conectar_base_datos();
	$sql = "SELECT * FROM usuarios WHERE EMAIL='$email')";

	$rs = mysqli_query($con, $sql);
	$usr = mysqli_fetch_array($rs);
    echo "<a class='button' href='mostrar_usuario.php?email=$email'>Examinar</a>"; 
	  echo "&nbsp;&nbsp;&nbsp";
	  echo "<a class='button'  href='responder_anuncio.php?para=$email&nombre_completo=$usrnombre'>Enviar Correo</a>";
	  echo "</td></tr>";

	mysqli_close($con);
	mysqli_free_result($rs);
}
/**********************************************************************************/
function mostrar_resultados_busqueda_usuario_admin($buscar)
{

	$con=conectar_base_datos();
	$sql = "SELECT * FROM usuarios WHERE (NOMBRE LIKE '%$buscar%') OR (APELLIDOS LIKE '%$buscar%') OR (TELEFONO LIKE '%$buscar%') OR (EMAIL LIKE '%$buscar%') OR (LOCALIZACION LIKE '%$buscar%')";

	$result = mysqli_query($con, $sql);

	// Tomamos el total de los resultados
	$total = mysqli_num_rows($result);

	if ($total>0)
	{
	// Imprimimos los resultados
	echo '<p align="center">Se han encontrado <b>'.$total.'</b> resultado(s)</p>';
	echo "<table class='tabla_usuarios2' align='center'> 
	<tr>

		<th>Usuario(s) encontrado(s)</th>


</tr>";
		
	while($row = mysqli_fetch_array($result))
	{	
		$id=$row['ID'];
		$nombre=$row['NOMBRE'];
		$apellidos=$row['APELLIDOS'];
		$telefono=$row['TELEFONO'];
		$email=$row['EMAIL'];
		$localizacion=$row['LOCALIZACION'];
	
	  echo "<tr>";

	  echo "<td>Número: " . $id . ' 
	  <br />Nombre: '.$nombre.'
	  <br />Apellidos: '.$apellidos.'
	  <br />Teléfono:  '.$telefono.'
	  <br />Email:  '.$email.' 
	  <br />Localidad: '.$localizacion.' 
	  <br />'."&nbsp;&nbsp;&nbsp;"."<a class='button' href='borrar_usuario.php?id=$id'>Eliminar</a>"."&nbsp;&nbsp;&nbsp;"."<a class='button' href='avisar_usuario.php?para=$email'>Email</a>"."</td>"; 


//	   <a class='button' href='borrar_usuario.php?id=$id'>Eliminar</a>
// 	   <a class='button' href='avisar_usuario.php?para=$email'>Email</a>	  
//	   <a class='button' href='mostrar_usuario.php?email=$email'>Examinar</a>
 
	  
	  echo "</tr>";	  
	}
  	echo '</table>';
	}
	else
	{
		echo '<p align="center" style="font-weight:bold; color: red;">No se han encontrados resultados.<br> Pruebe con otras palabras.</p>';	
	}

	mysqli_close($con);
	mysqli_free_result($result);
}
/************************************************************************/
function mostrar_resultados_ofertas($buscar)
{

	$con=conectar_base_datos();
	$sql = "SELECT * FROM ofertas WHERE (ID LIKE '%$buscar%') OR (TITULO LIKE '%$buscar%') OR (CUERPO LIKE '%$buscar%') OR (CATEGORIA LIKE '%$buscar%') OR (EMAIL LIKE '%$buscar%') OR (FECHA LIKE '%$buscar%') OR (LOCALIZACION LIKE '%$buscar%') ORDER BY ID DESC";

	$result = mysqli_query($con, $sql);

	// Tomamos el total de los resultados
	$total = mysqli_num_rows($result);

	if ($total>0)
	{
	// Imprimimos los resultados
	echo '<p align="center">Se han encontrado <b>'.$total.'</b> resultado(s)</p>';

	while($row = mysqli_fetch_array($result))
	{	
		$id=$row['ID'];
		$titulo=$row['TITULO'];
		$cuerpo=$row['CUERPO'];
		$categoria=$row['CATEGORIA'];
		$email=$row['EMAIL'];
		$fecha=$row['FECHA'];
		$localizacion=$row['LOCALIZACION'];
		
		$tipo_anuncio="oferta";
		$id_usuario=obten_id_usuario_por_email($email);
		$nombre_completo=obten_nombre_usuario_por_email($email);
		$telefono=obten_telefono_usuario_por_email	($email);
	

		muestra_anuncio($id,$titulo,$cuerpo,$email,$categoria,$fecha,$tipo_anuncio,$id_usuario,$nombre_completo,$localizacion,$telefono);

	  
	}
	
	}
	else
	{
		echo '<p align="center"><b>No se han encontrados resultados.</b><br> Pruebe con otras palabras u otros datos que conozca de ese usuario.</p>';	
	}

	mysqli_close($con);
	mysqli_free_result($result);
}
/**********************************************************************************/
function mostrar_resultados_demandas($buscar)
{

	$con=conectar_base_datos();
	$sql = "SELECT * FROM demandas WHERE (ID LIKE '%$buscar%') OR (TITULO LIKE '%$buscar%') OR (CUERPO LIKE '%$buscar%') OR (CATEGORIA LIKE '%$buscar%') OR (EMAIL LIKE '%$buscar%') OR (FECHA LIKE '%$buscar%') OR (LOCALIZACION LIKE '%$buscar%') ORDER BY ID DESC";

	$result = mysqli_query($con, $sql);

	// Tomamos el total de los resultados
	$total = mysqli_num_rows($result);

	if ($total>0)
	{
	// Imprimimos los resultados
	echo '<p align="center">Se han encontrado <b>'.$total.'</b> resultado(s)</p>';

	while($row = mysqli_fetch_array($result))
	{	
		$id=$row['ID'];
		$titulo=$row['TITULO'];
		$cuerpo=$row['CUERPO'];
		$categoria=$row['CATEGORIA'];
		$email=$row['EMAIL'];
		$fecha=$row['FECHA'];
		$localizacion=$row['LOCALIZACION'];
		
		$tipo_anuncio="demanda";
		$id_usuario=obten_id_usuario_por_email($email);
		$nombre_completo=obten_nombre_usuario_por_email($email);
	

		muestra_anuncio($id,$titulo,$cuerpo,$email,$categoria,$fecha,$tipo_anuncio,$id_usuario,$nombre_completo,$localizacion);

	  
	}
	
	}
	else
	{
		echo '<p align="center"><b>No se han encontrados resultados.</b><br> Pruebe con otras palabras.</p>';	
	}

	mysqli_close($con);
	mysqli_free_result($result);
}
/**********************************************************************************/
function mostrar_resultados_busqueda_pagos($buscar)   //obsoleta
{

	$con=conectar_base_datos();
	$sql = "SELECT * FROM usuarios WHERE (NOMBRE LIKE '%$buscar%') OR (APELLIDOS LIKE '%$buscar%') OR (TELEFONO LIKE '%$buscar%') OR (EMAIL LIKE '%$buscar%') OR (LOCALIZACION LIKE '%$buscar%')";

	$result = mysqli_query($con, $sql);

	// Tomamos el total de los resultados
	$total = mysqli_num_rows($result);

	if ($total>0)
	{
	// Imprimimos los resultados
	echo '<p align="center" style="color:green">Se han encontrado '.$total.' resultado(s)</p>';

	echo "<table > ";
	
	echo "<tr><th>Resultado(s)</th></tr>";

	while($row = mysqli_fetch_array($result))
	{	
		$id=$row['ID'];
		$nombre=$row['NOMBRE'];
		$apellidos=$row['APELLIDOS'];
		$telefono=$row['TELEFONO'];
		$email=$row['EMAIL'];
		$localizacion=$row['LOCALIZACION'];
	
	  echo "<tr><td>Usuario nº " . $id . "<br/>Nombre: " . $nombre . " " . $apellidos . "<br/>Teléfono: " . $telefono . "<br/>Email: " . $email ."<br/>Localidad: " . $localizacion ."<br/><a class='button' href='consulta3.php?email=$email' >RECIBOS</a></td></tr>";
	  
	}
  	echo '</table>';
	}
	else
	{
		echo '<p align="center" style="color:red">No se han encontrados resultados.<br> Pruebe con otras palabras.</p>';	
	}

	mysqli_close($con);
	mysqli_free_result($result);
}
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
function calcula_reputacion($email)
{
	$con=conectar_base_datos();
	$sql = "SELECT * FROM pagos WHERE (EMAIL_RECEPTOR='$email')";	
	$result = mysqli_query($con, $sql);
	$total_pagos = mysqli_num_rows($result);

/*
	if ($total_pagos==0) 		
	{		
			$valoracion=5;	
			return $valoracion;		
	}
*/

	if ($total_pagos>0)
	{
		$valoracion_total=0;
		$total_comunes=0;
		while($row = mysqli_fetch_array($result))
		{	
			$valoracion_actual=$row['VALORACION'];
			$valoracion_total=$valoracion_total+$valoracion_actual;
			
			$actual_comunes=$row['CANTIDAD'];
			$total_comunes=$total_comunes+$actual_comunes;
						
		}
		
		
		$valoracion=$valoracion_total/$total_pagos;	
	
	
		if  (($total_pagos>=1) && ($total_pagos<=10))	
		{		
					if ($total_comunes>100) { $valoracion=$valoracion+1;			}
					if ($total_comunes>200) { $valoracion=$valoracion+1; 		}
					if ($total_comunes>300) { $valoracion=$valoracion+1;			}
					if ($total_comunes>400) { $valoracion=$valoracion+1; 		}
					if ($total_comunes>500) { $valoracion=$valoracion+1;			}
					if ($total_comunes>600) { $valoracion=$valoracion+1; 		}
					if ($total_comunes>700) { $valoracion=$valoracion+1; 		}
					if ($total_comunes>800) { $valoracion=$valoracion+1; 		}
					if ($total_comunes>900) { $valoracion=$valoracion+1; 		}
					if ($total_comunes>1000) { $valoracion=$valoracion+1; 		}
		}

	
		if ($total_pagos>10)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>20)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>30)		{		$valoracion=$valoracion+1;										}		
		if ($total_pagos>40)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>50)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>60)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>70)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>80)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>90)		{		$valoracion=$valoracion+1;										}
		if ($total_pagos>100)		{		$valoracion=$valoracion+1;									}

		
		if ($valoracion>10)			
		{		
				$valoracion=10;
		}
		
		
		return $valoracion;
		
	}
	else
	{
		$reputacion="Este usuario aún no ha participado";
		return $reputacion;		
		
	}	
	mysqli_close($con);
}
/**********************************************************************************/
function muestra_datos_usuario($usr)
{
$email = $usr['EMAIL'];
$nombre = $usr['NOMBRE'];
echo '<h2>Perfil de '.$usr['NOMBRE'].' '.$usr['APELLIDOS'].'</h2>'	;
if ($usr['FOTO']=='imagenes/usuarios/defecto.jpg')
{
	echo '<p>Este usuario no ha publicado una foto de perfil</p>';
}
else
{
echo '<img id="foto_perfil"   src="'.$usr['FOTO'].'" /><br/><p>Foto de perfil</p>';
}
	
		
echo '<table  align="center">';

echo '<th colspan="3">'.'Datos Personales'.'</th>';      
	
echo '<tr><td>Nombre</td><td >'.$usr['NOMBRE'].'</td></tr>';
echo '<tr> <td>Apellidos</td><td >'.$usr['APELLIDOS'].'</td></tr>';
echo '<tr> <td>Teléfono</td><td >'.$usr['TELEFONO'].'</td></tr>';

$email2 = str_replace('@', ' @ ', $email);
echo '<tr> <td>Email</td><td >'.$email2.'</td></tr>';

echo '<tr> <td>Localizacion</td><td >'.$usr['LOCALIZACION'].'</td></tr>';
echo '<tr> <td>Código Postal</td><td >'.$usr['CP'].'</td></tr>';


$servicios_prestados=obten_pagos_recibidos($email);
echo "<tr> <td>Servicios prestados</td><td>".$servicios_prestados."</td></tr>";

$servicios_recibidos=obten_pagos_emitidos($email);
echo "<tr> <td>Servicios recibidos</td><td>".$servicios_recibidos."</td></tr>";

echo '<tr><td>Saldo </td>';
echo '<td style="font-size:30px; font-weight:bold; color:#080; text-shadow: 2px 2px #aaa;">'.$usr['COMUNES'].'</td>'; 
echo '</tr>';


echo '<tr><td colspan="2">';
echo "<a class='button' href='responder_anuncio.php?para=$email&&nombre_completo=$nombre' target='_blank'>Enviar Correo</a>";
echo "<a class='button' href='mostrar_comentarios.php?email=$email' target='_blank'>Ver Comentarios</a>";
echo '</td></tr>';

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






