<?php 
include ("funciones.php");
include ("cabecera_administrador.php");
/********************************************************/
if ($_POST)
{

$nombre=$_POST['nombre'];
$asunto = $_POST['asunto'];
$email=$_POST['email'];																			// EMAIL DEL ADMINISTRADOR
$mensaje = $_POST['mensaje'];


$num = md5(time());


//MAIL BODY HTML
$body = "<h2 style='color:#000;'>Málaga Común</h2>";
$body .= "<span style='color: #039;'>Este mensaje fue enviado por: </span><b>" . $nombre ."</b><br />";
$body .= "<span style='color: #039;'>En referencia a:  </span><b>" . $asunto . "</b><br />";
$body .= "<span style='color: #039;'>Su e-mail es:  </span><b>" . $email ."</b><br /><br />";
$body .= "<span style='color: #039;'>Mensaje:  </span><b>".  "<br/>". nl2br($mensaje) . "</b><br /><br />";
$body .= "<span style='color: #039;'>Enviado el  </span><b>" . date('d/m/Y', time()) ."</b>";



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
		$headers = "From: Malaga Comun <chapmanbright@googlemail.com>\r\n";
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
		$headers .= "".$body."\n";
		$headers .= "--".$num."\n"; 


				// SEND MAIL // obtengo la lista de emails recorriendo la tabla de correos	
				echo "<br /><p  style='font-size:1.2em; color: black; font-weight: bold;' >Se ha enviado el correo a los siguientes destinatarios:</p>";
				$conexion=conectar_base_datos();
				$resp=mysql_query ("SELECT EMAIL FROM  usuarios");
				while ($fila=mysql_fetch_array ($resp)) 
				{
					$para=$fila['EMAIL'];
					mail($para, $asunto ,$body, $headers);	
					echo "<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$para."</span><br /><br />";					
				}				
		
		
		} 
		else  //FILES NO EXISTS
		 { 

		// HTML HEADERS
		$headers = "From: Malaga Comun <chapmanbright@googlemail.com>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "Content-Transfer-Encoding: 8bit\r\n";


	
				// SEND MAIL // obtengo la lista de emails recorriendo la tabla de correos	
				echo "<br /><p  style='font-size:1.2em; color: black; font-weight: bold;' >Se ha enviado el correo a los siguientes destinatarios:</p>";
				$conexion=conectar_base_datos();
				$resp=mysql_query ("SELECT EMAIL FROM  usuarios");
				while ($fila=mysql_fetch_array ($resp)) 
				{
					$para=$fila['EMAIL'];
					mail($para, $asunto ,$body, $headers);	
					echo "<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$para."</span><br /><br />";					
				}			


		} 



}
else
{
?>
<!-- ----------------- estilo del gif  de cargando ------------------------------------------------------------- -->
<style>
#cargando 
{
	
	position:absolute;
	top:25%;
	left:50%;
	
	background-color:transparent;
	border: 0px;
	outline:none;
	
	width: 200px;


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


<br>
<p align="center"><b>Escriba el mensaje que quiere comunicar a los usuarios de Málaga Común:</b></p>
<form accept-charset="utf-8" action="mandar_emails.php"  enctype="multipart/form-data" id="formulario" method="post">

<table align="center">


<tr>
<td><span>Persona que envia </span></td>
<td><input  name="nombre"   size="73%"  maxlength="200" placeholder="Administrador" value="Administrador"  required /> <br /> </td> 
</tr>


<tr>
<td><span>Asunto</span></td>
<td><input  name="asunto" type="text" i size="73%" maxlength="200" placeholder="Motivo del E-mail" required />  <br /> </td>
</tr>


<tr>       
<td><span>Email</span></td>
<td><input name="email"   size="73%" maxlength="200" placeholder="chapmanbright@googlemail.com" value="chapmanbright@googlemail.com" required /><br /></td>
</tr>


<tr>
<td><span>Mensaje</span></td>
<td><textarea  name="mensaje" cols="55%" rows="10" placeholder="Escriba aquí los detalles..." required /></textarea><br /></td>
</tr>


<tr>
<td><span>Archivo adjunto</span></td>
<td><input type="file"  id="filead" name="filead" /></td>
</tr>


<tr>
<td style="text-align:left"><br><button type="reset">Borrar</button>	 </td>   
<td style="text-align:right"><br><button onClick="javascript: muestra_cargando();"   type="submit" >Enviar email a <b>TODOS</b> los usuarios</button>	 </td>
</tr>

</table>
</form>
<br />
<br />	

<!-- ************************************************************ -->
<div id="cargando" >

	<img src="imagenes/cargando.gif" alt="" width="200px"  />

</div>
<!-- ********************************************************** -->


<?php	
}
/********************************************************/
include("pie.php");
?>