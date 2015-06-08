<?php
include ("funciones.php");
include ("cabecera_inicio.php");

$email=$_GET["email"];

$con = conectar_base_datos();

///////////////////////Sentencia para buscar los comentatios de la gente a los servicios prestados /////////////////////////

$qry = "SELECT * FROM pagos WHERE (EMAIL_RECEPTOR='$email') ORDER by ID DESC"; 
//Ejecuto la sentencia 
$rs = mysqli_query($con, $qry); 
if (mysqli_num_rows($rs)!=0)
{
	echo '<h4>Comentarios de los demás usuarios a los servicios realizados y/o productos ofertados por este participante:</h4>';      
	echo '<br />';

	while($pago = mysqli_fetch_array($rs))
  	{
		$pagador=$pago['PAGADOR'];
		$comentario=$pago['COMENTARIO'];
		$cantidad=$pago['CANTIDAD'];	
		$fecha=$pago['FECHA'];	
		
		echo '<div class="bordes_redondeados" align="left"  style="background-color: #cde; padding: 1em;">';
			echo '<span style="color:blue">'.$pagador.'</span> dijo: <br>';
			echo '<span ">'.$comentario.'</span><br>';
			echo '<span style="color: black">'.$cantidad.'</span>'.' comunes <br>';
			echo '<span ">Publicado el '.$fecha.'</span><br>';
		echo '</div>';		
		echo '<br />';		
	}
} 
else
{
	echo '<h4>Este usuario no ha recibido ningún comentario todavía.</h4>';    
	echo '<br>';  
}
	echo "<a href='mostrar_usuario.php?email=$email&anuncio='> VOLVER </a>";		
////////////////////////////////////////////////////////////////////////////////////////////////////////	
mysqli_free_result($rs);
mysqli_close($con);
include ("pie.php");

?>