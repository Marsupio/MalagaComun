<?php 
include ("funciones.php");
include ("config_local.php");
include ("cabecera_administrador2.php");
/********************************************************/
ini_set('max_execution_time', 0);
if ($_POST)
{
$nombre=$_POST['nombre'];
$asunto = $_POST['asunto'];
$email=$_POST['email'];
$mensaje = $_POST['mensaje'];
$destinatarios = $_POST['destinatarios'];

$num = md5(time());

//MAIL BODY HTML
$cuerpo_mensaje  = "<h2>Malaga Comun</h2>" . "<br />";
$cuerpo_mensaje .= "Este mensaje fue enviado por: " . $nombre . "<br />";
$cuerpo_mensaje .= "En referencia a:  " . $asunto . "<br />";
$cuerpo_mensaje .= "Su e-mail es: " . $email. "<br />";
$cuerpo_mensaje .= "Mensaje: <br /><br /><b>" . nl2br($mensaje). "</b><br /><br />";
$cuerpo_mensaje .= "Enviado el " . date('d/m/Y', time()) . "<br />";

$_name=$_FILES["filead"]["name"];
$_type=$_FILES["filead"]["type"];
$_size=$_FILES["filead"]["size"];
$_temp=$_FILES["filead"]["tmp_name"]; 

	if( strcmp($_name, "") ) //FILES EXISTS
		{ 
		$fp = fopen($_temp, "rb");
		$file = fread($fp, $_size);
		$file = chunk_split(base64_encode($file)); 

		// MULTI-HEADERS Content-Type: multipart/mixed and Boundary is mandatory.
		$headers = "From: Administrador de Málaga Común <administrador@malagacomun.org>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: multipart/mixed; "; 
		$headers .= "boundary=".$num."\r\n";
		$headers .= "--".$num."\n"; 

		// FILES HEADERS 
		$headers .= "Content-Type:application/octet-stream "; 
		$headers .= "name=\"".$_name."\"r\n";
		$headers .= "Content-Transfer-Encoding: base64\r\n";
		$headers .= "Content-Disposition: attachment; ";
		$headers .= "filename=\"".$_name."\"\r\n\n";
		$headers .= "".$file."\r\n";
		$headers .= "--".$num."\n"; 
		
		// HTML HEADERS 
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "Content-Transfer-Encoding: 8bit\r\n";
		$headers .= "".$cuerpo_mensaje."\n";
		$headers .= "--".$num."\n"; 

				// SEND MAIL // obtengo la lista de emails recorriendo la tabla de correos	
				echo "<h2>Se está enviando el correo a los siguientes destinatarios:</h2>";
				echo "Aguarde un momento hasta que pueda ver al final de la página el número total de usuarios.<br /><br />";
				$con=conectar_base_datos();
				if ($destinatarios=='activos')
					{$rs=mysqli_query ($con, "SELECT EMAIL FROM  usuarios WHERE ROL='activo' OR ROL='nuevo'");}
				else 
					{$rs=mysqli_query ($con, "SELECT EMAIL FROM  usuarios WHERE ROL='inactivo'");}
				$total=0;
				while ($us=mysqli_fetch_array ($rs)) 
				{
					$para=$us['EMAIL'];
					$asunto=utf8_decode($asunto);
					mail($para, $asunto ,$cuerpo_mensaje, $headers);	
					echo "<span style='text-align:left'>".$para."</span><br />";		
					$total=$total+1;												
				}
				echo '<br /><h2>Se ha enviado el email a los '.$total.' usuarios</h2>';				

			
		} 
		else  //FILES NO EXISTS
		 { 

		// HTML HEADERS
		$headers = "From: Malaga Comun <administrador@malagacomun.org>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "Content-Transfer-Encoding: 8bit\r\n";

				// SEND MAIL // obtengo la lista de emails recorriendo la tabla de usuarios	
				echo "<h2>Se está enviando el correo a los siguientes destinatarios:</h2>";
				echo "Aguarde un momento hasta que pueda ver al final de la página el número total de usuarios.<br /><br />";
				$con=conectar_base_datos();
				if ($destinatarios=='activos')
					{	$query = "SELECT EMAIL FROM  usuarios WHERE ROL='activo' OR ROL='nuevo'";
						$rs = mysqli_query($con, $query);}
				else 
					{	$query = "SELECT EMAIL FROM usuarios WHERE ROL='inactivo'";
						$rs = mysqli_query($con, $query);}
				$total=0;
				$us = mysqli_fetch_array($rs);
				while ($us)
				{
					$para=$us['EMAIL'];
					$asunto=utf8_decode($asunto);
					mail($para, $asunto ,$cuerpo_mensaje, $headers);	
					echo "<span style='text-align:left'>".$para."</span><br />";	
					$total=$total+1;
					$us = mysqli_fetch_array ($rs);					
				}	
				echo '<br /><h2>Se ha enviado el email a los '.$total.' usuarios</h2>';				
		} 
mysqli_close($con);
}
else  //Si NO $_POST
{
$destinatarios = $_GET['destinatarios'];	
?>
<!-- ----------------- estilo del gif  de cargando ------------------------------------------------------------- -->
<style>
#cargando 
{
/*	position:relative;*/

	position: absolute;
	top:50%;
	left:50%;
	background-color: white;
	color: black;
	border:5px solid black;
	outline:none;
	width: 300px;
	visibility:hidden;
}
</style>

<!-- ------- creo la funcion que oculta o no el div ----------------------------------------------------------- -->
<script type="text/javascript" />
function muestra_cargando()
{
	document.getElementById("cargando").style.visibility="visible";	
}
</script>
<!-- ------------------------------------------------------------------------------------------------------------- -->

<h3 align="left">Mensaje a los usuarios <?php echo $destinatarios ?> de Málaga Común:</h3><br>
<form accept-charset="utf-8" action="notificar_usuarios.php"  enctype="multipart/form-data"  method="post">

		<span>Destinatarios</span>
		<input name="destinatarios" size="73%" maxlength="200" placeholder=<?php echo $destinatarios?> value=<?php echo $destinatarios?> required />
		<br>
		<span>Persona que envia </span>
		<input  name="nombre"   size="73%"  maxlength="200" placeholder="Administrador" value="Administrador"  required />
		<br>
		<span>Email</span>
		<input name="email"   size="73%" maxlength="200" placeholder="administrador@malagacomun.org" value="administrador@malagacomun.org" required />
		<br>
		<span>Asunto</span>
		<input  name="asunto" type="text" i size="73%" maxlength="200" required />
		<br>
		<span>Mensaje</span>
		<textarea  name="mensaje" cols="55%" rows="10" required /></textarea>
		<br>
		<span>Archivo adjunto</span>
		<input type="file"  id="filead" name="filead" />
		<br>
		<button class="button" onClick="javascript: muestra_cargando();"   type="submit" >Enviar email</button>	

</form>
<br />

<!-- ************************************************************ -->
<div id="cargando" class="bordes_redondeados" >

	<br /><p>Enviando mensajes. <br/>Espere un momento por favor.</p>

	<img src="imagenes/cargando.gif" alt=""  width="150px" />

</div>
<!-- ********************************************************** -->


<?php	

}
/********************************************************/
include("pie.php");
?>