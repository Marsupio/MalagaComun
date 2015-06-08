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
// EMAIL DEL ADMINISTRADOR
$mensaje = $_POST['mensaje'];


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
		$headers = "From: Malaga Comun <".$email_admin.">\r\n";
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
				$resp=mysqli_query ($con, "SELECT EMAIL FROM  usuarios");
				$total=0;
				while ($fila=mysqli_fetch_array ($resp)) 
				{
					$para=$fila['EMAIL'];
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
		$headers = "From: Malaga Comun <".$email_admin.">\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "Content-Transfer-Encoding: 8bit\r\n";



				// SEND MAIL // obtengo la lista de emails recorriendo la tabla de usuarios	
				echo "<h2>Se está enviando el correo a los siguientes destinatarios:</h2>";
				echo "Aguarde un momento hasta que pueda ver al final de la página el número total de usuarios.<br /><br />";
				$con=conectar_base_datos();
				$resp=mysqli_query ($con, "SELECT EMAIL FROM  usuarios");
				$total=0;				
				while ($fila=mysqli_fetch_array ($resp)) 
				{
					$para=$fila['EMAIL'];
					$asunto=utf8_decode($asunto);
					mail($para, $asunto ,$cuerpo_mensaje, $headers);	
					echo "<span style='text-align:left'>".$para."</span><br />";	
					$total=$total+1;				
				}	
				echo '<br /><h2>Se ha enviado el email a los '.$total.' usuarios</h2>';				
		

		} 

}
else
{
	
	
	
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

<h2>Escriba el mensaje que quiere comunicar a los usuarios de Málaga Común:</h2>
<form accept-charset="utf-8" action="mandar_emails.php"  enctype="multipart/form-data"  method="post">

<span>Persona que envia </span>
<input  name="nombre"   size="73%"  maxlength="200" placeholder="Administrador" value="Administrador"  required /> <br /> 
<br />

<span>Asunto</span>
<input  name="asunto" type="text" i size="73%" maxlength="200" placeholder="Motivo del E-mail" required />  <br /> 
<br />

<span>Email</span>
<input name="email"   size="73%" maxlength="200" placeholder="<?php echo $email_admin ?>" value="<?php echo $email_admin ?>" required /><br />
<br />

<span>Mensaje</span>
<textarea  name="mensaje" cols="55%" rows="10" placeholder="Escriba aquí los detalles..." required /></textarea><br />
<br />

<span>Archivo adjunto</span>
<input type="file"  id="filead" name="filead" />
<br>

<button  class="button" type="reset">Borrar</button>	 
<button class="button" onClick="javascript: muestra_cargando();"   type="submit" >Enviar email a TODOS los usuarios</button>	


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
mysqli_close($con);
?>